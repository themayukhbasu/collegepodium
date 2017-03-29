
<?php
include_once 'session.php';
include 'TokenMethod.php';
include 'ctNoteData.php';
$csrf = new csrfToken;
//$csrf->validateToken();
if (!isset($_SESSION['userid'])) header("location: login.php");
if ( isset( $_GET['primtag'] ) ) echo json_encode(ndFetchNote($_GET['primtag'], $_GET['sectag'], $_GET['tertag'], $_GET['valpass']));
else echo json_encode(ndFetchNote($_SESSION['primtag'], $_SESSION['sectag'], $_SESSION['tertag'], $_GET['valpass']));

