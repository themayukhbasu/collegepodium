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
	<link rel="stylesheet" href="Style/posts.css">
	
	<?php
		require_once 'session.php';
		include 'TokenMethod.php';
		if ( !isset($_GET['post_id']) ) header("Location: error.php");
		$csrf = new csrfToken;
		$csrf->setToken();
		if (!isset($_SESSION['userid'])) header("location: login.php");
	?>
	<style>
		body { 
			padding-top: 70px; 
			background-color: #F0F0F0 !important;
			word-wrap: break-word !important;
		}

		#discuss{
			background-color: #16a085;
			padding: 10px;
			color: white;
			font-size: 17px;
			border-radius: 10px;
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
		
		.divider-title{
			margin-top:2px;
			margin-bottom:10px;
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
		
		.glyphicon-trash {
		   color: #015657;
		   font-size: 25px;
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
		
		.checkbox {
			padding-left: 20px;
			padding-right: 20px;
		}
	</style>

	<script src="header.js"></script>
	<script>
				$(document).ready(function() {
					autosize(document.querySelectorAll('textarea'));
					var post_id = <?php include 'findid.php'; ?>;				
					$('.post_id').val(post_id);
					if( !$.isNumeric( post_id ) ) {
						window.location.href = "error.php";
					}
					else {
						// AJAX Code To Submit Form.
						$.ajaxCall = function(i){
							var datastring = 'post_id=' + post_id + '&valpass=' + i;
							
							if (i === 100) return;
							$.when($.ajax({
								url: 'pulldiscuss.php',
								dataType: "json",
								data: datastring,
								type: "GET",
								success: function(dat) {
									//write condition and cast different elements into classes (pictures, post & title)
									var post = dat.post;
									post = '<p>' + post.split(/\n([ \t]*\n)+/g).join('</p><p>').split('\n').join('<br />') + '</p>';
									if (i != 0) {
										var append_data = $('<div class="comment-post" name=post_"' + i + '"><span class="comment-post-user">' + dat.userrealname + '</span><div class="comment-post-time">' + dat.time + 
														  '</div><span class="postdat"><p>' + post + '</p></span>' +
														  '<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
														  '<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
														  '<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
														  '<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
														  '</div>');
										append_data.appendTo('#discuss-wrap');
									}
									else {
										var userid = <?php echo $_SESSION['userid']?>;
										var title = dat.title;
										title = '<p>' + title.split(/\n([ \t]*\n)+/g).join('</p><p>').split('\n').join('<br />') + '</p>';
										if ( dat.file === "NONE" ) {
											if (dat.userid != userid ) {
												var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + dat.userrealname +
																	'</span><div class="main-post-time">' + dat.time + '</div><span class="postdat"><p>' + post + '</p></span>' + 
																	'</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																	'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																	'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																	'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																	'</div>'
																	);					
																	
											}
											else {
												//can't delete the post if I didn't make it
												 var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">' + dat.userrealname + 
																  '</span><div class="main-post-time">' + dat.time + '</div><span class="postdat"><p>' + post + 
																  '</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																  '<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																  '<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																  '<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																  '<div id="postdelete" class="main-post-delete"><span class="glyphicon glyphicon-trash aria-hidden="true"> </span></div></div>');   /*glyphicon glyphicon-trash*/
											}
										}
										else {
											var ext = dat.file.split('.').pop().toLowerCase();
											if (ext === 'jpg' || ext === 'jpeg' || ext === 'png' || ext ==='gif' || ext === 'bmp' ) {
												if (dat.userid != userid ) {
													var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + dat.userrealname +
																		'</span><div class="main-post-time">' + dat.time + '</div>' +
																		'<br><img id="post_pic_' + i + '" class="post_pic" src="' + dat.file+'"></img><span class="postdat"><p>' + post + '</p></span>' + 
																		'</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																		'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																		'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																		'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																		'</div>'
																		);					
																		
												}
												else {
													//can't delete the post if I didn't make it
													 var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">' + dat.userrealname + 
																	  '</span><div class="main-post-time">' + dat.time + '</div>' +
																		'<br><img id="post_pic_' + i + '" class="post_pic" src="' + dat.file+'"></img><span class="postdat"><p>' + post + '</p></span>' + 
																	  '</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																	  '<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																	  '<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																	  '<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																	  '<div id="postdelete" class="main-post-delete"><span class="glyphicon glyphicon-trash aria-hidden="true"> </span></div></div>');   
												}
											}
											else if ( ext === 'pdf' ) {
												if (dat.userid != userid ) {
													var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + dat.userrealname +
																		'</span><div class="main-post-time">' + dat.time + '</div>' +
																		'<br><div id="post_pic_' + i + '"  style="width=800px; height=2100px;" class="post_pdf" name="' + dat.file+'">See PDF</div><span class="postdat"><p>' + post + '</p></span>' + 
																		'</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																		'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																		'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																		'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																		'</div>'
																		);					
																		
												}
												else {
													//can't delete the post if I didn't make it
													 var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">' + dat.userrealname + 
																	  '</span><div class="main-post-time">' + dat.time + '</div>' +
																		'<br><embed id="post_pdf_' + i + '" class="post_pdf" src="' + dat.file+'"></embed><span class="postdat"><p>' + post + '</p></span>' + 
																	  '</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																	  '<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																	  '<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																	  '<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																	  '<div id="postdelete" class="main-post-delete"><span class="glyphicon glyphicon-trash aria-hidden="true"> </span></div></div>');  
												}
											}
											else {
												if (dat.userid != userid ) {
													var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + dat.userrealname +
																		'</span><div class="main-post-time">' + dat.time + '</div><span class="postdat"><p>' + post + '</p></span>' + 
																		'</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																		'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																		'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																		'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																		'</div>'
																		);					
																		
												}
												else {
													//can't delete the post if I didn't make it
													 var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">' + dat.userrealname + 
																	  '</span><div class="main-post-time">' + dat.time + '</div><span class="postdat"><p>' + post + 
																	  '</p></span><span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
																	  '<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
																	  '<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
																	  '<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
																	  '<div id="postdelete" class="main-post-delete"><span class="glyphicon glyphicon-trash aria-hidden="true"> </span></div></div>');  
												}
											}
										}
										append_data.appendTo('#orig-post-wrap');
									}
									var vu_id = '#vuc_' + dat.ID;
									var vd_id = '#vdc_' + dat.ID;
									var postID = dat.ID;
									
									$.ajax({
											type: "POST",
											url: 'votecountup.php',
											data: {discussid: postID},
											success: function(data){
												$(vu_id).text(data);
											}
									});
									$.ajax({
											type: "POST",
											url: 'votecountdown.php',
											data: {discussid: postID},
											success: function(data){
												$(vd_id).text(data);
											}
									});			
									
									$('.voteup').click(function(){
										var discuss_id_full = $(this).attr("id");
										var discuss_id = discuss_id_full.slice(3);
										var cl_vu_id = '#vuc_' + discuss_id;
										var cl_vd_id = '#vdc_' + discuss_id;
										$.ajax({
											type: "POST",
											url: 'voteup.php',
											dataType: "json",
											data: {discussid: discuss_id},    
											success: function(data){
												$(cl_vu_id).text(data.pos);
												$(cl_vd_id).text(data.neg);
											}
										});  
									});
									$('.votedn').click(function(){
										var discuss_id_full = $(this).attr("id");
										var discuss_id = discuss_id_full.slice(3);
										var cl_vu_id = '#vuc_' + discuss_id;
										var cl_vd_id = '#vdc_' + discuss_id;
										$.ajax({
											type: "POST",
											url: 'votedown.php',
											dataType: "json",
											data: {discussid: discuss_id},    
											success: function(data){
												$(cl_vu_id).text(data.pos);
												$(cl_vd_id).text(data.neg);
											}
										});  
									}); 
								
								}
							})).done(function() {
								$.ajaxCall(i + 1)
							});
						}
						$.ajaxCall(0);
					};
					$( document ).on( "click" , "#postdelete", function(){
						$.ajax({
							type: "POST",
							url: 'PostDelete.php',
							data: {
									csrftoken: $('#token').val(),
									post_id: post_id
							},
							dataType: "json",
							success: function(data){
								if (data == 1) $(location).attr('href','index.php');
								else alert("The post could not be deleted. This is probably because you have this page open for a long time. Please refresh the page");	
							}
						});
					});
					$(document).on("click", ".post_pic", function(e) {
						e.preventDefault();
						var url = $(this).attr('src');
						var id = $(this).attr('ID');
						var element = Number($('#' + id).parent().attr('name').slice(5));
						var pic = Number($(this).attr('id').slice(9));
						if ( pic == element ) bootbox.dialog({
													message: "<img style='height: auto; max-width: 100%;' src='" + url + "'>",
													size: 'medium',
													 buttons: {
														close: {
														  label: "Close",
														  className: "btn-primary",
														}
													}
												});
					});
					$(document).on("click", ".post_pdf", function(e) {
						e.preventDefault();
						var url = $(this).attr('name');
						var id = $(this).attr('ID');
						var element = Number($('#' + id).parent().attr('name').slice(5));
						var pic = Number($(this).attr('id').slice(9));
						
						if ( pic === element ) bootbox.dialog({
													message: "<iframe style='height: auto; min-height: 400px; max-height: 2000px; width: 100%' src='" + url + "'>",
													 buttons: {
														close: {
														  label: "Close",
														  className: "btn-primary",
														}
													}
												}).find("div.modal-dialog").addClass("modal-md");
					});
					$('.comment-box').on('keyup', function(e){
						if ( $('#enter_send_toggle').is(":checked") ) {
							e.preventDefault();
							if (e.keyCode == 13) {
								$('#discuss').submit();
							}
						}
					});
				});
