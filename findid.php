<?php
include_once 'session.php';
if (!$_SESSION) header("location: login.php");
$post_id = (int)(htmlspecialchars($_GET['post_id']));
if (is_integer($post_id))  {
	//this checks if user has access to this discussion. needs to be updated when we update pull.php
	include 'database.php';
	$stmt = $connection->prepare("SELECT ID, is_op FROM data
								 WHERE ID = ?
								AND primtag = ?
								AND privacy <> ?");
	$stmt->bind_param( 'iii' , $postid , $primtag , $priv );
	$postid = $post_id;
	$primtag = $_SESSION['primtag'];
	$priv = -1;
	$stmt->bind_result($id, $isop);
	$stmt->execute();
	if ($stmt->fetch()==NULL) header("Location: index.php");
	if ($isop != 1) header("Location: index.php");
	else echo $post_id;
}
else header("Location: error.php"); 