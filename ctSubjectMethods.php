<?php 

function pushSubjectDB($subject, $cid) {
	include_once 'database.php';
	$stmt = $connection->prepare("INSERT INTO subjectlist (name, collegeid) VALUES (?, ?)");
	$stmt->bind_param('si',$subj, $collid);
	$subj = $subject;
	$collid = $cid;
	if ($stmt->execute()) return 1;
	else return 0;
	$stmt->close();
}

function userSubjectExists($sid, $uid) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ID FROM usersubject WHERE userid = ? AND subjectid = ?");
	$stmt->bind_param('ii',$userid, $subjid);
	$userid = $uid;
	$subjid = $sid;
	$stmt->execute();
	$stmt->bind_result($ID);
	$stmt->fetch();
	if ($ID == NULL) return 0;
	else return 1;
}

function subjectExists($sid) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ID FROM subjectlist WHERE ID = ?");
	$stmt->bind_param('ii',$subjid);
	$subjid = $sid;
	$stmt->execute();
	$stmt->bind_result($ID);
	$stmt->fetch();
	if ($ID == NULL) return 0;
	else return 1;
}

function subjectExistsColl($sid, $cid) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ID FROM subjectlist WHERE ID = ? and collegeid = ?");
	$stmt->bind_param('ii',$subjid, $collid);
	$subjid = $sid;
	$collid = $cid;
	$stmt->execute();
	$stmt->bind_result($ID);
	$stmt->fetch();
	if ($ID == NULL) return 0;
	else return 1;
}

function pushUserSubjectDB($sid, $uid, $cid) {
	if (userSubjectExists($sid, $uid) == 0 and subjectExistsColl($sid, $cid) == 1) {
		include 'database.php';
		$stmt = $connection->prepare("INSERT INTO usersubject (userid, subjectid) VALUES (?, ?)");
		$stmt->bind_param('ii', $userid, $subjid);
		$subjid = $sid;
		$userid = $uid;
		$stmt->execute();
		$stmt->close();
		return 1;
	}
	else return 0;
}

function getSubjDB($cid) {
	$cid = (int)$cid;
	$x=mysqli_connect("localhost","root","","mvp_db") or die("fail");
	$y = mysqli_query($x,"SELECT * FROM subjectlist WHERE collegeid = '".$cid."'");
	$count = mysqli_num_rows($y);
	if ($count == 0) return 0;
	$it = 0; //loop iterator
	while($it < $count) {
		$arr[$it]=mysqli_fetch_array($y, MYSQLI_ASSOC); //dump data
		$it++;
	}
	return $arr;
}	

function getUserSubjDB($uid) {
	$sid = (int)$sid;
	$uid = (int)$uid;
	$x=mysqli_connect("localhost","root","","mvp_db") or die("fail");
	$y = mysqli_query($x,"SELECT subjectlist.name, usersubject.subjectid FROM usersubject, subjectlist WHERE usersubject.userid = '".$uid."' AND usersubject.subjectid = subjectlist.ID");
	$count = mysqli_num_rows($y);
	if ($count == 0) return 0;
	$it = 0; //loop iterator
	while($it < $count) {
		$arr[$it]=mysqli_fetch_array($y, MYSQLI_ASSOC); //dump data
		$it++;
	}
	return $arr;
}	