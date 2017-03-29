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
	<link rel="stylesheet" href="Style/animations.css">
	<script src="header.js"></script>

	<?php
		include_once 'session.php';
		if (!$_SESSION) header("Location: login.php");
		$uID = $_SESSION['userid'];
		if(isset($_GET['user_id']))
			$uID = $_GET['user_id'];
		include 'database.php';

		$stmt = $connection->prepare("SELECT email, userlevel, country, dob, sex, name, contactno, level0tag, level1tag, level2tag
									  FROM register 
									  WHERE ID = ?");
		$stmt->bind_param('i',$ID);
		$ID = $uID;
		$stmt->bind_result($arr['email'], $arr['userlevel'], $arr['country'],$arr['dob'], $arr['sex'], $arr['name'],
							$arr['contactno'], $arr['level0tag'], $arr['level1tag'], $arr['level2tag']);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		
		$stmt = $connection->prepare("SELECT gtName FROM globaltag where ID =?");
		$stmt->bind_param('i',$uni);
		$uni = $arr['level0tag'];
		$stmt->bind_result($arr['university']);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		
		$stmt = $connection->prepare("SELECT stName FROM sectag where ID =?");
		$stmt->bind_param("i",$clg);
		$clg = $arr['level1tag'];
		$stmt->bind_result($arr['college']);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		
		$stmt = $connection->prepare("SELECT ttName FROM terttag where ID =?");
		$stmt->bind_param('i',$dept);
		$dept = $arr['level2tag'];
		$stmt->bind_result($arr['department']);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		
		$stmt = $connection->prepare("SELECT name from subjectlist where ID IN (SELECT subjectid from usersubject where userid =?)");
		$stmt->bind_param('i',$ID);
		$ID = $uID;
		$success = $stmt->execute();
		if ( !$success ) return 0;
		$result = $stmt->get_result();
		while($a = $result->fetch_array(MYSQLI_ASSOC)){
			$qArr[] = $a;
		}
		//var_dump($qArr);		
		$stmt->close();
		$subjectListShow = "<div id=\"sdtoggle\">";
		$c = 1;
		foreach($qArr as $i){
			foreach($i as $index=>$val){
				$subjectListShow .= "<br/><div class=\"row\"><div class=\"col-sm-1 col-md-1\"></div><div class=\"col-sm-11 col-md-11\">".$c++.") ".$val."</div></div>";
			}	
		}
		//$subjectListShow .= "</div>";
		
		if($arr['country'] == "india"){
			$arr['country'] = "India";
		}
		
	?>
	
	<script>
		$(document).ready(function(){	
			
			$("#edetails").addClass("slideRight");
			$("#adetails").addClass("slideRight");
			$("#sdetails").addClass("slideRight");
			
			$("#edtoggle").hide();
			$("#adtoggle").hide();
			$("#sdtoggle").hide();
			$("#pdetails").click(function(){
				$(this).removeClass("hatch");
				$("#pdtoggle").toggle("slow");
				$(this).addClass("hatch");
			});
			$("#edetails").click(function(){
				$(this).removeClass("hatch");
				$("#edtoggle").toggle("slow");
				$(this).addClass("hatch");
			});
			$("#adetails").click(function(){
				$(this).removeClass("hatch");
				$("#adtoggle").toggle("slow");
				$(this).addClass("hatch");
			});
			$("#sdetails").click(function(){
				$(this).removeClass("hatch");
				$("#sdtoggle").toggle("slow");
				$(this).addClass("hatch");
			});
		});
	</script>
	
	<style>
		body { 
			padding-top: 63px; 
			background-color: #F0F0F0 !important;
		}
		
		#wrapper{
			margin-left:10px;
			width:98%;
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
		#list {
			margin:15px;
			padding:10px;
		}
		#ans {
			margin-left:10px;
		}
		.sechead{
			margin:20px;
			cursor:pointer;
			padding:10px;
			border-radius:10px;
			background-color:#F1F1F1;
			width:70%;
		}
		.sechead:hover{
			background-color:#e4e4e4;
		}
		
		.secdata{
			width:60%;
			margin:30px;
		}
		#edetails,#sdetails,#adetails{
			visibility:hidden;
		}
		.visible{
			visibility:initial;
		}
		
	</style>

