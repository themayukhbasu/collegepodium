<?php
//include session
include_once 'session.php';
include 'TokenMethod.php';
include 'database.php';
if (!$_SESSION) header("location: login.php");
$csrf = new csrfToken;
if ( $csrf->validateToken( $_POST['csrftoken'] ) == 0 ) header( "Location: login.php" );
//include session

$ctDBSuccess = 0; //if successful = 1

$prep = $connection->prepare("SELECT ID, type, primtag, sectag, tertag, title, privacy FROM data WHERE ID = ?");
$prep->bind_param("i",$ID);
$ID = $_POST['post_id'];
$prep->bind_result($post_id, $post_type, $post_primtag, $post_sectag, $post_tertag, $post_title, $post_privacy);
$prep->execute();
$prep->fetch();
if (!is_null($post_id)) { 
	include 'ctPostData.php';
	$ctPost = new ctPostData;
	$ctPost->pdPostUsernameSet($_SESSION['user']);
	$ctPost->pdPostUIDSet($_SESSION['userid']);
	$ctPost->pdPostRealNameSet($_SESSION['name']);
	$ctPost->pdPostTypeSet($post_type);
	$ctPost->pdPrimTagSet($post_primtag);
	$ctPost->pdSecTagSet($post_sectag);
	$ctPost->pdTerTagSet($post_tertag);
	$ctPost->pdPostTitleSet($post_title);
	$success = $ctPost->pdPostDataSet($_POST['post_data']);
	if ( !$success ) {
		header("Location: posts.php?post_id=".(int)$ID);
	}
	else {
		$ctPost->pdPostPrivSet($post_privacy);
		$ctPost->pdIsOPSet(0);
		$ctPost->pdOPIDSet($post_id);
		
		include_once 'fd_database_insert.php';
		
		if(!empty($_FILES['file']['name'])){
			if (isset($_FILES['file']['name'])){
				$ctFile = new ctFileData;
				//check file and copy attribs from temp to upl_ variables
				$ctFile->fdFileNameSet($_FILES['file']['name']) ;
				$ctFile->fdFileSizeSet($_FILES['file']['size']);
				$ctFile->fdFileTypeSet($_FILES['file']['type']);
				$ctFile->fdFileTempNameSet($_FILES['file']['tmp_name']);
				$ctFile->fdFileErrorSet($_FILES['file']['error']);
				$ext = strtolower(strrchr($ctFile->fdFileNameGet(),'.')); //extract extension
				$ctFile->fdFileExtSet($ext);
				//$ctPost->pdFileDataSet($ctFile);
				//upload location is set anyway
				if (!empty($ctFile->fdFileNameGet())){
					$ctDBSuccess = pdWithFileUpd($ctPost, $ctFile);
				}	
			}
		}
		else {
			$ctDBSuccess =  pdWithoutFileUpd($ctPost);
		}
	}
	
}
if ($ctDBSuccess == 1) header("Location: posts.php?post_id=".$ID);

