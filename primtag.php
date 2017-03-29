<?php
include 'global_classes.php';
include_once 'session.php';

if (!$_SESSION) header("location: login.php");
$gtNewTag = new ctGlobalTag;

if (!empty($_POST['gtName'])) $gtNewTag->gtNameSet($_POST['gtName']);
if (!empty($_POST['gtType'])) $gtNewTag->gtTypeSet($_POST['gtType']);
if (!empty($_POST['gtAddress'])) $gtNewTag->gtAddressSet($_POST['gtAddress']);
if (!empty($_POST['gtCity'])) $gtNewTag->gtCitySet($_POST['gtCity']);
if (!empty($_POST['gtState'])) $gtNewTag->gtStateSet($_POST['gtState']);
if (!empty($_POST['gtCountry'])) $gtNewTag->gtCountrySet($_POST['gtCountry']);
$gtNewTag->gtLevelSet(0);

primCommitDB($gtNewTag);



