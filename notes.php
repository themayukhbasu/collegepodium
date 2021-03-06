<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>College Podium</title>
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" href="bs/css/bootstrap.min.css">
	<link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
	<script src="bs/js/bootstrap.min.js"></script>
	<script src="bs/js/bootbox.min.js"></script>
	<script src="js/headroom.min.js"></script>
	<script src="js/jQuery.headroom.min.js"></script>
	<script src="js/slider/jquery.bxslider.min.js"></script>
	<link href="js/slider/jquery.bxslider.css" rel="stylesheet" />
	<link rel="stylesheet" href="Style/common.css">
	<link rel="stylesheet" href="Style/sidebar.css">
	<link rel="stylesheet" href="Style/notes.css">
	<script src="notes.js"></script>
	<script src="header.js"></script>
	
	<?php
		require_once 'session.php';
		include 'TokenMethod.php';
		$csrf = new csrfToken;
		$csrf->setToken();
		if (!isset($_SESSION['userid'])) header("location: login.php");
	?>
	
	<style>
		.bootbox.modal > .modal-dialog {
			z-index: 10000 !important;
		}
		body { 
			padding-top: 63px; 
			background-color: #e9eaed !important;
		}
		
		.navbar-custom {
			background-color: #015657;
			border-color: #33CC66;
			margin-bottom: 0px !important;
			opacity: 0.9;
			transition: 0.5s ease;
		}
		.navbar-custom:active{
			opacity:1;
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
		#menu-link{
			color: white;
			text-decoration: none;
			font-size: 22px !important;
			font-family: Trench;
			font-weight: bolder;
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			padding-bottom: 0px !important;
			padding-top: 0px !important;
		}
		
		#menu-link:hover{
			color:#015657;
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
		.navbar.headroom--unpinned {
			top: -60px;
		}
		#sidebar-wrapper{
			top:90px;
		}
		.hello {
			background-color:#33CC8C;
		}
		
	</style>

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
				<div class="col-sm-6 col-md-6" id="col-draw">
					<a id="head-link"href="index.php">college podium</a>
				</div>
				<div class="col-sm-3 col-md-3">
					<form class="navbar-form" role="search" method="POST" action="notes_search.php">			
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search notes" name="srch-term" id="srch-term">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>

				</div>	
			</div>
			<div class="row hello">
				<div class="col-sm-3 col-md-3" id="col-draw">
					<a id="menu-link" href="upload_notes.php"><center>Upload Notes</center></a>
				</div>
				<div class="col-sm-3 col-md-3" id="col-draw">
					<a id="menu-link" href="notes.php"><center>Notes</center></a>
				</div>
				<div class="col-sm-3 col-md-3" id="col-draw">
					<a id="menu-link" href="advSearchNote.php"><center>Advance Search</center></a>
				</div>
				<div class="col-sm-3 col-md-3" id="col-draw">
					<a id="menu-link" href="saved_notes.php"><center>Saved Notes</center></a>
				</div>
			</div>
		</div>
		<div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
				<li>
                    <a href="index.php">home</a>
                </li>
				
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
				
				<hr class="divider-title" />
				
                <li>
                    <a href="index.php">all posts</a>
                </li>
						
				<li>
                    <a href="notes.php" class="thispage">all notes</a>
                </li>
				
				<hr class="divider-title" />
				
				<li>
                    <a href="#" id="logout">logout</a>
                </li>
				<hr class="divider" />
				<li>
				<input type="hidden" value="<?php echo($_SESSION['csrftoken']); ?>" id="sidebar-token">
				<p class="footnote">Copyright © 2015 College Podium. All rights reserved.</p>
				</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                    <div class="col-lg-12">
                         <!-- This span is for filling posts (from JQuery AJAX method) -->
							<div id="note-main-wrap"></div>
						 <!-- ========================================================== -->
					</div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <!-- /#page-content-wrapper -->

		</div>
			  

	 </div>	

</body>
</html>
