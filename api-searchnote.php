<?php
	include 'session.php';
	if ( !isset( $_SESSION['userid'] ) ) 
		header("Location: index.php");
	$string = $_POST['search'];
	$srch_email = $_POST['searchEmail'];
	$srch_name = $_POST['searchName'];
	$srch_type = $_POST['searchType'];  
	$srch_teacher = $_POST['searchTeacher'];
	$srch_subject = $_POST['searchSubject'];
	$srch_period = $_POST['searchPeriod'];
	
	$valpass = $_POST['valpass'];
	// data checking 
	$stringRaw = trim( preg_replace( "/[^0-9a-z]+/i", " ", $string ) );
	$words = preg_split('/\s+/', $stringRaw);
	$srch_email = trim($srch_email);
	$srch_email = stripslashes($srch_email);
	$srch_name = stripslashes(trim($srch_email));
	
	$list = array();
	$list[0] = $string;
	$words = array_merge( $list, $words);
	$words = array_unique( $words );
	include 'ctNoteData.php';
	$notesID = array();
	
	foreach ( $words as $word ) {
		$arrID = advSearchNote( $word,$srch_email,$srch_name,$srch_type,$srch_teacher, $srch_subject, $srch_period );
		rsort($arrID);
		$notesID = array_merge( $notesID, $arrID );
		$notesID = array_unique( $notesID );
	/*
	foreach ( $words as $word ) {
		$arrID = ndSearchNote( $word );
		rsort($arrID);
		$notesID = array_merge( $notesID, $arrID );
		$notesID = array_unique( $notesID );
	}
	*/
	$noteData = @ndGetNoteByID( $notesID[ $valpass ] );
	echo json_encode($noteData);