</script>
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
                        <div id="orig-post-wrap" class="col-md-8 col-md-offset-0">
						</div> 
						<div id="discuss-wrap" class="col-md-8 col-md-offset-0">
						</div>

						<!--Note that the hidden field IS being validated in discuss.php, so no need to worry -->

						<!-- 	
								========================================================= 
													Commenting Form
								=========================================================
						-->
						<br/><br/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<form action="discuss.php" method="POST" enctype="multipart/form-data" id="discuss"> 	
								<textarea class="comment-box" name="post_data" required placeholder="Discuss or ask a question"></textarea>

								<input type="hidden" class="post_id" name="post_id" value="0">
							<div class="form-group">
								<label class="radio-inline">
									<input type="radio" name="post_type" value="discuss" checked><label id="radio-label">Comment</label>
								</label>
								<label class="radio-inline">
									<input type="radio" name="post_type" value="query"><label id="radio-label">Query</label>
								</label>
								<span class="inline pull-right">
									<button type="submit" class="btn btn-default btn-lg">
									  <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
									</button>
								</span>
								<span class="checkbox inline pull-right">
									<input type="checkbox" name="enter-to-send" id="enter_send_toggle" checked>Press Enter to send<br>
								</span>
							</div>
								<input type="hidden" name="csrftoken" id="token" value='<?php echo($_SESSION['csrftoken']); ?>'/>
							
						</form>
					</div>
						  
						<!-- 	
								========================================================= 
													End Commenting Form
								=========================================================
						-->
					</div>
				   </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <!-- /#page-content-wrapper -->

		</div>
			  

	 </div>	

</body>
</html>
