<html>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
			
<title>CollegePodium- Free Platform for college students to share, collaborate - Login</title>
			

			
<script src="js/jquery.js"></script>
<script src="js/pace.min.js"></script>
<link rel="stylesheet" href="bs/css/bootstrap.min.css">
<link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
<script src="bs/js/bootstrap.min.js"></script>
<script src="bs/js/bootbox.min.js"></script>
<script src="header.js"></script>
<script src="js/headroom.min.js"></script>
<script src="js/jQuery.headroom.min.js"></script>
<link rel="stylesheet" type="text/css"rel="stylesheet" href="Style/common.css">
<link rel="stylesheet" type="text/css" media="all" href="Style/register.css"  />
<link rel="stylesheet" type="text/css" href="Style/pace.css">
<link rel="stylesheet" type="text/css" href="Style/sidebar.css">
<?php
	session_start();
	if ( isset($_SESSION['userid']) ) header("Location: index.php");
	if(!$_POST) {
		echo '
<body>
	<div class="container-fluid">
			<!-- ------------Navbar content-----------------------------
			---- This is the wrapper for navbar. When making a
			---- new page, do NOT modify the content inside
			---- The styles for this are inside this page (in style tags)
			---- The JS for toggling (and searching) is in header.js
			---  ----------------------------------------------------/!-->
			<div class="navbar navbar-custom navbar-fixed-top" role="navigation">
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw">		
						<div class="drawer">
							<button type="button" class="btn btn-default btn-lg" id="drawer">
								<span id="btn-draw" class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
							</button>
						</div>
					</div>
					<div class="col-sm-6 col-md-6" id="col-draw">
						<a id="head-link"href="index.php">college podium</a>
					</div>	
				</div>
			</div>
						
			<!-- ------------Content and Sidebar wrapper------------------
			---- This is the wrapper for sidebar and page content.
			---- The styles for this are in sidebar.css
			---  ----------------------------------------------------/!-->
					
			<div id="wrapper" class="toggled">
			
						
			<!-- ------------Sidebar wrapper------------------
			---- This is the wrapper for navbar. When making a
			---- new page, do NOT modify the content inside
			---- The styles for this are in sidebar.css
			---- The JS for the buttons is in common.js
			---- Add the class "thispage" to the <a> which the page represents
			---  ----------------------------------------------------/!-->
				<div id="sidebar-wrapper" class="sidebar-wrapper-login">
					<ul class="sidebar-nav">
						<li>
							<a href="register.php">sign up</a>
						</li>
						<li>
							<a href="login.php">log in</a>
						</li>
									
						<hr class="divider" />
									
						<li>
							<a href="intro-college-podium.php">a little intro</a>
						</li>
									
						<li>
							<a href="about-us.php">about us</a>
						</li>
									
						<hr class="divider" />
									
						<li>
							<a href="terms-conditions-college-podium.php">terms & conditions</a>
						</li>
									
									
						<li>
							<a href="privacy-policy-college-podium.php">privacy policy</a>
						</li>
						<hr class="divider" />
						<li>
							<p class="footnote">Copyright © 2015 College Podium. All rights reserved.</p>
						</li>
					</ul>
				</div>
				<!-- /#sidebar-wrapper -->
				
				<div class="login-form">
				<div class="row">	
					<div class="col-md-7 col-md-offset-1">
						<div class="register-form">
							<h1>log in</h1>
							<div id="register-form-main">
								<form   method="post">
									<div>
										<span class="same-line"><label>Username :</label></span>
										<input type="text" class="same-line" name="user" name="login_username" placeholder="Enter Your Email">  
									</div>
									<div>
										<span class="same-line"><label>Password :</label></span>
										<input type="password" class="same-line" name="pass" name="login_password" placeholder="Enter Your Password">
									</div>
									<div>
										<input type="submit" value="Log In">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-7 col-md-offset-1">
						<div class="not-register">
							<span="same-line"><label>haven\'t yet joined?</label></span>
							<span="same-line"><a href="register.php" style="text-align:center">come join us now!</a></span>
						</div>
					</div>
				</div>
				</div>
			</div>
			
	</div> 
	
</body>
		' ; 
	}
	else{
		if ( $_SESSION ) header("Location: index.php");
		$user = trim( $_POST['user'] );
		$pass = $_POST['pass'];
		include 'database.php' ;
		include 'ClassPassword.php';
		
		$stmt = $connection->prepare("SELECT ID, name, email, userlevel, level0tag, level1tag, level2tag, level3tag, salt, password FROM register WHERE email=?");
		
		$stmt->bind_param('s',$user);
		if (filter_var($user,FILTER_VALIDATE_EMAIL)) {
			$stmt->bind_result($ID, $name, $email, $userlevel, $tag[0], $tag[1], $tag[2], $tag[3], $salt, $hashpass);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
			
			$verified = Password::verifyUserPassword( $ID, $email, $pass );
			
			if ( $verified === 0 ) {
				echo '<script>$(document).ready( function() {
									bootbox.alert({ 
										size: "medium",
										message: "Incorrect password or email. Please retry.", 
										callback: function(){ 
											window.location.href = "redirect.php?return_to=userlogin";
										}
									});
								});
						</script>';
			} 
			else { 
				
				start($email,$ID, $name, $tag[0], $tag[1], $tag[2], $tag[3], $userlevel);
			}
		}
		else {
			echo '<script>$(document).ready( function() {
									bootbox.alert({ 
										size: "medium",
										message: "Incorrect email. Please retry.", 
										callback: function(){ 																					
											window.location.href = "redirect.php?return_to=userlogin";
										}
									});
								});
					</script>';
		}
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
		//$conn = new mysqli("mysql.hostinger.in","u204677655_root2","cybersoft","u204677655_anltc");
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
		header("Location: index.php");

	}


	?>

	<head>

			
	<style>
		body { 
			padding: 0px;
			padding-top: 63px; 
			background-color: #F0F0F0 !important;
			min-height: 100%;
		}
		.row {
			padding-right: 0px !important;
			margin-right: 0px !important;
		}
		html {
			padding: 0px !important;
			height: 100% !important;
		}
		
		#wrapper{
			background-image: url("resource/back.jpg");
			background-size: cover;
			max-width: 100%;
			height: 100%;
			padding-right: 0px;
		}
		.navbar-custom {
			background-color: #015657;
			border-color: #33CC66;
			margin-bottom: 0px !important;
		}
		.navbar-brand {
			color: black;
			font: 25px;
		}
		#head-link{
			color: white;
			text-decoration: none;
			font-size: 43px !important;
			font-family: Trench;
			font-weight: bolder;
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			padding-bottom: 0px !important;
			padding-top: 0px !important;
		}
		#drawer {
		  background-color: #015657 !important;
		  background-repeat: repeat-x;
		  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#015657", endColorstr="#015657");
		  background-image: -khtml-gradient(linear, left top, left bottom, from(#015657), to(#015657));
		  background-image: -moz-linear-gradient(top, #015657, #015657);
		  background-image: -ms-linear-gradient(top, #015657, #015657);
		  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #015657), color-stop(100%, #015657));
		  background-image: -webkit-linear-gradient(top, #015657, #015657);
		  background-image: -o-linear-gradient(top, #015657, #015657);
		  background-image: linear-gradient(#015657, #015657);
		  border: 0px;
		  color: #fff !important;
		  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.33);
		  -webkit-font-smoothing: antialiased;
		}
		
		#col-draw {
			padding-top: 0px !important;
		}
		
		.drawer {
			padding-bottom: 0px !important;
		}
		
		#drawer:focus, #drawer:active {
			outline: 0px !important;
		}
		
		#btn-draw {
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			-o-border-radius: 0px;
			border-radius: 0px;
			border: 0px;
		}
		
		#btn-draw: active, #btn-draw: focus{
			outline: 0px !important;
		}
		
		.container-fluid {
			margin: 0px !important;
			padding: 0px !important;
		}
		
	</style>
	</head>

	
	

</html>