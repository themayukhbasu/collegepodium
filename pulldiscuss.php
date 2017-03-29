<?php

	include_once 'session.php';
	header('Content-Type: application/json');
	if (!$_SESSION) header("location: login.php");
	include 'ctPostData.php';
	$arr = pdFetchPostData($_GET['post_id'], $_GET['valpass']);
	$test = json_encode($arr);
	echo $test;

