<?php
include 'session.php';
if ( !isset( $_SESSION['userid'] ) ) 
	header("Location: index.php");

include 'ClassSaveNote.php';
$saveNote = new SaveNote( $_SESSION['userid'], $_POST['note_id'] );
$priority =  $saveNote->isAlreadySaved();
echo $priority;
