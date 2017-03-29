<?php
include_once 'session.php';
include_once 'vsVoteMethods.php';
$pid = htmlspecialchars($_POST['discussid']);
$uid = $_SESSION['userid'];
$var = vsVoteDown($pid, $uid);
$pos = vsVoteCountPos($pid);
$neg = abs(vsVoteCountNeg($pid));
$arr = array(
		'neg' => "$neg",
		'pos' =>  "$pos",
	);
vsUpdateVotes($pid);
$json = json_encode($arr);
echo $json;