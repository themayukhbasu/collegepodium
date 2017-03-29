<?php
class Password {
	
	public static function matchPassword( $enteredPass, $hashedPass, $salt ) {
		include 'database.php';
		$hash = hash( 'sha256', $salt . hash( 'sha256', $enteredPass ) );
		if ( $hash != $hashedPass ) 
			return 0;
		else return 1;
	}
	
	public static function getUserPassword( $userID = 0, $userEmail = '' ) {
		if ( $userID === 0 && $userEmail === '' ) return 0;
		include 'database.php';
		if ( $userID === 0 ) {
			$stmt = $connection->prepare("SELECT salt, password FROM register WHERE email=?");
			$stmt->bind_param( 's', $email );
		}
		elseif ( $userEmail === '' ) {
			$stmt = $connection->prepare("SELECT salt, password FROM register WHERE ID=?");
			$stmt->bind_param( 'i', $ID );
		}
		else {
			$stmt = $connection->prepare("SELECT salt, password FROM register WHERE email=? AND ID = ?");
			$stmt->bind_param( 'si', $email, $ID );
		}
		$email = $userEmail;
		$ID = $userID;
		
		$success = $stmt->execute();
		if ( !$success ) return 0;
		
		$result = $stmt->get_result();
		$arr = $result->fetch_array(MYSQLI_ASSOC);
		return $arr;
	}
	
	public static function verifyUserPassword( $userID = 0, $userEmail = '', $enteredPass ) {

		if ( $userID === 0 ) {
			$userPassword = self::getUserPassword( $userEmail );
		}
		elseif ( $userEmail === '' ) {
			$userPassword = self::getUserPassword( $userID );
		}
		else $userPassword = self::getUserPassword( $userID, $userEmail );
		
		if ( $userPassword === 0 ) return 0; //bad session details
		else {
			$verified = self::matchPassword( $enteredPass, $userPassword['password'], $userPassword['salt'] );
			if ( $verified === 0 ) return 0; //wrong password
			else return 1;
		}
		
		//if code comes here, something went wrong
		return 0;
	}
	public static function createSalt() {
		$salt = md5( uniqid( rand() , true ) );
		$salt = substr( $salt, 0, 5 );
		return $salt;
	}
		
	public static function hashPassword( $plainTextPass ) {
		$hashPass = hash( 'sha256' , $plainTextPass );
		$salt = self::createSalt();
		$password = hash('sha256', $salt . $hashPass);
		$passData = array( 'password' => $password,
						   'salt' => $salt );
		return $passData;
	}
}
		
class PasswordChange extends Password {
	private $userID;
	private $userEmail;
	
	public function __construct() {
		include_once 'session.php';
		if ( !isset( $_SESSION['userid'] ) ) {
			$this->userID = 0;
			$this->userEmail = '';
		}
		else if ( is_numeric($_SESSION['userid']) ) {
			$this->userID = $_SESSION['userid'];
			$this->userEmail = $_SESSION['user'];
		}
		return 1;
	}
	
	public function changePassword( $user, $type, $oldPassword, $newPassword ) {
		if ( is_numeric($user) && $user == 0 )
			$user = $this->userID;
		if ( $oldPassword == $newPassword || $verified = self::verifyUserPassword( $user, $this->userEmail, $oldPassword ))	{
			return 1; //no need to changePassword
		}
		$passwordData = self::hashPassword( $newPassword );
		include 'database.php';
		if ($type == 1)
			$stmt = $connection->prepare( "UPDATE register
									   SET password = ?, salt = ?
									   WHERE ID = ?" );
		else 
			$stmt = $connection->prepare( "UPDATE register
									   SET password = ?, salt = ?
									   WHERE email = ?" );
	
		$stmt->bind_param( 'sss', $pass, $salt, $uID );
		
		$uID = $user;
		$salt = $passwordData['salt'];
		$pass = $passwordData['password'];
		$success = $stmt->execute();
		if ( !$success ) return 0;
		else return 1;
	}
	public function hckPassword($user,$pass){
		include 'database.php';
		$passwordData = self::hashPassword($pass);
		$stmt = $connection->prepare( "UPDATE register
									   SET password = ?, salt = ?
									   WHERE ID = ?" );
		$stmt->bind_param( 'sss', $pass, $salt, $uID );
		
		$uID = $user;
		$salt = $passwordData['salt'];
		$pass = $passwordData['password'];
		$success = $stmt->execute();
		if ( !$success ) return 0;
		else return 1;
	}
}
		
		
		
	
	