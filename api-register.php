<?php
	include 'ctUserClass.php';
	$flag = 1;
	if ( !isset($_POST['name']) ) $flag = 0;
	if ( !isset($_POST['email'])) $flag = 0;
	if (!isset($_POST['country'])) $flag = 0;
	if (!isset($_POST['sex'])) $flag = 0;
	if (!isset($_POST['dob'])) $flag = 0;
	if (!isset($_POST['contact_number'])) $flag = 0;
	if (!isset($_POST['university'])) $flag = 0;
	if (!isset($_POST['college'])) $flag = 0;
	if (!isset($_POST['course'])) $flag = 0;
	if (!isset($_POST['sem'])) $flag = 0;
	if($flag === 0)
	    header("Location:error.php");
	$ctUser = new ctUserData;
	$ctUser->udNameSet($_POST['name']);
	$ctUser->udEmailSet($_POST['email']);
	$ctUser->udCountrySet($_POST['country']);
	$ctUser->udSexSet($_POST['sex']);
	$ctUser->udDOBSet($_POST['dob']);
	$ctUser->udContactNoSet($_POST['contact_number']);
	
	$ctTagList = new ctUserTagList;
	//this is where country specific php will be included. for now, writing india specific code
	//preliminary: fields will have ID numbers. Need to make SQL calls and check the ID from name of univ/college etc in future

	$ctTagList->tlLevel0Set($_POST['university']);
	
	$ctTagList->tlLevel1Set($_POST['college']);
	$ctTagList->tlLevel2Set($_POST['course']);
	$ctTagList->tlLevel3Set($_POST['sem']);
	
	$ctUser->udTagListSet($ctTagList);
	
	
	include 'checkdupe.php';
	//let's check for dupes first
	if (checkdupe($ctUser)===1) {
		include 'database.php';
		include 'ClassPassword.php';
		$stmt = $connection->prepare("INSERT INTO register(email, password, country, dob, sex, name, contactno, salt, 
															level0tag, level1tag, level2tag, level3tag)
									  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssssssss",$email, $password, $country, $DOB, $sex, $name, $contactno, $salt, $taglist0, $taglist1, $taglist2, $taglist3);
		$email = $ctUser->udEmailGet();
		$country = $ctUser->udCountryGet();
		$DOB = $ctUser->udDOBGet();
		
		$passData = Password::hashPassword( $_POST['password'] );
		$salt = $passData['salt'];
		$password = $passData['password'];
		$sex = $ctUser->udSexGet();
		$name = $ctUser->udNameGet();
		$contactno = $ctUser->udContactNoGet();
		$taglist0 = $ctUser->udTagListGet()->tlLevel0Get();
		$taglist1 = $ctUser->udTagListGet()->tlLevel1Get();
		$taglist2 = $ctUser->udTagListGet()->tlLevel2Get();
		$taglist3 = $ctUser->udTagListGet()->tlLevel3Get();
		if ($stmt->execute()==false) {
			trigger_error("Could not register username",E_USER_NOTICE);
			//header("Location: register.php");
		}
		else {
			$stmt->close();
			
			
			$stmt = $connection->prepare("SELECT ID, name, email, userlevel, level0tag, level1tag, level2tag, level3tag, salt, password FROM register WHERE email=?");
		
			$stmt->bind_param('s',$user);
			$user = $email;
			if (filter_var($user,FILTER_VALIDATE_EMAIL)) {
				$stmt->bind_result($ID, $name, $email, $userlevel, $tag[0], $tag[1], $tag[2], $tag[3], $salt, $hashpass);
				$stmt->execute();
				$stmt->fetch();
				$stmt->close(); 
			//header("Location: login.php");
			start($email,$ID, $name, $tag[0], $tag[1], $tag[2], $tag[3], $userlevel);
			}
		}
	}
	else {
		header("Location: error.php");
	//need to check dupes later
	}
	
	function start($email, $ID, $name, $primtag, $sectag, $tertag, $quartag, $userlevel) {

		session_start();
		$_SESSION['user']=$email;
		$_SESSION['userid']=$ID;
		$_SESSION['name']=$name;
		$_SESSION['primtag']=$primtag;
		$_SESSION['sectag']=$sectag;
		$_SESSION['tertag']=$tertag;
		$_SESSION['quartag']=$quartag;
		$_SESSION['userlevel']=$userlevel;
		$_SESSION['csrftoken']=base64_encode( openssl_random_pseudo_bytes(32));
		$_SESSION['tokentime']=time();
		include 'ctNoteData.php';
		ndListSavedNotes($_SESSION['userid']);
		$conn = new mysqli("localhost","root","cool123","analytics_db");
				if ($conn->connect_error) {
					die("Failed: analytics_db_db || ERROR : " . $conn->connect_error);
				}
				
				$stmt = $conn->prepare("INSERT INTO login (`userID`, `sessionID`, `userIP`) VALUES (?,?,?)");
				$stmt->bind_param('iss',$uID,$sID,$uIP);
				$uID = $ID;
				$sID = session_id();
				$uIP = $_SERVER['REMOTE_ADDR'];
				
				$stmt->execute();
				$stmt->close();
		echo "\n redirecting ";
		header("Location: add-subjects.php");

	}
?>

