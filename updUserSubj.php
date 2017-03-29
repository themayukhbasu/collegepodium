<?php
include_once 'session.php';
include 'ctSubjectMethods.php';
foreach ($_POST as $value) {
	pushUserSubjectDB($value, $_SESSION['userid'], $_SESSION['sectag']);
}
header("Location: index.php");