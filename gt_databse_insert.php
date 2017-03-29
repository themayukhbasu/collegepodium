<?php
require_once ("global_classes.php");
//methods to add primary, secondary etc. tags to DB

function primCommitDB($ctTagObj) {
	if ($ctTagObj->gtLevelGet()!=0)
		return false; //check if we're actually being fed level = 0-primary
	include 'database.php';
	//save the json file now
	$jsonVar = json_encode($ctTagObj);
	$filename = uniqid('pri',TRUE);
	$ext = ".json";
	//PDO method for SQL query. This prevents first level SQL injection
	//this is a secure function. Don't use normal SQL to update database
	$stmt = $connection->prepare("INSERT INTO globaltag(gtName, gtFilePath, gtType, gtCity, gtState, gtCountry) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssss",$gtName,$gtFile,$gtType,$gtCity,$gtState,$gtCountry);
	//now prepare input
	//this was where XSS vulnerabilities were handled previously with htmlspecialchars. now this is done in the class itself
	$gtName = $ctTagObj->gtNameGet();
	$gtFile = $filename.$ext;
	$gtType = $ctTagObj->gtTypeGet();
	$gtCity = $ctTagObj->gtCityGet();
	$gtState = $ctTagObj->gtCityGet();
	$gtCountry = $ctTagObj->gtCountryGet();
	//close connection
	$stmt->execute();
	file_put_contents($filename.$ext,$jsonVar);
	$stmt->close();
	$connection->close();
}

function secCommitDB($ctTagObj, $parentID, $parentName) {
	if ($ctTagObj->gtLevelGet()!=1)
		return false; //check if we're actually being fed level = 1-secondary
	include 'database.php';
	//clean parentName
	$parentName = htmlspecialchars($parentName);
	//check if user is sending correct parentID and name
	$checkVar = $connection->prepare("SELECT * FROM globaltag WHERE ID = ? AND gtName = ?");
	$checkVar->bind_param("is",$parentID,$parentName);
	$checkVar->execute();
    if($checkVar->fetch()==NULL) return false;
	$checkVar->close();
	$connection->close();
	//save the json file now
	$jsonVar = json_encode($ctTagObj);
	$filename = uniqid('sec',TRUE);
	$ext = ".json";
	//PDO method for SQL query. This prevents first level SQL injection
	//this is a secure function. Don't use normal SQL to update database
	include 'database.php';
	$stmt = $connection->prepare("INSERT INTO sectag(stName, stFilePath, stType, stParentID, stParentName, stCity, stState, stCountry) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssissss",$stName,$stFile,$stType,$stPID, $stPName, $stCity,$stState,$stCountry);
	//now prepare input
	$stName = $ctTagObj->gtNameGet();
	$stFile = $filename.$ext;
	$stType = $ctTagObj->gtTypeGet();
	$stCity = $ctTagObj->gtCityGet();
	$stState = $ctTagObj->gtStateGet();
	$stCountry = $ctTagObj->gtCountryGet();
	$stPID = $parentID;
	$stPName = $parentName;
	//close connection
	$stmt->execute();
	file_put_contents($filename.$ext,$jsonVar);
	$stmt->close();
	$connection->close();
}

function tertCommitDB($ctTagObj, $parentID, $parentName) {
	if ($ctTagObj->gtLevelGet()!=2)
		return false; //check if we're actually being fed level = 1-secondary
	include 'database.php';
	//clean parentName
	$parentName = htmlspecialchars($parentName);
	//check if user is sending correct parentID and name
	$checkVar = $connection->prepare("SELECT * FROM sectag WHERE ID = ? AND stName = ?");
	$checkVar->bind_param("is",$parentID,$parentName);
	$checkVar->execute();
    if($checkVar->fetch()==NULL) return false;
	$checkVar->close();
	$connection->close();
	//save the json file now
	$jsonVar = json_encode($ctTagObj);
	$filename = uniqid('ter',TRUE);
	$ext = ".json";
	//PDO method for SQL query. This prevents first level SQL injection
	//this is a secure function. Don't use normal SQL to update database
	include 'database.php';	
	$stmt = $connection->prepare("INSERT INTO terttag(ttName, ttFilePath, ttType, ttParentID, ttParentName, ttCity, ttState, ttCountry) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssissss",$ttName,$ttFile,$ttType,$ttPID, $ttPName, $ttCity,$ttState,$ttCountry);
	//now prepare input
	$ttName = $ctTagObj->gtNameGet();
	$ttFile = $filename.$ext;
	$ttType = $ctTagObj->gtTypeGet();
	$ttCity = $ctTagObj->gtCityGet();
	$ttState = $ctTagObj->gtStateGet();
	$ttCountry = $ctTagObj->gtCountryGet();
	$ttPID = $parentID;
	$ttPName = $parentName;
	//close connection
	$stmt->execute();
	file_put_contents($filename.$ext,$jsonVar);
	$stmt->close();
	$connection->close();
}

