<?php
include 'session.php';
include 'ctNoteData.php';
if ( !isset( $_POST['id'] ) ) header("Location: index.php");
if ( !isset( $_SESSION['userid'] ) ) header("Location: index.php");
$ID = $_POST['id'];
$files = ndGetNoteFile( $ID );
$file = $files['note_file'];
if (file_exists($file)) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);
	exit;
}
	