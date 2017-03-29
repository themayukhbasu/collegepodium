<?php
include 'database.php';


if ($_GET['vote']==1) {	
	$stmt = $connection->prepare("SELECT vote_val FROM votedata WHERE user_id = ? AND post_id = ?");
	$stmt->bind_param('si',$user, $pid);
	$user = $_GET['user'];
	$pid = $_GET['id'];
	$stmt->bind_result($vote_val);
	$flag = 1;
	$stmt->execute();
	if ($stmt->fetch()==false) $flag = 0;
	$stmt->close();
	if ($flag == 1) {
		if ($vote_val != 1) {
			include 'database.php';
			$stmt = $connection->prepare("UPDATE votedata
										  SET vote_val = 1
										  WHERE user_id = ? AND post_id = ?");
			$stmt->bind_param('si', $user, $pid);
			$stmt->execute();
			$stmt->close();
				
			echo votecount($pid);
		}
	}
	else {
		$stmt = $connection->prepare("INSERT INTO votedata (user_id, post_id, vote_val)
									  VALUES (?, ?, ?)");
		$stmt->bind_param('sii',$user,$pid,$voteval);
		$user = $_GET['user']; $pid = $_GET['id'];
		$voteval = 1;
		$stmt->execute();
		$stmt->close();
		echo votecount($pid);
	}
}
else {
	$stmt = $connection->prepare("SELECT vote_val FROM votedata WHERE user_id = ? AND post_id = ?");
	$stmt->bind_param('si',$user, $pid);
	$user = $_GET['user'];
	$pid = $_GET['id'];
	$stmt->bind_result($vote_val);
	$flag = 1;
	$stmt->execute();
	if ($stmt->fetch()==false) $flag = 0;
	$stmt->close();
	if ($flag == 1) {
		if ($vote_val != -1) {
			include 'database.php';
			$stmt = $connection->prepare("UPDATE votedata
										  SET vote_val = -1
										  WHERE user_id = ? AND post_id = ?");
			$stmt->bind_param('si', $user, $pid);
			$stmt->execute();
			$stmt->close();	
			echo votecount($pid);
		}
	}
	else {
		$stmt = $connection->prepare("INSERT INTO votedata (user_id, post_id, vote_val)
									  VALUES (?, ?, ?)");
		var_dump($stmt);
		$stmt->bind_param('sii',$user,$pid,$voteval);
		$user = $_GET['user']; $pid = $_GET['id'];
		$voteval = -1;
		$stmt->execute();
		$stmt->close();
		echo votecount($pid);
	}
}

function votecount ($post_id) {
	include 'database.php';
	$stmt=$connection->prepare("SELECT SUM(vote_val) FROM votedata WHERE post_id = ?");
	$stmt->bind_param('i', $pid);
	$pid = htmlspecialchars($post_id);
	$stmt->bind_result($votes);
	$stmt->execute();
	$stmt->fetch();
	$stmt->close();
	return $votes;
}

function uservoted ($post_id, $user_id) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT vote_val FROM votedata WHERE post_id = ? AND user_id = ?");
	$stmt->bind_param('ii', $pid, $uid);
	$pid = htmlspecialchars($post_id);
	$uid  = htmlspecialchars($user_id);
	$stmt->bind_result($voteval);
	$stmt->execute();
	if ($stmt->fetch()==false) return false;
	elseif ($voteval != 1 && $voteval != -1) return false;
	else return true;
}

$voted = uservoted(1, 32);
if ($voted === true) echo 'voted';
else echo 'nope';