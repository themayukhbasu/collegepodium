<?php
include_once 'session.php';
include_once 'vsVoteMethods.php';
$pid = htmlspecialchars($_POST['discussid']);
$uid = $_SESSION['userid'];
$var = vsVoteUp($pid, $uid);
echo vsVoteCount($pid);