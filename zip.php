<?php
include 'session.php';
include 'ctNoteData.php';
if ( !isset( $_POST['id'] ) ) header("Location: index.php");
if ( !isset( $_SESSION['userid'] ) ) header("Location: index.php");
$ID = $_POST['id'];
$files = ndGetNoteFile( $ID );
$zipname = htmlspecialchars( stripslashes( $_POST['filename'] ) );
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files['note_file'] as $file) {
  $zip->addFile($file, basename($file));
}
$zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);