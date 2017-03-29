<?php
if ( isset( $_GET['returnto'] ) ) {
	if ( $_GET['returnto'] === 'userlogin' )
		header("Location: login.php");
	else header("Location: index.php");
}
else header("Location: index.php");