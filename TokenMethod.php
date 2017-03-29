<?php
class csrfToken {
	
	public static function setToken() {
		$elapsedTime = time() - $_SESSION['tokentime'];
		if ( $elapsedTime >= 3600 ) {
			$_SESSION['csrftoken'] = base64_encode( openssl_random_pseudo_bytes(32));
			$_SESSION['tokentime'] = time();
			return 0;
		}
		else return 1;
	}
	
	public static function getToken() {
		return $_SESSION['csrftoken'];
	}
	
	public static function validateToken( $token ) {
		if ( self::setToken() == 1 && $token == $_SESSION['csrftoken'] ) return 1;
		else return 0;
	}

}