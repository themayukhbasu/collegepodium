<?php

function vsVoteUp ($post_id, $user_id) {
	if (vsUserVoted($post_id, $user_id) == true) {
		if (vsUserVote($post_id, $user_id) != 1) {
			include 'database.php';
			$stmt = $connection->prepare("UPDATE votedata
										  SET vote_val = 1
										  WHERE user_id = ? AND post_id = ?");
			$stmt->bind_param('ii', $uid, $pid);
			$uid = htmlspecialchars($user_id);
			$pid = htmlspecialchars($post_id);	
			$stmt->execute();
			$stmt->close();
			return vsVoteCountPos($pid);
		}
	}
	else {
		include 'database.php';
		$stmt = $connection->prepare("INSERT INTO votedata (user_id, post_id, vote_val)
									  VALUES (?, ?, ?)");
		$stmt->bind_param('iii',$uid,$pid,$voteval);
		$uid = htmlspecialchars($user_id);
		$pid = htmlspecialchars($post_id);
		$voteval = 1;
		$stmt->execute();
		$stmt->close();
		return vsVoteCountPos($pid);
	}
}

function vsVoteDown ($post_id, $user_id) {
	if (vsUserVoted($post_id, $user_id) == true) {
		if (vsUserVote($post_id, $user_id) != -1) {
			include 'database.php';
			$stmt = $connection->prepare("UPDATE votedata
										  SET vote_val = -1
										  WHERE user_id = ? AND post_id = ?");
			$stmt->bind_param('ii', $uid, $pid);
			$uid = htmlspecialchars($user_id);
			$pid = htmlspecialchars($post_id);	
			$stmt->execute();
			$stmt->close();
			return vsVoteCountNeg($pid);
		}
	}
	else {
		include 'database.php';
		$stmt = $connection->prepare("INSERT INTO votedata (user_id, post_id, vote_val)
									  VALUES (?, ?, ?)");
		$stmt->bind_param('iii',$uid,$pid,$voteval);
		$uid = htmlspecialchars($user_id);
		$pid = htmlspecialchars($post_id);
		$voteval = -1;
		$stmt->execute();
		$stmt->close();
		return vsVoteCountNeg($pid);
	}
}

function vsVoteCountPos ($post_id) {
	include 'database.php';
	$stmt=$connection->prepare("SELECT SUM(vote_val) FROM votedata WHERE post_id = ? AND vote_val = ?");
	$stmt->bind_param('ii', $pid, $vote);
	$pid = htmlspecialchars($post_id);
	$vote = 1;
	$stmt->bind_result($votes);
	$stmt->execute();
	if ($stmt->fetch()==false) return 0;
	$stmt->close();
	if ($votes == NULL) return 0;
	return $votes;
}

function vsVoteCountNeg ($post_id) {
	include 'database.php';
	$stmt=$connection->prepare("SELECT SUM(vote_val) FROM votedata WHERE post_id = ? AND vote_val = ?");
	$stmt->bind_param('ii', $pid, $vote);
	$pid = htmlspecialchars($post_id);
	$vote = -1;
	$stmt->bind_result($votes);
	$stmt->execute();
	if ($stmt->fetch()==false) return 0;
	$stmt->close();
	if ($votes == NULL) return 0;
	return $votes;
}

function vsVoteCount ($post_id) {
	include 'database.php';
	$stmt=$connection->prepare("SELECT SUM(vote_val) FROM votedata WHERE post_id = ?");
	$stmt->bind_param('i', $pid);
	$pid = htmlspecialchars($post_id);
	$stmt->bind_result($votes);
	$stmt->execute();
	if ($stmt->fetch()==false) return 0;
	$stmt->close();
	if ($votes == NULL) return 0;
	return $votes;
}

function vsUserVote ($post_id, $user_id) {
	include 'database.php';
	$stmt = $connection->prepare("SELECT vote_val FROM votedata WHERE post_id = ? AND user_id = ?");
	$stmt->bind_param('ii', $pid, $uid);
	$pid = htmlspecialchars($post_id);
	$uid  = htmlspecialchars($user_id);
	$stmt->bind_result($voteval);
	$stmt->execute();
	if ($stmt->fetch()==false) return 0;
	elseif ($voteval != 1 && $voteval != -1) return 0;
	else return $voteval;
}

function vsUserVoted ($post_id, $user_id) {
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

function vsUpdateVotes($post_id) {
	include 'database.php';
	$stmt = $connection->prepare("UPDATE data SET votecount = ? WHERE ID = ?");
	$stmt->bind_param('ii', $vc, $pid);
	$vc = vsVoteCountPos($post_id) + vsVoteCountNeg($post_id);
	$pid = $post_id;
	$stmt->execute();
	return true;
}
