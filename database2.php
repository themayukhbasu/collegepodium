<?php
$connection= new mysqli("localhost","root","","mvp_db");

if ($connection->connect_error) {
    die("Failed: " . $connection->connect_error);
}
