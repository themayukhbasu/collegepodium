<?php
include 'session.php';
include 'TokenMethod.php';

$csrf = new csrfToken();
if ( $csrf->validateToken( $_POST['csrftoken'] ) == 0 ) echo '0';
else {
	include 'ctPostData.php';
	$result = pdDeletePost( $_POST['post_id'] );
	echo $result;
}