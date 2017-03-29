<?php
include 'session.php';
if ( !isset( $_SESSION['userid'] ) ) 
	header("Location: index.php");

include 'ClassSaveNote.php';
$saveNote = new SaveNote( $_SESSION['userid'], $_POST['note_id'], $_POST['priority'] );
if ( $_POST['priority'] < 0 ) $saveNote->unsaveNote();
else
	$saveNote->saveNote();
if ( isset( $_SESSION['notes']['saved'] ) )
	unset( $_SESSION['notes']['saved'] );
$priority = $saveNote->currentPriority();
echo $priority;
