<?php
require_once('ctUserClass.php');
function checkDupe($ctUser) {	
	include 'database.php';
	$checkDupe = $connection->prepare("SELECT ID FROM register WHERE email=?");
	$checkDupe->bind_param("s",$checkemail);
	$checkemail = $ctUser->udEmailGet();
	$checkDupe->execute();
	if ($checkDupe->fetch() != NULL) {
		$checkDupe->close();
		$connection->close();
		return 0;
	}
	else {
		$checkDupe->close();
		$connection->close();
		return 1;
	}
}