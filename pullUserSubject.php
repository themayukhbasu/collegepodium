<?php
include_once 'session.php';
include 'ctSubjectMethods.php';
$arr = getUserSubjDB($_SESSION['userid']);
echo json_encode($arr[(int)$_GET['valpass']]);