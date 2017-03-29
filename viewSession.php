<?php 
include 'session.php';
if($_SESSION['userlevel'] == 1){
	echo "Session id: ".session_id()."<br/>";
	echo "User IP(SERVER['REMOTE_ADDR']): ".$_SERVER['REMOTE_ADDR'];
	echo "<br/><br/>Server Variables: ";
	var_dump($_SERVER);
	echo "<br/>Session Variables: ";
	var_dump($_SESSION);
}
else
	header("location:index.php");
?>