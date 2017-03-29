<!DOCTYPE html>
<html>

<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Register || College Podium</title>
	
	<link href="Style/register.css" rel="stylesheet" type="text/css"  media="all" /> 
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" href="bs/css/bootstrap.min.css">
	<link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
	<script src="bs/js/bootstrap.min.js"></script>
	<script src="bs/js/bootbox.min.js"></script>
	<script src="js/headroom.min.js"></script>
	<script src="js/jQuery.headroom.min.js"></script>
	<script src="header.js"></script>
	<link rel="stylesheet" href="Style/common.css">
	<link rel="stylesheet" href="Style/sidebar.css">
	<?php
		require_once 'session.php';
		if ( isset( $_SESSION['userid'] ) )
			header("Location: index.php");
	?>
	<script>
		/* Script used to ajax call data from database . data includes the university names, college names, department names (tags)*/
			$(document).ready(function(){
				var flag = 1;
				$.ajaxCallUni = function(i, flag){
					var datastring = "type=1&valpass=" + i;
					if (flag==0) return;
					$.when($.ajax({
						url: 'pullTagData.php',
						dataType: "json",
						data: datastring,
						type: "GET",
						success: function(dat){
							if (dat === 0) flag = 0; //this is a hackish way, if db pull fails, 0 is being returned
							$('#uni').append('<option value="' + i + '">' + dat.ctGlobalTag.gtName + '</option>');
						}
					})).done(function() {
						$.ajaxCallUni(i + 1, flag)
					});
				};
				$.ajaxCallCol = function(i, colflag, pid){
					if (i === 0) $('#col').empty();
					var datastring = "type=2&pid=" + pid + "&valpass=" + i;
					if (colflag == 0) return;
					$.when($.ajax({
						url: 'pullTagData.php',
						dataType: "json",
						data: datastring,
						type: "GET",
						success: function(dat){
							if (dat === null) colflag = 0; //this is a hackish way, if db pull fails, 0 is being returned
							$('#col').append('<option value="' + dat.ID + '">' + dat.stName + '</option>');
						}
					})).done(function() {
						$.ajaxCallCol(i + 1, colflag, pid)
					});
				};
				$.ajaxCallCourse = function(i, courseflag, pid){
					if (i === 0) $('#course').empty();
					var datastring = "type=3&pid=" + pid + "&valpass=" + i;
					if (courseflag == 0) return;
					$.when($.ajax({
						url: 'pullTagData.php',
						dataType: "json",
						data: datastring,
						type: "GET",
						success: function(dat){
							if (dat === null) courseflag = 0; //this is a hackish way, if db pull fails, 0 is being returned
							$('#course').append('<option value="' + dat.ID + '">' + dat.ttName + '</option>');
						}
					})).done(function() {
						$.ajaxCallCourse(i + 1, courseflag, pid)
					});
				};
				$.ajaxCallCol(0, 1, 1);
				$('#uni').on('change', function() {
					$.ajaxCallCol(0, 1, $(this).val());
				});
				$('#col').on('change', function() {
					$.ajaxCallCourse(0, 1, $(this).val());
				});
				$.ajaxCallUni(1, flag);
				$.ajaxCallCourse(0, 1, 1); //very very hacky
			});
	</script>
	
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
			
	</style>
</head>

<body>

<!--
Country
Name (Real name)
DOB
Sex
Country specific education details, viz. University, College, Department, Year
Email ID (hash this)
Contact number (hash this)
User level
-->
	<div class="container-fluid">
		<!-- ------------Navbar content-----------------------------
		---- This is the wrapper for navbar. When making a
		---- new page, do NOT modify the content inside
		---- The styles for this are inside this page (in style tags)
		---- The JS for toggling (and searching) is in header.js
		---  ----------------------------------------------------/!-->
		<div class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="row">
				<div class="col-sm-4 col-md-4" id="col-draw">		
					<div class="drawer">
						<button type="button" class="btn btn-default btn-lg" id="drawer">
						 <span id="btn-draw" class="glyphicon glyphicon glyphicon-align-justify" aria-hidden="true"></span>
						</button>
					</div>
				</div>
				<div class="col-sm-6 col-md-6" id="col-draw">
					<a id="head-link"href="index.php">college podium</a>
				</div>
			</div>
		</div>
		<!--  =============================End Navbar Content=================================  -->
		
		<!--  //////////////////////////////////////// BREAK //////////////////////////////////////////  -->
		
		<!--  =============================Content and Sidebar wrapper=================================  -->
		
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
						<a href="register.php" class="thispage">sign up</a>
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
		<!--  =============================Original Content=================================  -->
			<div id="page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">	
							<div id="post-wrap" class="col-md-8 col-md-offset-2">
								<div class="register-form">
										<h1>sign up - CLOSED FOR NOW</h1>
										<div id="register-form-main">
											<form action="api-register.php" method="POST" enctype="multipart/form-data" id="reg">
												<div>
													<span class="same-line"><label>Name :</label></span>
													<span class="same-line"><input name="name" type="text" class="textbox" placeholder="Enter Real Name"></span>
												</div>
												
												<div>			
													<span class="same-line"><label>Email :</label></span>
													<input type="email" name="email" class="same-line" required placeholder="Enter Valid Email Id">		
												</div>
												
												<div>			
													<span class="same-line"><label>Password :</label></span>
													<input type="password" name="password" class="same-line" required >		
												</div>
												
												<div>
													<span class="same-line"><label>Country :</label></span>
													<select name="country" class="same-line">
														<option value="none">Select Your Country :</option>
														<option value="india">India</option>
														<option value="usa">United States</option>
														<option value="uk">United Kingdom</option>
														<option value="germany">Germany</option>
													</select>
												</div>	
												
												<div>
													<span class="same-line"><label>Date of Birth :</label></span>
													<input type="date" name="dob" class="same-line">
												</div>	
												
												<div>
													<span class="same-line"><label>Sex :</label></span>
													<input type="radio" name="sex" value="male" checked class="same-line"><label id="radio-label">Male</label>
													<input type="radio" name="sex" value="female" class="same-line" ><label id="radio-label">Female</label>
													<input type="radio" name="sex" value="other" class="same-line"><label id="radio-label">Other</label>
												</div>
												
												<div>
													<span class="same-line"><label>Contact Number :</label></span>
													<input type="number" name="contact_number" class="same-line" placeholder="Enter Valid Contact Number">
												</div>
												
												<div>
													<span class="same-line"><label>University :</label></span>
													<select name="university" class="same-line" id="uni">
														<!--Fill with JS-->
													</select>
												</div>
												
												<div>
													<span class="same-line"><label>College :</label></span>
													<select name="college" class="same-line" id="col">
														<!--Fill with JS-->
													</select>
												</div>
												
												<div>
													<span class="same-line"><label>Course :</label></span>
													<select name="course" class="same-line" id="course">
														<!--Fill with JS-->
													</select>
												</div>
												
												<div>
													<span class="same-line"><label>Present Semester :</label></span>
													<input type="number" class="same-line" name="sem" min="1" max="10" placeholder="Enter Only Number">
												</div>
												
												<div>
													<input type="submit" class="same-line" value="Sign Up"> 
												</div>
											</form>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		<!--  ==============================================================  -->	
		
	</div>

</body>
</html>
