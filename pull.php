<?php

	include_once 'session.php';
	header('Content-Type: application/json');
	if (!$_SESSION) header("location: login.php");
	//insecure method but no need to fix since every variable is sessiondata (secure)
	include 'ctPostData.php';
	if ( isset( $_GET['type'] ) ) $type = $_GET['type'];
	else $type = 'all';
	if ( $_GET['sort'] != "vote" )
		$sort = 0;
	else $sort = 1;
	if ( ( !isset( $_GET['uni'] ) && !isset( $_GET['col'] ) && !isset( $_GET['dep'] ) ) || 
		 ( $_GET['uni'] == 0 && $_GET['col'] == 0 && $_GET['dep'] == 0 ) ) //&& !isset( $_GET['year'] ) ) //main page
		$arr = pdFetchPost($_SESSION['primtag'],$_SESSION['sectag'], $_SESSION['tertag'], $sort, $_GET['valpass'], $type);
	else {
		@$arr = pdFetchPost( $_GET['uni'],$_GET['col'], $_GET['dep'], $sort, $_GET['valpass'], $type ); //really need to add quartag to data
	}
	//echo $arr;
	$valpass=$_GET['valpass']; //get
	$jsonEncode = json_encode($arr); //json encode SQL query returned array
	echo $jsonEncode; //will be processed by AJAJ method

