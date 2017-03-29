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
	<script src="js/headroom.min.js"></script>
	<script src="js/jQuery.headroom.min.js"></script>
	<script src="bs/js/bootbox.min.js"></script>
	<link rel="stylesheet" href="Style/common.css">
	<link rel="stylesheet" href="Style/sidebar.css">
	<script src="header.js"></script>
	
	<?php
		require_once 'session.php';
		include 'TokenMethod.php';
		$csrf = new csrfToken;
		$csrf->setToken();
		if (!isset($_SESSION['userid'])) header("location: login.php");
	?>
	
	<style>
		body { 
			padding-top: 63px; 
			background-color: #F0F0F0 !important;
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
		.question{
			font-size:20px;
		}
		.answer{
			font-size:15px;
		}
		.wrapper{
			margin-left:15px;
			width:70%;
		}
		
	</style>

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
			

        <!-- #page-content-wrapper  -->
		<div class="wrapper">
		<?php 
			include 'database.php';
			$subject = $_GET['subject'];
			/*$stream = $_GET['stream'];*/
			if(isset($_GET['chapter']))
				$chapter = $_GET['chapter'];
			if($chapter == "all"){
				$query =  "select stream,subject,chapter,question,answer from questionbank where subject = ?";
				$stmt = $connection->prepare($query);
				$stmt->bind_param('s',$sub);
			}
			else{
				$query = "select stream,subject,chapter,question,answer from questionbank where subject = ? and chapter = ?";
				$stmt = $connection->prepare($query);
				$stmt->bind_param('ss',$sub,$chptr);
			}
			$sub = $subject;
			$chptr = $chapter;
			
			$success = $stmt->execute();
			if ( !$success ) return 0;
			$result = $stmt->get_result();
			while($arr = $result->fetch_array(MYSQLI_ASSOC)){
				$qArr[] = $arr;
			}
				
			$stmt->close();
			$c=1;
			/*var_dump($qArr);*/
			foreach($qArr as $vIndex){
				/*foreach($vIndex as $valIndex=>$val){
					echo "$valIndex : $val<br/>";
				}*/
				echo $c++.")<p class=\"question\">".$vIndex['question']."</p>";
				echo "<p class=\"ans\">".$vIndex['answer']."</p>";
				echo "Stream: ".$vIndex['stream'];
				echo "<hr/>";
			}

		?>
		</div>
			  

	 </div>	

</body>
</html>