function quarCommitDB($ctTagObj, $parentID, $parentName) {
	if ($ctTagObj->gtLevelGet()!=3)
		return false; //check if we're actually being fed level = 3-4th level
	include 'database.php';
	//clean parentName
	$parentName = htmlspecialchars($parentName);
	//check if user is sending correct parentID and name
	$checkVar = $connection->prepare("SELECT * FROM terttag WHERE ID = ? AND ttName = ?");
	$checkVar->bind_param("is",$parentID,$parentName);
	$checkVar->execute();
    if($checkVar->fetch()==NULL) return false;
	$checkVar->close();
	$connection->close();
	//save the json file now
	$jsonVar = json_encode($ctTagObj);
	$filename = uniqid('qua',TRUE);
	$ext = ".json";
	//PDO method for SQL query. This prevents first level SQL injection
	//this is a secure function. Don't use normal SQL to update database
	include 'database.php';
	$stmt = $connection->prepare("INSERT INTO quartag(qtName, qtFilePath, qtType, qtParentID, qtParentName, qtCity, qtState, qtCountry) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssissss",$qtName,$qtFile,$qtType,$qtPID, $qtPName, $qtCity,$qtState,$qtCountry);
	//now prepare input
	$qtName = $ctTagObj->gtNameGet();
	$qtFile = $filename.$ext;
	$qtType = $ctTagObj->gtTypeGet();
	$qtCity = $ctTagObj->gtCityGet();
	$qtState = $ctTagObj->gtStateGet();
	$qtCountry = $ctTagObj->gtCountryGet();
	$qtPID = $parentID;
	$qtPName = $parentName;
	//close connection
	$stmt->execute();
	file_put_contents($filename.$ext,$jsonVar);
	$stmt->close();
	$connection->close();
}

function primGetDB($count) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT * FROM globaltag WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$ID = $count;
	$stmt->execute();
	$stmt->bind_result($ID, $type, $name, $filepath, $city, $state, $country, $time);
	if (!$stmt->fetch()) return 0;
	$ctPrimTag = new ctGlobalTag;
	$ctPrimTag->gtSet($type, $name, $city, $state, 0, $country, 0, 0);
	$jsonVar = json_encode($ctPrimTag);
	return $jsonVar;
}

function secGetDB($parentID) {
	include 'database.php';
	$PID = (int)$parentID;
	$y = mysqli_query($connection,   "SELECT *
						FROM sectag
						WHERE
						stParentID = '".$PID."'");
	$count = mysqli_num_rows($y);
	if ($count == 0) return 0;
	$it = 0; //loop iterator
	while($it < $count) {
		$arr[$it]=mysqli_fetch_array($y, MYSQLI_ASSOC); //dump data
		$it++;
	}
	return $arr;
}

function tertGetDB($parentID) {
	include 'database.php';
	$PID = (int)$parentID;
	$y = mysqli_query($connection,   "SELECT *
						FROM terttag
						WHERE
						ttParentID = '".$PID."'");
	$count = mysqli_num_rows($y);
	if ($count == 0) return 0;
	$it = 0; //loop iterator
	while($it < $count) {
		$arr[$it]=mysqli_fetch_array($y, MYSQLI_ASSOC); //dump data
		$it++;
	}
	return $arr;
}

function quarGetDB($count, $parentID) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT * FROM quartag WHERE ID = ? AND qtParentID = ?");
	$stmt->bind_param('ii',$ID, $PID);
	$ID = $count;
	$PID = $parentID;
	$stmt->execute();
	$stmt->bind_result($ID, $name, $parID, $parname,  $city, $state, $country, $type, $filepath);
	if (!$stmt->fetch()) return 0;
	$ctPrimTag = new ctGlobalTag;
	$ctPrimTag->gtSet($type, $name, $city, $state, 0, $country, 0, 1);
	$jsonVar = json_encode($ctPrimTag);
	return $jsonVar;
}