<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>College Podium</title>
	<script src="js/jquery.js"></script>
	<script src='js/node_modules/autosize/src/autosize.js'></script>
	<link rel="stylesheet" href="bs/css/bootstrap.min.css">
	<link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
	<script src="bs/js/bootstrap.min.js"></script>
	<script src="bs/js/bootbox.min.js"></script>
	<script src="js/headroom.min.js"></script>
	<script src="js/jQuery.headroom.min.js"></script>
	<link rel="stylesheet" href="Style/common.css">
	<link rel="stylesheet" href="Style/sidebar.css">
	<link href="Style/upload.css" rel="stylesheet" type="text/css">
	<?php
		include_once 'session.php';
		include 'TokenMethod.php';
		$csrf = new csrfToken;
		$csrf->setToken();
		if (!isset($_SESSION['userid'])) header("location: login.php");	
		include 'database.php';
		$id = $_GET['id'];
		$type = $_GET['type'];
		if(isset($_POST['comment'])){
			$comment = $_POST['comment'];
			$stmt = $connection->prepare("INSERT INTO `report`(`userID`, `postID`, `postType`, `comment`) VALUES (?,?,?,?)");
			$stmt->bind_param('iiss',$uid,$pid,$ptype,$cmnt);
			$uid = $_SESSION['userid'];
			$pid = $id;
			$ptype = $type;
			$cmnt = $comment;
			$success = $stmt->execute();
			$stmt->close();
			if($success)
				header("location: acknowledge.php");
				//echo "<script type='text/javascript'>alert('Thank you for your feedback, we will get back to you very shortly. If you don't hear from us within 7 days please mail us at mail@collegepodium.com');</script>";

				//alert("<p>Thank you for your feedback, we will get back to you very shortly. If you don't hear from us within 7 days please mail us at mail@collegepodium.com</p>");
		}
	
	?>
	<script>
	$(document).ready( function () {
		autosize(document.querySelectorAll('textarea'));
		function parse(val) {
			var result = '', tmp = [];
			location.search
				.substr(1)
				.split("&")
				.forEach(function (item) {
					tmp = item.split("=");
					if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
				});
			return result;
		}
		
		var callback = parse( 'callback' );
		if ( callback === 'fail' )
			$('.upload-error').prepend('<div class="alert alert-danger inline" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Could not post feedback. This might be due to database error or bad file uploaded.</div>');
		else if ( callback === 'success' ) {
			$('.container-fluid').toggle();
			bootbox.alert({ 
				size: 'medium',
				message: "Your feedback was posted. We will be getting back to you shortly. To contact us, please email at mail@collegepodium.com", 
				callback: function(){ 
					window.location = 'index.php';
				}
			})
		}
		$(document).on("click", ".upload-sign", function() {
			$('#upload_inp').click();
		});
	});
	</script>

	<style>
		body { 
			padding-top: 63px; 
			background-color: #F0F0F0 !important;
		}
		#upload-wrap {
			height: 0px;width: 0px; overflow:hidden;
			padding: 0px; margin: 0px;
			float: left;
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
		
		#btn-draw {
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			-o-border-radius: 0px;
			border-radius: 0px;
			border: 0px;
		}
		.container-fluid {
			margin: 0px !important;
			padding: 0px !important;
		}
		.glyphicon-cloud-upload{
			border: #9C9C9C 2px solid !important;
			border-radius: 5px !important;
			padding:2px !important;
			padding-bottom: 5px !important;
			font-size: 40px !important;
			color: #9C9C9C !important;
			transition: all 0.5s ease;
		}
		.glyphicon-cloud-upload:hover{
			border: #5E5E5E 2px solid !important;
			cursor:pointer;
			color: #5E5E5E !important;
		}
	</style>

	<script src="header.js"></script>
	
</head>

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
						 <span id="btn-draw" class="glyphicon glyphicon-menu-hamburger draw-drop" aria-hidden="true"></span><span class="draw-label">drawer</span>
						</button>
					</div>
				</div>
				<div class="col-sm-7 col-md-7" id="col-draw">
					<a id="head-link"href="index.php">college podium</a>
				</div>
				<div class="col-sm-2 col-md-2">
					<div class="dropdown">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
						<span class="glyphicon glyphicon-log-out drop" aria-hidden="true" id="settings-glyph"></span>
						<span class="glyphicon glyphicon-triangle-bottom drop2" aria-hidden="true" id="settings-glyph">
					  </button>
					  <ul class="dropdown-menu dropdown-menu-left" role="menu" aria-labelledby="dropdownMenu1">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="userdata.php">My Account</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="change_password.php">Change Password</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="upload_feedback.php">Feedback</a></li>
						<hr class="row">
						<li role="presentation"><a role="menuitem" tabindex="-1" id="settings-logout" href="#">Logout</a></li>
					  </ul>
					</div>
				</div>	
			</div>
		</div>
		<div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="upload_notes.php">upload notes</a>
                </li>
                <li>
                    <a href="static_upload.php?type=notice">post a notice</a>
                </li>
                <li>
                    <a href="static_upload.php?type=query">post a query</a>
                </li>
                <li>
                    <a href="static_upload.php?type=discuss">start a discussion</a>
                </li>
				<hr class="divider" />
                
				<li>
                    <a href="index.php?type=notice" class="sidebar-notice">notice</a>
                </li>
                <li>
                    <a href="index.php?type=query" class="sidebar-query">query</a>
                </li>
                <li>
                    <a href="index.php?type=discuss" class="sidebar-discussion">discussions</a>
                </li>
                
				<hr class="divider" />
				
				<li>
                    <a href="index.php" class="thispage">all posts</a>
                </li>
				
				<li>
                    <a href="notes.php">all notes</a>
                </li>
				
				<hr class="divider" />
				
				<li>
                    <a href="#" id="logout" class="sidebar-logout">log out</a>
                </li>
				<hr class="divider" />
				<li>
				<p class="footnote">Copyright © 2015 College Podium. All rights reserved.</p>
				</li>
				<input type="hidden" value="<?php echo($_SESSION['csrftoken']); ?>" id="sidebar-token">
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		
		 <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<div id="upload-form-wrap" class="col-md-10">
							<div class="upload-error"></div>
							<div class="upload-form">
							<form action="#" method="POST" enctype="multipart/form-data" id="uploadimage"> 
								<h1>Report Content</h1>
								<div id="upload-form-main" class="page-content">			
									
									<div>
										<span class="same-line"><label class="text-top">Description and comments:</label></span> 
										<textarea name="comment" class="same-line" required></textarea>
									
									</div>
									<!--<input type="hidden" name="comment" value='<?php //echo($id); ?>'/>
									<input type="hidden" name="type" value='<?php //echo($type); ?>'/> -->

									<input type="hidden" name="csrftoken" value='<?php echo($_SESSION['csrftoken']); ?>'/>
									<div class="form-group">
										<input type="submit" value="Post" class="submit" id ="submit"></input>
									</div >
								</div>
							</form>
						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	 </div>	

</body>
</html>
