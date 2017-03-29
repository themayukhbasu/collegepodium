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
	<link rel="stylesheet" href="Style/common.css">
	<link rel="stylesheet" href="Style/sidebar.css">
	<link href="Style/upload.css" rel="stylesheet" type="text/css">

<?php
include_once 'session.php';
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
		

		.upldiv {
			height: 0px;width: 0px; overflow:hidden;
			padding: 0px; margin: 0px;
			float: left;
		}
		.upload-sign{
			width:50px;
			height:55px;
		}
		.same-line{
			display:inline !important;
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
		.text-top{
			vertical-align:top;
		}
</style>
<script src="header.js"></script>
<script>
$(document).ready(function() {
	$( "#coursewrap" ).toggle();
	$( "#semwrap" ).toggle();
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
	var click = 0;
	var files = 0;
	var error = parse('callback');
	if ( error.toLowerCase() === 'bf' )
		$('.upload-error').prepend('<div class="alert alert-danger inline" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Invalid file. Please upload PDFs or images.</div>');
	else if ( error.toLowerCase() === 'ot' ) 
		$('.upload-error').prepend('<div class="alert alert-danger inline" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Could not upload notes. Please try again.</div>');
	$.ajaxCallSubj = function(i, flag){
		var datastring = "valpass=" + i;
		if (flag==0) return;
		if (i==0) $('.dat').empty();
		$.when($.ajax({
			url: 'pullSubjData.php',
			dataType: "json",
			data: datastring,
			type: "GET",
			success: function(dat){
				if (dat === 0) flag = 0; //this is a hackish way, if db pull fails, 0 is being returned
				$('#subj').append('<option value="' + dat.ID + '">' + dat.name + '</option>');
			}
		})).done(function() {
			$.ajaxCallSubj(i + 1, flag)
		});
	};
	$.ajaxCallSubj(0,1);
	
	$(document).on("change", ".file", function() {
		var idno = click;
		var spanid = '#file-wrap-' + idno;
		var uploadspan = '#upload-' + idno;
		var fileid = $(this).attr("ID");
		var more = $(this).get(0).files.length;
		files = files + more;
		idno++;
		$("#file-count").html(files + ' files uploaded.');
		$("#file-wrap").append('<span class="upldiv"><input name="file[]" multiple="" id="file' + idno + '" class="file" type="file"/></span>');		
		click++;
	});
	
	$(document).on("click", ".upload-sign", function() {
		var id = $(this).attr("id").slice(7);
		var fileid = '#file' + click;
		$(fileid).click();
	});
	
	var flag = 1;
	$(document).on("change", "#col", function() {
		if ($(this).val() != -1) 
			$('#coursewrap').toggle(true);
		else {
			$('#coursewrap').toggle(false);
			$('#semwrap').toggle(false);
		}
	});
	
	$(document).on("change", "#course", function() {
		if ($(this).val() != -1)
			$('#semwrap').toggle(true);
		else $('#semwrap').toggle(false);
	});
	
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
		if (i === 0) $('#col').append('<option value="-1">Select College</option>');
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
		if (i === 0) $('#course').append('<option value="-1">Select Course</option>');
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
		---  ----------------------------------------------------/!-->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
				<li>
                    <a href="index.php">home</a>
                </li>
                <li>
                    <a href="upload_notes.php" class="thispage">upload notes</a>
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
                    <a href="notes.php">all notes</a>
                </li>
				
				<hr class="divider-title" />
				
				<li>
                    <a href="#" id="logout" class="sidebar-logout">logout</a>
                </li>
				<hr class="divider-title" />
				<li>
				<input type="hidden" value="<?php echo($_SESSION['csrftoken']); ?>" id="sidebar-token">
				<p class="footnote">Copyright © 2015 College Podium. All rights reserved.</p>
				</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		 <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<div id="post-wrap" class="col-md-10">
							<div class="upload-error"></div>
							<div class="upload-form">
								<form action="note.php" method="POST" enctype="multipart/form-data" id="uploadimage"> 
									<h1>upload notes & help out a friend</h1>
									<div id="upload-form-main">	
										<div class="form-group">
											<span class="same-line"><label>Title: </label></span> 
											<input type="text" class="same-line" name="post_title"></input>
										</div>
										<div id="upload" class="form-group">
											<span class="same-line"><label>Upload Files: </label></span>
											<span class="file-main-wrap">
												<span class="same-line" id="file-wrap">
													<span class="upload-sign" id="upload-0"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></span>
													<span class="upldiv"><input name="file[]" multiple="" id="file0" class="file" type="file"/></span>
												</span>
											</span>
											<span class="same-line"><a id="file-count">0 files uploaded</a></span>
										</div>
										
										<div id="upload" class="form-group">
											<span class="same-line"><label class="text-top">Post:</label></span> 					
											<textarea name="post_data" class="same-line"></textarea>
										</div>									
										
										<div class="form-group">
											<span class="same-line"><label>Teacher :</label></span> 
											<input type="text" class="same-line" name="post_teacher"> </input>
										
										</div >
										<div class="form-group">
											<span class="same-line"><label>Subject :</label></span> 
											<select name="post_subject" class="same-line" id="subj">
													<!--Fill with JS-->
											</select>
										
										</div>
										<div class="form-group">
											<span class="same-line"><label>Period :</label></span> 
											<input type="text" class="same-line" name="post_period"> </input>
										
										</div>
										<input type="hidden" name="primtag" value='<?php echo $_SESSION['primtag']; ?>'/>
										<!--
										<div class="form-group">
										<span class="same-line"><label>University :</label></span>
											<select name="primtag" class="same-line" id="uni">
													<!--Fill with JS--><!--
											</select>
										</div>
										-->
										
										
										
										<div id="colwrap" class="form-group">
											<input type="hidden" name="sectag" value='<?php echo $_SESSION['sectag']; ?>'/>
										<!--
											<span class="same-line"><label>College :</label></span>
											<select name="sectag" class="same-line" id="col">
												<!--Fill with JS--><!--
											</select> -->
										</div>
										
										
										
										<div id="coursewrap" class="form-group">
											<input type="hidden" name="tertag" value='<?php echo $_SESSION['tertag']; ?>'/>	
											<!--
										<span class="same-line"><label>Course :</label></span>
											<select name="tertag" class="same-line" id="course">
												<!--Fill with JS--><!--
											</select>
										-->
										</div>
										
										<div id="semwrap" class="form-group">
											<span class="same-line"><label>Present Semester :</label></span>
											<input type="number" name="quartag" class="same-line" min="0" max="10" placeholder="Enter Only Number" value="0">
										</div>			
										
										<input type="hidden" name="csrftoken" value='<?php echo $_SESSION['csrftoken']; ?>'/>
										<div class="form-group">
											<input type="submit" value="Post" class="submit" id ="submit"></input>
										</div>
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