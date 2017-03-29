<?php
require_once ("ctNoteData.php");
require_once ("ctFileData.php");


function ndWithFileUnd($ntNoteInstance, $ntFileInstance, $uniqid, $i) {
	include 'database.php';
	$fileUploadLocation = ($ntFileInstance->fdUploadLocGet()).($ntFileInstance->fdFileNameGet());
	if (move_uploaded_file($ntFileInstance->fdFileTempNameGet(), $fileUploadLocation)) {
		if($i==0){	
			$stmt = $connection->prepare("INSERT INTO notes (username, 
															hash, file, title, data, is_op, op_id, userrealname, userid, teacher, subject, period)
										   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssissiisisss",$username, $id, $filevar, $title, $post,  $is_op, $op_id, $realname, $userid, $teacher, $subject, $period);
			$username = $ntNoteInstance->ndNoteUsernameGet();
			$primtag = $ntNoteInstance->ndPrimTagGet();
			$sectag = $ntNoteInstance->ndSecTagGet();
			$tertag = $ntNoteInstance->ndTerTagGet();
			$privacy = $ntNoteInstance->ndNotePrivGet();
			$filevar = 1;
			$id = $uniqid; //this is a randomly generated token
			$title = $ntNoteInstance->ndNoteTitleGet();
			$post = $ntNoteInstance->ndNoteDataGet();
			$vote = $ntNoteInstance->ndVoteGet();
			$is_op = $ntNoteInstance->ndIsOPGet();
			$op_id = $ntNoteInstance->ndOPIDGet();
			$realname = $ntNoteInstance->ndNoteRealNameGet();
			$userid = $ntNoteInstance->ndNoteUIDGet();
			$teacher = $ntNoteInstance->ndNoteTeacherGet();
			$subject = $ntNoteInstance->ndNoteSubjectGet();
			$period = $ntNoteInstance->ndNotePeriodGet();
			$stmt->execute();
			$stmt->close();
		}
		//token matching here
		$stmt = $connection->prepare("SELECT ID from notes WHERE hash = ?");
		$stmt->bind_param('s',$fileid);
		$fileid = $uniqid;
		$stmt->execute();
		$stmt->bind_result($nid);
		$stmt->fetch();
		$stmt->close();
		$stmt = $connection->prepare("INSERT INTO notefile (note_id, note_file) VALUES (?, ?)");
		$stmt->bind_param('is', $noteid, $notefile);
		$noteid = $nid;
		$notefile = $fileUploadLocation;
		$stmt->execute();
		$stmt->close();
		if ($i == 0) {
			$stmt = $connection->prepare("INSERT into noteintended (note_id, note_tag, note_tag_level) VALUES (?, ?, ?)");
			$stmt->bind_param('iii', $intnoteid, $notetag, $notetaglevel);
			$intnoteid = $nid;
			$notetag = $ntNoteInstance->ndPrimTagGet(); 
			$notetaglevel = 0;
				if ($ntNoteInstance->ndSecTagGet() == -1) {
				$notetag = $ntNoteInstance->ndPrimTagGet(); 
				$notetaglevel = 0;
				$stmt->execute();
				$stmt->close();
				$connection->close();
				return 1;
			}
			if ($ntNoteInstance->ndTerTagGet() == -1) {
				$notetag = $ntNoteInstance->ndSecTagGet();
				$notetaglevel = 1;
				$stmt->execute();
				$stmt->close();
				$connection->close();
				return 1;
			}
			if ($ntNoteInstance->ndQuarTagGet() == 0) {
				$notetag = $ntNoteInstance->ndTerTagGet();
				$notetaglevel = 2;
				$stmt->execute();
				$stmt->close();
				$connection->close();
				return 1;
			}
			if ($ntNoteInstance->ndQuarTagGet() != 0) {
				$notetag = $ntNoteInstance->ndQuarTagGet();
				$notetaglevel = 3;
				$stmt->execute();
				$stmt->close();
				$connection->close();
				return 1;
			}
			$stmt->execute();
			$stmt->close();
		}
		$connection->close();	
		return 1; //success
	}	
	else return 0;
}

function ndWithoutFileUnd($ntNoteInstance, $uniqid) {
	include 'database.php';
	$stmt = $connection->prepare("INSERT INTO notes (username, hash,
															file, title, data, is_op, op_id, userrealname, userid, teacher, subject, period)
										   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssissiisisss",$username, $hash, $filevar, $title, $post,  $is_op, $op_id, $realname, $userid, $teacher, $subject, $period);
	$username = $ntNoteInstance->ndNoteUsernameGet();
	$primtag = $ntNoteInstance->ndPrimTagGet();
	$sectag = $ntNoteInstance->ndSecTagGet();
	$tertag = $ntNoteInstance->ndTerTagGet();
	$privacy = $ntNoteInstance->ndNotePrivGet();
	$hash = $uniqid;
	$filevar = 0;
	$title = $ntNoteInstance->ndNoteTitleGet();
	$post = $ntNoteInstance->ndNoteDataGet();
	$is_op = $ntNoteInstance->ndIsOPGet();
	$op_id = $ntNoteInstance->ndOPIDGet();
	$realname = $ntNoteInstance->ndNoteRealNameGet();
	$userid = $ntNoteInstance->ndNoteUIDGet();
	$teacher = $ntNoteInstance->ndNoteTeacherGet();
	$subject = $ntNoteInstance->ndNotesubjectGet();
	$period = $ntNoteInstance->ndNotePeriodGet();
	$stmt->execute();
	$stmt->close();
	$stmt = $connection->prepare("SELECT ID from notes WHERE hash = ?");
	$stmt->bind_param('s',$fileid);
	$fileid = $uniqid;
	$stmt->execute();
	$stmt->bind_result($nid);
	$stmt->fetch();
	$stmt->close();
	$stmt = $connection->prepare("INSERT into noteintended (note_id, note_tag, note_tag_level) VALUES (?, ?, ?)");
	$stmt->bind_param('iii', $intnoteid, $notetag, $notetaglevel);
	$intnoteid = $nid;
	if ($ntNoteInstance->ndSecTagGet() == -1) {
		$notetag = $ntNoteInstance->ndPrimTagGet(); 
		$notetaglevel = 0;
		$stmt->execute();
		$stmt->close();
		$connection->close();
		return 1;
	}
	if ($ntNoteInstance->ndTerTagGet() == -1) {
		$notetag = $ntNoteInstance->ndSecTagGet();
		$notetaglevel = 1;
		$stmt->execute();
		$stmt->close();
		$connection->close();
		return 1;
	}
	if ($ntNoteInstance->ndQuarTagGet() == 0) {
		$notetag = $ntNoteInstance->ndTerTagGet();
		$notetaglevel = 2;
		$stmt->execute();
		$stmt->close();
		$connection->close();
		return 1;
	}
	if ($ntNoteInstance->ndQuarTagGet() != 0) {
		$notetag = $ntNoteInstance->ndQuarTagGet();
		$notetaglevel = 3;
		$stmt->execute();
		$stmt->close();
		$connection->close();
		return 1;
	}
	return 0; //success
}

function entryExists($ID) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT ID FROM notes WHERE ID = ?");
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
	$stmt = $connection->prepare("SELECT vote FROM notes WHERE ID = ?");
	$stmt->bind_param('i',$ID);
	$stmt->bind_result($result);
	$stmt->execute();
	$stmt->fetch();
	return $result;
}

