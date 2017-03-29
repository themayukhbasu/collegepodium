<?php
echo "<br/>DEBUG 1";
//include session
include 'session.php';
include 'TokenMethod.php';
if (!isset($_SESSION['userid'])) header("location: login.php");

$csrf = new csrfToken;
if ( $csrf->validateToken( $_POST['csrftoken'] ) == 0 ) header( "Location: login.php" );
/*html form names
post_tag => tags (post)
post_priv => privacy
post_title => title
post_data => contents of post
file => file to be uploaded
*/

$ctDBSuccess = 0; //if db update is a success, set 1 = true

include 'ctPostData.php';


$ctPost = new ctPostData;


$ctPost->pdPostUsernameSet($_SESSION['user']);
$ctPost->pdPostUIDSet($_SESSION['userid']);
$ctPost->pdPostTypeSet($_POST['post_type']);
$ctPost->pdPrimTagSet($_SESSION['primtag']);
$ctPost->pdSecTagSet($_SESSION['sectag']);
$ctPost->pdTerTagSet($_SESSION['tertag']);
$successTitle = $ctPost->pdPostTitleSet($_POST['post_title']);
$successPost = $ctPost->pdPostDataSet($_POST['post_data']);
$ctPost->pdPostPrivSet($_POST['post_priv']);
$ctPost->pdPostRealNameSet($_SESSION['name']);
//no need to set is_op / op_id -> set by constructor
echo"<br/> DEBUG 4";

include_once 'fd_database_insert.php';
if ( $successTitle != 0 && $successPost != 0 ) {
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
			echo "<br/> DEBUG 5";
			if (!empty($ctFile->fdFileNameGet()) && fileTypeMatch($ctFile) == 1 )	{
				$ctDBSuccess = pdWithFileUpd($ctPost, $ctFile);
				echo "<br/> DEBUG 6";
			}
			else trigger_error("Cannot upload file",E_USER_ERROR);
		}
	}
	else {
		$ctDBSuccess =  pdWithoutFileUpd($ctPost);
	}
echo"<br/>DEBUG 3";	
	if ($ctDBSuccess == 1) header("Location: index.php");
	else trigger_error("Database error",E_USER_ERROR);
}

else header("Location: static_upload.php");
echo"<br/> DEBUG 2";
?>
