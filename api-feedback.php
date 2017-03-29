<?php
//include session
include 'session.php';
include 'TokenMethod.php';
if (!isset($_SESSION['userid'])) header("location: login.php");
$csrf = new csrfToken;
if ( !isset( $_POST ) ) header( "Location: login.php" );
if ( $csrf->validateToken( $_POST['csrftoken'] ) == 0 ) header( "Location: login.php" );

include 'ClassFeedback.php';
if ( isset( $_FILES['file']['name'] ) && !empty( $_FILES['file']['name'] ) ) {
	include 'ctFileData.php';
	$file = new ctFileData(1);
	//check file and copy attribs from temp to upl_ variables
	$file->fdFileNameSet($_FILES['file']['name']) ;
	$file->fdFileSizeSet($_FILES['file']['size']);
	$file->fdFileTypeSet($_FILES['file']['type']);
	$file->fdFileTempNameSet($_FILES['file']['tmp_name']);
	$file->fdFileErrorSet($_FILES['file']['error']);
	$ext = strtolower(strrchr( $file->fdFileNameGet(),'.')); //extract extension
	$file->fdFileExtSet($ext);
	$feedback = new FeedbackContent( $_POST['fb_title'], $_POST['fb_content'], $_POST['fb_comp'], $file );
}
else $feedback = new FeedbackContent( $_POST['fb_title'], $_POST['fb_content'], $_POST['fb_comp'], 'NONE' );


$result = $feedback->insertDB();

if ( $result === 0 )
	echo '<script>window.location.href = \'upload_feedback.php?callback=fail\';</script>';
else header("location: acknowledge.php");
//echo '<script>window.location.href = \'upload_feedback.php?callback=success\';</script>';