<?php
include 'global_classes.php';
include_once 'session.php';

if (!$_SESSION) header("location: login.php");
$stNewTag = new ctGlobalTag;

if (!empty($_POST['stName'])) $stNewTag->gtNameSet($_POST['stName']);
if (!empty($_POST['stType'])) $stNewTag->gtTypeSet($_POST['stType']);
if (!empty($_POST['stAddress'])) $stNewTag->gtAddressSet($_POST['stAddress']);
if (!empty($_POST['stCity'])) $stNewTag->gtCitySet($_POST['stCity']);
if (!empty($_POST['stState'])) $stNewTag->gtStateSet($_POST['stState']);
if (!empty($_POST['stCountry'])) $stNewTag->gtCountrySet($_POST['stCountry']);
$stNewTag->gtLevelSet(1);
echo('Pass');
secCommitDB($stNewTag,$_POST['stPID'],$_POST['stPName']);



