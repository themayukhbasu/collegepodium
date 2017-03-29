<?php
include 'ctSubjectMethods.php';
include_once 'session.php';
$arr = getSubjDB($_SESSION['sectag']);
$num = (int)$_GET['valpass'];
echo json_encode($arr[$num]);