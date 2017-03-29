<?php
include 'session.php';
if ( !isset( $_SESSION['userid'] ) ) 
	header("Location: index.php");
include 'ctNoteData.php';
$noteID = $_GET['note_id'];
$noteData = @ndGetNoteByID( $noteID);

echo json_encode($noteData);