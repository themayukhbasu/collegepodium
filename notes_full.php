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
		.save-note {
			color: #0033EE !important;
			font-size: 14px;
		}

		.save-note:hover {
			color: #EE0033 !important;
			cursor: pointer;
		}
		#discuss{
			background-color: #015657;
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
		
		.navbar.headroom--unpinned {
			top: -60px;
		}
		#sidebar-wrapper{
			top:90px;
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
		
		.hello {
			background-color:#33CC8C;
		}
	</style>

	<script src="header.js"></script>
	<script>
		$(document).ready(function() {
			function parse(val) {
				var result = 0, tmp = [];
				location.search
						.substr(1)
						.split("&")
						.forEach(function (item) {
							tmp = item.split("=");
							if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
						});
				return result;
			}
			var note_id = parse('id');
			if ( note_id === 0 )
				note_id = parse('ID');
			if(note_id===0) {
				window.location.href = "notes.php";
			}
			else {
				// AJAX Code To Submit Form.
				$.ajaxCall = function(i){
					var datastring = 'note_id=' + note_id;					
					if (i != 0) return;
					$.when($.ajax({
							url: 'api-getnotebyid.php',
							dataType: "json",
							data: datastring,
							type: "GET",
							success: function(note) {
								var file;
								if ( note === 0 ) window.location.href("notes.php");
								var count = 0;
								if ( note.note_file != undefined ) {
									file = note.note_file;
									if (file.constructor === Array)
										count = file.length;
									else count = 1;
								}
								if ( count === 1 ) {
									var ext = file.split('.').pop().toLowerCase();
								}
								else {
									var ext = Array();
									for ( var k = 0; k < count; ++k ) {
										ext.push( file[k].split('.').pop().toLowerCase() );
									}
								}
								var disp = note.data;
								disp = '<p>' + disp.split(/\n([ \t]*\n)+/g).join('</p><p>').split('\n').join('<br />') + '</p>';
								var title = note.title;
								var sm_title = title.substring(0, 50) + '.zip';
								title = '<p>' + title.split(/\n([ \t]*\n)+/g).join('</p><p>').split('\n').join('<br />') + '</p>';
								if ( count === 0 ) {
									var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + note.userrealname +
														'</span><div class="main-post-time">' + note.time + '</div><span class="postdat"><p>' + disp + '</p></span>' + 
														'</p></span>' + /*<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + note.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
														'<span class="votecnt" id="vuc_' + note.ID + '"></span>' +
														'<span class="vote-down"><a class="votedn" id="vd_' + note.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
														'<span class="votecnt" id="vdc_' + note.ID + '"></span></span>' +*/
														'<span>Subject: ' + note.subject + '</span>' +
														'<span>Teacher: ' + note.teacher + '</span>' +
														'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
														'</div>'
														);					
								}
								else if ( count === 1 ) {
									if (ext === 'jpg' || ext === 'jpeg' || ext === 'png' || ext ==='gif' || ext === 'bmp' ) {
										var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + note.userrealname +
															'</span><div class="main-post-time">' + note.time + '</div>' +
															'<br><img id="post_pic_' + i + '" class="post_pic" src="' + file+'"></img><span class="postdat"><p>' + disp + '</p></span>' + 
															'</p></span>' + /*<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + note.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vuc_' + note.ID + '"></span>' +
															'<span class="vote-down"><a class="votedn" id="vd_' + note.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vdc_' + note.ID + '"></span></span>' +*/
															'<form action="api-downloadfiles.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button-single" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
															'<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form>'+
															'<span>Subject: ' + note.subject + '</span>' +
															'<span>Teacher: ' + note.teacher + '</span>' +
															'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
															'</div>'
															);															
									}
									else if ( ext === 'pdf' ) {
										var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + note.userrealname +
															'</span><div class="main-post-time">' + note.time + '</div>' +
															'<br><div id="post_pic_' + i + '"  style="width=800px; height=2100px;" class="post_pdf note_pdf" name="' + file+'">See PDF</div><span class="postdat"><p>' + disp + '</p></span>' + 
															'</p></span>' +/*<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + note.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vuc_' + note.ID + '"></span>' +
															'<span class="vote-down"><a class="votedn" id="vd_' + note.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vdc_' + note.ID + '"></span></span>' +*/
															'<form action="api-downloadfiles.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button-single" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
															'<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form>'+
															'<span>Subject: ' + note.subject + '</span>' +
															'<span>Teacher: ' + note.teacher + '</span>' +
															'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
															'</div>'
															);																							
									}
									else {
										var append_data = $('<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + note.userrealname +
															'</span><div class="main-post-time">' + note.time + '</div><span class="postdat"><p>' + disp + '</p></span>' + 
															'</p></span>' +/*<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + note.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vuc_' + note.ID + '"></span>' +
															'<span class="vote-down"><a class="votedn" id="vd_' + note.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vdc_' + note.ID + '"></span></span>' +*/
															'<span>Subject: ' + note.subject + '</span>' +
															'<span>Teacher: ' + note.teacher + '</span>' +
															'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
															'</div>'
															);					
																			
										}
								}
								else {
									var append_data = '<div class="main-post" name="post_' + i + '"><span class="post-title">' + title + '</span><hr class="divider-title" /><span class="main-post-user">Posted by: ' + note.userrealname +
														'</span><div class="main-post-time">' + note.time + '</div>';
									var files = '';
									for ( var k = 0; k < count; ++k ) {
										if ( k === 0 ) files = '<div class="row">';
										if ( ext[k] === 'pdf' ) {
											files = files + '<div class="col-xs-3"><iframe class="note_pdf"  name="note_pic_' + i + '"  id="note_pic_' + k + '" src="' + file[k] + '"></iframe></div>';
										}
										else if ( ext[k] === 'jpeg' || ext[k] === 'jpg' || ext[k] === 'png' || ext[k] === 'gif' || ext[k] === 'bmp' ) {
											files = files + '<div class="col-xs-3"><img class="note_pic img-responsive thumbnail" name="note_pic_' + i + '" id="note_pic_' + k + '" src="' + file[k] + '"></img></div>';
										}
									}
									files = files + '</div>';
									append_data = append_data + files;
									append_data = append_data + '<span class="postdat"><p>' + disp + '</p></span>' + 
															'</p></span>' +/*<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + note.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vuc_' + note.ID + '"></span>' +
															'<span class="vote-down"><a class="votedn" id="vd_' + note.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
															'<span class="votecnt" id="vdc_' + note.ID + '"></span></span>' +*/
															'<form action="zip.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button" name="' + sm_title + '" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
															'<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form><span class="pull-left save-note" id="save-note-' + note.ID + '">save</span></div';
															'</div>';
								}
											
								if ( count <= 1 ) append_data.appendTo('#orig-post-wrap');
								else $('#orig-post-wrap').append(append_data);
								var saveID = '#save-note-' + note.ID;
								$.ajax({
									type: "POST",
									url: 'api-notesaved.php',
									data: {note_id: note.ID},
									success: function(data){
										if ( data > 0 )
											$(saveID).text('unsave');
										else $(saveID).text('save');
									}
								});
							}
										
					}));
				}
				$.ajaxCall(0);
			}
			$(document).on("click", ".save-note", function(e) {
				e.preventDefault();
				var noteID = $(this).attr('id').slice(10);
				var currentState = $(this).html();
				if ( currentState === 'save' ) {
					var priority = 1;
				}
				else var priority = -1;
				$.ajax({
					type: "POST",
					url: 'api-savenote.php',
					data: {
							note_id: noteID,
							priority: priority,
						  },
					success: function(data){
								$('#save-note-' + noteID).empty();
								if ( data > 0 )
									$('#save-note-' + noteID).append('unsave');
								else $('#save-note-' + noteID).append('save');
							}
				});
			});
	
		$(document).on("click", ".note_pic", function(e) {
			e.preventDefault();
			var url = $(this).attr('src');
			//var id = $(this).attr('id');
			//var element = Number($('#' + id).parent().attr('name').slice(5));
			var pic = Number($(this).attr('id').slice(9));
			$('embed').toggle();
			/*if ( pic == element )*/ bootbox.dialog({
										message: "<img style='height: auto; max-width: 100%; z-index: 10000;' src='" + url + "'>",
										size: 'large',
										 buttons: {
											close: {
											  label: "Close",
											  className: "btn-primary",
											}
										}
									});
			
			$('embed').toggle();
		});	
		
		$(document).on("click",".download-button", function(e) {
			e.preventDefault();
			var ID = $(this).attr('ID').slice(4);
			var sm_title = $(this).attr("name");
			bootbox.prompt({
			  title: "Select name of the zip file",
			  value: sm_title,
			  callback: function(result) {
				if ( result != null ) {
					if ( result === '' ) result = 'notes.zip';
					if ( result.split('.').pop().toLowerCase() != 'zip' )
						result = result + '.zip';
					$('#file_name_' + ID).val( result );
					$('#form_' + ID).submit();
				}
				
				
			  }
			});
		});

				
		$(document).on("click", ".note_pdf", function(e) {
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
                <div class="row">
                    <div class="col-lg-12">
                        <div id="orig-post-wrap" class="col-md-8 col-md-offset-0">
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
