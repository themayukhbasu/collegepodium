<?php
require_once ("ctPostData.php");
require_once ("ctFileData.php");


function pdWithFileUpd($ctPostInstance, $ctFileInstance) {
	include 'database.php';
	$fileUploadLocation = ($ctFileInstance->fdUploadLocGet()).($ctFileInstance->fdFileNameGet());
	if(move_uploaded_file($ctFileInstance->fdFileTempNameGet(), $fileUploadLocation) ){	
		$stmt = $connection->prepare("INSERT INTO data (username, primtag, sectag, tertag, privacy,
														file, title, post, votecount, is_op, op_id, type, userrealname, userid)
									   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("siiissssiiissi",$username, $primtag, $sectag, $tertag, $privacy, $file, $title, $post, $vc, $is_op, $op_id, $type, $realname, $userid);
		$username = $ctPostInstance->pdPostUsernameGet();
		$primtag = $ctPostInstance->pdPrimTagGet();
		$sectag = $ctPostInstance->pdSecTagGet();
		$tertag = $ctPostInstance->pdTerTagGet();
		$privacy = $ctPostInstance->pdPostPrivGet();
		$file = $fileUploadLocation;
		$title = $ctPostInstance->pdPostTitleGet();
		$post = $ctPostInstance->pdPostDataGet();
		$vc = $ctPostInstance->pdVoteGet();
		$is_op = $ctPostInstance->pdIsOPGet();
		$op_id = $ctPostInstance->pdOPIDGet();
		$type = $ctPostInstance->pdPostTypeGet();
		$realname = $ctPostInstance->pdPostRealNameGet();
		$userid = $ctPostInstance->pdPostUIDGet();
		$stmt->execute();
		$stmt->close();
		$connection->close();
		return 1; //success
	}
	else return 0;
}

function pdWithoutFileUpd($ctPostInstance) {
	include 'database.php';
	$stmt = $connection->prepare("INSERT INTO data (username, primtag, sectag, tertag, privacy,
								 file, title, post, votecount, is_op, op_id, type, userrealname, userid)
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("siiissssiiissi",$username, $primtag, $sectag, $tertag, $privacy, $file, $title, $post, $vc, $is_op, $op_id, $type, $realname, $userid);
	$username = $ctPostInstance->pdPostUsernameGet();
	$primtag = $ctPostInstance->pdPrimTagGet();
	$sectag = $ctPostInstance->pdSecTagGet();
	$tertag = $ctPostInstance->pdTerTagGet();
	$privacy = $ctPostInstance->pdPostPrivGet();
	$file = "NONE";
	$title = $ctPostInstance->pdPostTitleGet();
	$post = $ctPostInstance->pdPostDataGet();
	$vc = $ctPostInstance->pdVoteGet();
	$is_op = $ctPostInstance->pdIsOPGet();
	$op_id = $ctPostInstance->pdOPIDGet();
	$type = $ctPostInstance->pdPostTypeGet();
	$realname = $ctPostInstance->pdPostRealNameGet();
	$userid = $ctPostInstance->pdPostUIDGet();
	$stmt->execute();
	$stmt->close();
	$connection->close();
	return 1; //success
}

function entryExists($ID) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ID FROM data WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->execute();
	if ($stmt->fetch()==NULL) $flag = 0;
	else $flag = 1;
	$stmt->close();
	$connection->close();
	return $flag;
}

function currentVote($ID) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT vote FROM data WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->bind_result($result);
	$stmt->execute();
	$stmt->fetch();
	return $result;
}

function pdIncVote($ID, $margin) {
	include 'database.php';
	if (entryExists($ID) == 1) {
		$stmt = $connection->prepare("UPDATE data
									  SET vote = ?
									  WHERE ID = ?");
		$stmt->bind_param('ii',$newVote,$ID);
		$currentVote = currentVote($ID);
		if (is_integer($margin)) {
			$newVote = $currentVote + $margin;
		}
		$stmt->execute();
		return 1;
	}
	else return 0;
}
