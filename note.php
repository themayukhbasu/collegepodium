<?php
//include session
include_once 'session.php';
include 'TokenMethod.php';
if (!$_SESSION) header("location: login.php");
$csrf = new csrfToken;
if ( $csrf->validateToken( $_POST['csrftoken'] ) == 0 ) header( "Location: login.php" );
/*html form names
post_tag => tags (post)
post_priv => privacy
post_title => title
post_data => contents of post
file => file to be uploaded
*/

$ctDBSuccess = 0; //if db undate is a success, set 1 = true

include 'ctNoteData.php';
$ctNote = new ctNoteData;
$ctNote->ndNoteUsernameSet($_SESSION['user']);
$ctNote->ndNoteUIDSet($_SESSION['userid']);
$ctNote->ndPrimTagSet($_POST['primtag']);
$ctNote->ndSecTagSet($_POST['sectag']);
$ctNote->ndTerTagSet($_POST['tertag']);
$ctNote->ndQuarTagSet($_POST['quartag']);
$successTitle = $ctNote->ndNoteTitleSet($_POST['post_title']);
$successPost = $ctNote->ndNoteDataSet($_POST['post_data']);
$ctNote->ndNotePrivSet(0);
$ctNote->ndNoteTeacherSet($_POST['post_teacher']);
$ctNote->ndNoteSubjectSet($_POST['post_subject']);
$ctNote->ndNotePeriodSet($_POST['post_period']);
$ctNote->ndNoteRealNameSet($_SESSION['name']);
//no need to set is_op / op_id -> set by constructor

include_once 'fdDatabaseInsertNote.php';
$i = 0;
$uniqid = substr(bin2hex(openssl_random_pseudo_bytes(rand(1,999999))),0, 80);
if ( $successTitle != 0 && $successPost != 0 ) {
	if(!empty($_FILES['file']['name'][0])){
		while (isset($_FILES['file']['name'][$i])){
			$ctFile = new ctFileData;
			//check file and copy attribs from temp to upl_ variables
			$ctFile->fdFileNameSet($_FILES['file']['name'][$i]) ;
			$ctFile->fdFileSizeSet($_FILES['file']['size'][$i]);
			$ctFile->fdFileTypeSet($_FILES['file']['type'][$i]);
			$ctFile->fdFileTempNameSet($_FILES['file']['tmp_name'][$i]);
			$ctFile->fdFileErrorSet($_FILES['file']['error'][$i]);
			$ext = strtolower(strrchr($ctFile->fdFileNameGet(),'.')); //extract extension
			$ctFile->fdFileExtSet($ext);
			//$ctNote->ndFileDataSet($ctFile);
			//upload location is set anyway
			if (!empty($ctFile->fdFileNameGet()) && fileTypeMatch($ctFile) == 1 ){
				$ctDBSuccess = ndWithFileUnd($ctNote, $ctFile, $uniqid, $i);
			}
			$i++;
		}
	}
	else {
		$ctDBSuccess =  ndWithoutFileUnd($ctNote, $uniqid);
	}
		
	if ($ctDBSuccess == 1) header("Location: notes.php");
	else echo '<script>window.location.href = \'upload_notes.php?callback=bf\';</script>';
}
else echo '<script>window.location.href = \'upload_notes.php?callback=ot\';</script>';
