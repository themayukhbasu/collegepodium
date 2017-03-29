
<?php
include_once 'session.php';
include 'TokenMethod.php';
include 'ctNoteData.php';
if ($_POST) {
	echo json_encode(ndFetchNote($_POST['primtag'], $_POST['sectag'], $_POST['tertag'], $_POST['valpass'])); 
}
elseif ($_GET) echo json_encode(ndFetchNote($_GET['primtag'], $_GET['sectag'], $_GET['tertag'], $_GET['valpass'])); 
$csrf = new csrfToken;
$csrf->setToken();
if (!isset($_SESSION['userid'])) header("location: login.php");
