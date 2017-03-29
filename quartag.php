<?php
include 'global_classes.php';
include_once 'session.php';

if (!$_SESSION) header("location: login.php");
$qtNewTag = new ctGlobalTag;

if (!empty($_POST['qtName'])) $qtNewTag->gtNameSet($_POST['qtName']);
if (!empty($_POST['qtType'])) $qtNewTag->gtTypeSet($_POST['qtType']);
if (!empty($_POST['qtAddress'])) $qtNewTag->gtAddressSet($_POST['qtAddress']);
if (!empty($_POST['qtCity'])) $qtNewTag->gtCitySet($_POST['qtCity']);
if (!empty($_POST['qtState'])) $qtNewTag->gtStateSet($_POST['qtState']);
if (!empty($_POST['qtCountry'])) $qtNewTag->gtCountrySet($_POST['qtCountry']);
$qtNewTag->gtLevelSet(3);

quarCommitDB($qtNewTag,$_POST['qtPID'],$_POST['qtPName']);



