<?php
include 'global_classes.php';
include_once 'session.php';

if (!$_SESSION) header("location: login.php");
$ttNewTag = new ctGlobalTag;

if (!empty($_POST['ttName'])) $ttNewTag->gtNameSet($_POST['ttName']);
if (!empty($_POST['ttType'])) $ttNewTag->gtTypeSet($_POST['ttType']);
if (!empty($_POST['ttAddress'])) $ttNewTag->gtAddressSet($_POST['ttAddress']);
if (!empty($_POST['ttCity'])) $ttNewTag->gtCitySet($_POST['ttCity']);
if (!empty($_POST['ttState'])) $ttNewTag->gtStateSet($_POST['ttState']);
if (!empty($_POST['ttCountry'])) $ttNewTag->gtCountrySet($_POST['ttCountry']);
$ttNewTag->gtLevelSet(2);

tertCommitDB($ttNewTag,$_POST['ttPID'],$_POST['ttPName']);



