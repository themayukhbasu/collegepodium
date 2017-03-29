<?php
include 'vsVoteMethods.php';
include_once 'session.php';
$pid = htmlspecialchars($_POST['discussid']);
echo abs(vsVoteCountNeg($pid));