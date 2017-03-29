<?php
include 'gt_databse_insert.php';
$type = (int)$_GET['type'];
if ($type == 1) {
	//uni tag
	$ID = $_GET['valpass'];
	echo primGetDB($ID);
}
elseif ($type == 2) {
	//col tag
	$ID = $_GET['valpass'];
	$PID = $_GET['pid'];
	$arr = secGetDB($PID);
	echo json_encode($arr[(int)$ID]);
}
elseif ($type == 3) {
	//col tag
	$ID = $_GET['valpass'];
	$PID = $_GET['pid'];
	$arr = tertGetDB($PID);
	echo json_encode($arr[(int)$ID]);
}