<?php

include 'session.php';
include 'TokenMethod.php';
/*
$conn = new mysqli("localhost","root","","analytics_db");
				if ($conn->connect_error) {
					die("Failed: analytics_db_db || ERROR : " . $conn->connect_error);
				}
				
				$stmt = $conn->prepare("INSERT INTO logout (`userID`, `sessionID`, `userIP`) VALUES (?,?,?)");
				$stmt->bind_param('iss',$uID,$sID,$uIP);
				$uID = $ID;
				$sID = session_id();
				$uIP = $_SERVER['REMOTE_ADDR'];
				
				$stmt->execute();
				$stmt->close();
*/
	@session_unset();
	@session_destroy();
	echo '1';
	/*header("location:login.php");*/

?>