<?php
include 'session.php';
if ( !isset( $_SESSION['userid'] ) ) 
	header("Location: index.php");
include 'ctNoteData.php';
$notesID = array();
$notesID = ndListSavedNotes($_SESSION['userid']);
$valpass = $_POST['valpass'];

$noteData = ndGetNoteByID( $notesID[ $valpass ] );

echo json_encode($noteData);