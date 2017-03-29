<?php
include 'ClassPassword.php';
include 'session.php';
include 'TokenMethod.php';
$csrf = new csrfToken;
if ( !isset( $_POST['user']) && $csrf->validateToken( $_POST['csrftoken'] ) == 0 ) header( "Location: login.php" );
$changePassword = new PasswordChange;
if (is_numeric($_POST['user'])) $type = 1;
else $type = 0;
$verified = Password::verifyUserPassword($_SESSION['userid'],$_SESSION['user'],$_POST['current_pass']);
if($verified == 0){
	$success = 0;
}else{
	$success = $changePassword->changePassword( $_POST['user'], $type, $_POST['current_pass'], $_POST['new_pass'] );
}
echo $success;

if ( $success === 0 )
	echo '<script>window.location.href = \'change_password.php?callback=fail\';</script>';
elseif ( $success === -1 ) 
	echo '<script>window.location.href = \'change_password.php?callback=wrongpass\';</script>';
else 
	echo '<script>window.location.href = \'change_password.php?callback=success\';</script>';