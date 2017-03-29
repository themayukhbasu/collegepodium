<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	require 'session.php';
	include 'TokenMethod.php';
	$csrf = new csrfToken;
	$csrf->setToken();
	if (!isset($_SESSION['userid'])) header("location: login.php");
	?>
	<title>College Podium</title>
	<link href="Style/index_post_display.css" rel="stylesheet" type="text/css">
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" href="bs/css/bootstrap.min.css">
	<link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
	<script src="bs/js/bootstrap.min.js"></script>
	<script src="bs/js/bootbox.min.js"></script>
	<script src="js/headroom.min.js"></script>
	<script src="js/jQuery.headroom.min.js"></script>
	<link rel="stylesheet" href="Style/common.css">
	<link rel="stylesheet" href="Style/sidebar.css">

	<style>
		body { 
			padding-top: 63px; 
			background-color: #F0F0F0 !important;
		}
		
		.navbar-custom {
			background-color: #015657;
			border-color: #33CC66;
			margin-bottom: 0px !important;
			opacity: 0.9;
			transition: 1s ease;
		}
		.navbar-custom:active{
			opacity:1;
		}
		
		
		.glyphicon-chevron-up{
			font-size: 20px;
			color: #015657;
			padding:2px;
			border-radius: 5px;
			transition: color 0.5s ease;
		}
		
		.glyphicon-chevron-down{
			font-size: 20px;
			color: #015657; 
			padding:2px;
			border-radius: 5px;
			transition: color 0.5s ease;
		}
		
		.glyphicon-chevron-up:hover , .glyphicon-chevron-down:hover, .glyphicon-chevron-up:active , .glyphicon-chevron-down:active {
			color: black;
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
		
		#post_title{
				padding:0px;
		}
		
		.post-title{
			transition: color 0.5s ease;
			text-decoration:none !important;
			color: #5A5A5A !important;
			padding-bottom:0px;
		}
		.post-title:hover{
			color: #2D2D2D !important;
			border-bottom: #656565 2px solid !important;
			
		}
		
		.post-title p{
			margin:0px;
			padding:0px;
		}
	
		.divider-title{
			margin-top:2px;
			margin-bottom:10px;
		}
		.pop{
			display:inline;
		}
		#drawer, #dropdownMenu1 {
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
		  transition: all 0.5s ease-in-out;
		}
		
		
		
		.popover{
			width:150%;
		}
		.popover-content{
			background-color:white;
			#color:#D8D8D8;
			font-size:12.5px;
		}
		.popover-content label{
			font-weight:bold;
			font-size:14.5;
		}
		.post_primtag{
			line-height: 70%;
			padding-bottom:10px;
		}
		.post_sectag{
			line-height: 80%;
			padding-bottom:10px;
		}
		.post_tertag{
			line-height: 70%;
		}
		
		#col-draw {
			padding-top: 0px !important;
		}
		
		.drawer {
			padding-bottom: 0px !important;
		}
		
		#drawer:focus, #drawer:active, #dropdownMenu1:focus, #dropdownMenu1:active {
			outline: 0px !important;
		}
				
		#btn-draw, #settings-glyph {
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			-o-border-radius: 0px;
			border-radius: 0px;
			border: 0px;
		}
		
		#btn-draw: active, #btn-draw: focus{
			outline: 0px !important;
		}
		
		.same-line{
			display:inline !important;
		}
		
		.draw-label{
			font-family:Trench;
			font-size:25px;
			font-weight:bold;
			vertical-align:middle;
			padding-left:5px;
			padding-right: 5px;
			border-right: 2px solid #014D4E;
		}
				
		.draw-drop{
			font-size:30px;
			vertical-align:middle;
		}
		
	
		.drop{
			margin-top:12px;
			font-size: 25px;
			vertical-align:middle;
		}
		
		.drop2{
			font-size:15px;
			color:#014546;
			vertical-align: -150%;
			transition: color 0.5s ease;
		}
		
		.drop2:hover{
			color:white;
		}
		
		.container-fluid {
			margin: 0px !important;
			padding: 0px !important;
		}
		
	</style>

	<script src="main.js"></script>
	<script src="header.js"></script>

</head>

<body>
	
	<div class="container-fluid">
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

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<br/><br/><br/><br/>
						<hr/>
						<?php echo "Dear ".$_SESSION['name'].","; ?>
                        <h3>Thank you for your feedback, we will get back to you very shortly. If you don't hear from us within 7 days please mail us at mail@collegepodium.com</h3>
						<br/><br/>
						<p>Rgds<br/>
						College Podium Team</p>
						<hr/>
						<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<footer>© Copyright 2015 College Podium. All rights reserved.</footer>
					</div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

		</div>