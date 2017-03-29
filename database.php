<?php

/*$connection=mysqli_connect("localhost","root","","a1864584_ct");*/
/*$connection = new mysqli("mysql.hostinger.in","u204677655_root","cybersoft","u204677655_db");*/
$connection = new mysqli("localhost","root","cool123","mvp_db");


if ($connection->connect_error) {
    die("Failed: mvp_db || ERROR : " . $connection->connect_error);
}
/*
if ($connection_chat->connect_error) {
    die("Failed: chat_db || ERROR : " . $connection_chat->connect_error);
}
*/
?>