</head>

<body>
<!-- ============================ Entire Content Wrapper ========================= -->
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
			

			<!-- =================== #page-content-wrapper ======================================== -->
	
<?php

if ($arr['email']==NULL) trigger_error("No entry found");
else { 
	if ($arr['userlevel']==1) $arr['userlevel'] = "Admin";
	else $arr['userlevel'] = "User";
	if($uID == $_SESSION['userid']){
		echo '
		<div id="wrap">
		<br/>
		  <h2 id="pdetails" class="sechead" >Personal Details </h2>
		  	<div id="pdtoggle" class="secdata">
			  	<div class="row">
					<div class="col-sm-3 col-md-3"><b>Name :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['name'].'</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3"><b>Email :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['email'].'</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>Country :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['country'].'</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>Date of Birth :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['dob'].'</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>Sex :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['sex'].'</div>
				</div>
			</div>	
			
			
			<h2 id="edetails" class="sechead">Education Details </h2>
			<div id="edtoggle" class="secdata">
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>University :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['university'].'</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>College :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['college'].'</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>Department :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['department'].'</div>
				</div>
			</div>
			
			<h2 id="sdetails" class="sechead">Subject List </h2>'.$subjectListShow.'
			<br/><div class="row"><div class="col-sm-1 col-md-1"></div><div class="col-sm-11 col-md-11"><a href="add-subjects.php">add more subjects</a></div></div>
			</div>
			<h2 id="adetails" class="sechead">Account Details</h2>
			<div id="adtoggle" class="secdata">
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>User Level :</b></div>
					<div class="col-sm-9 col-md-8"> '.$arr['userlevel'].'</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>Password :</b></div>
					<div class="col-sm-9 col-md-8"><a href="change_password.php">Change Password Now</a></div>
				</div>
				
		  ';
			
	if($_SESSION['userlevel'] == 1)	{		
		echo	'<hr/>
				<div class="row">
					<div class="col-sm-3 col-md-3" id="col-draw"><b>Admin Panel :</b></div>
					<div class="col-sm-9 col-md-8"><a href="admin-panel.php">Actions of Admins</a></div>
				</div>';
			
	};
	echo '
			</div>
		<br/><br/>
		</div>';
	}
	else{
		echo '
		<div id="wrap">
		<br/>
		  <h2>Personal Details :</h2>
		  	<div class="row">
				<div class="col-sm-3 col-md-3"><b>Name :</b></div>
				<div class="col-sm-9 col-md-8"> '.$arr['name'].'</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-sm-3 col-md-3" id="col-draw"><b>Country :</b></div>
				<div class="col-sm-9 col-md-8"> '.$arr['country'].'</div>
			</div>
			<hr/>
			
			<div class="row">
				<div class="col-sm-3 col-md-3" id="col-draw"><b>Sex :</b></div>
				<div class="col-sm-9 col-md-8"> '.$arr['sex'].'</div>
			</div>
			
			<hr/>
			
			<h2>Education Details :</h2>
			<div class="row">
				<div class="col-sm-3 col-md-3" id="col-draw"><b>University :</b></div>
				<div class="col-sm-9 col-md-8"> '.$arr['university'].'</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-sm-3 col-md-3" id="col-draw"><b>College :</b></div>
				<div class="col-sm-9 col-md-8"> '.$arr['college'].'</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-sm-3 col-md-3"><b>Department :</b></div>
				<div class="col-sm-9 col-md-8"> '.$arr['department'].'</div>
			</div>
			<br/><br/>
		</div>';
	}
}
		  
?>


</body>
</html>
