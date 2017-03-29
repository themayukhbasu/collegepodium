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
	<script src="header.js"></script>
	
	<?php
		require_once 'session.php';
		include 'TokenMethod.php';
		$csrf = new csrfToken;
		$csrf->setToken();
		if (!isset($_SESSION['userid'])) header("location: login.php");
	?>
	<script>
	$(document).ready(function() {
		$( "#coursewrap" ).toggle();
		$( "#semwrap" ).toggle();
		var c = 1;
		var valid = 1;
		var first = 0, last = 4;
		var postSearch = '<?php echo @$_POST['srch-term'] ?>';
		var emailSearch = '<?php echo @$_POST['srch-email']?>';
		var nameSearch = '<?php echo @$_POST['srch-name']?>'; 
		var typeSearch = '<?php echo @$_POST['srch-type']?>'; /*Right now an useless field*/
		var teacherSearch = '<?php echo @$_POST['srch-teacher']?>';
		var subjectSearch = '<?php echo @$_POST['srch-subject']?>';
		var periodSearch = '<?php echo @$_POST['srch-period']?>';
		
		if ( postSearch === '' ) 
			window.location.href = 'notes.php';
		$.ajaxCall = function(i, j){
			if ( i === j || c === 2 ) return;
			$.when($.ajax({
				url: 'api-searchnote.php',
				dataType: "json",
				type: "POST",
				data: {
					valpass: i,
					search: postSearch,
					searchEmail: emailSearch,
					searchName: nameSearch,
					searchType: typeSearch,
					searchTeacher: teacherSearch,
					searchSubject: subjectSearch,
					searchPeriod: periodSearch
				},
				success: function(note) {
				if (note == 0) valid = 0;
				if ( valid != 0 ) {
					var count = 0;
					if ( c === 1 ) c = 0;
					else c = 1;
					if ( c === 0 ) {
						$('#note-main-wrap').append('<div class="row">');
					}
					var file;
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
						$('#note-main-wrap').append('<div class="col-md-5 note_wrapper" id="note_wrap_' + i + '">' +
												'<div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div>' +													
												'<div class="note_user"><a href="userdata.php?user_id=' + note.userid + '"> ' + note.userrealname + '</a></div>' +
												'<div class="note_content">' + disp + '</div><span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
												'</div>');
					}
					else if ( count === 1 ) {
						if ( ext === 'jpeg' || ext === 'jpg' || ext === 'png' || ext === 'bmp' || ext === 'gif' ) {
							$('#note-main-wrap').append('<div class="col-md-5 note_wrapper" id="note_wrap_' + i + '">' +
													'<div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div>' +													
													'<div class="note_user"><a href="userdata.php?user_id=' + note.userid + '"> ' + note.userrealname + '</a></div>' +
													'<div class="note_file_wrap"><img class="note_pic" id="note_pic_' + i + '" src="' + file + '"></img></div>' +
													'<div class="note_content">' + disp + '</div>' + 
													'<form action="api-downloadfiles.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button-single" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
													'<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form>'+
													'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
													'</div>');
						}
						else if ( ext === 'pdf' ) {
							$('#note-main-wrap').append('<div class="col-md-5 note_wrapper" id="note_wrap_' + i + '">' +
													'<div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div>' +
													'<div class="note_user"><a href="userdata.php?user_id=' + note.userid + '"> ' + note.userrealname + '</a></div>' +
													'<div class="note_file_wrap"><embed class="note_pdf" id="note_pdf_' + i + '" src="' + file + '"></embed></div>' +
													'<div class="note_content">' + disp + '</div>'+
													'<form action="api-downloadfiles.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button-single" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
													'<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form>'+
													'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
													'</div>');
						}
					}
					else {
						//might want JQuery objects
						var begin = '<div class="col-md-5 note_wrapper" id="note_wrap_' + i + '"><div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div>' +													
									'<div class="note_user"><a href="userdata.php?user_id=' + note.userid + '"> ' + note.userrealname + '</a></div>' ;
						var files = '';
						for ( var k = 0; k < count; ++k ) {
							if ( k === 0 ) files = '<div class="note_file_wrap"><ul class="bxslider" id="bxslidewrap_' + i + '">';
							if ( ext[k] === 'pdf' ) {
								files = files + '<li><iframe class="note_pdf"  name="note_pic_' + i + '"  id="note_pic_' + k + '" src="' + file[k] + '"></iframe></li>';
							}
							else if ( ext[k] === 'jpeg' || ext[k] === 'jpg' || ext[k] === 'png' || ext[k] === 'gif' || ext[k] === 'bmp' ) {
								files = files + '<li><img class="note_pic" name="note_pic_' + i + '" id="note_pic_' + k + '" src="' + file[k] + '"></img></li>';
							}
						}
						if ( files != '' ) files = files + '</div>';
						var end = '<div class="note_content">' + disp + '</div>'+
								  '<form action="zip.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button" name="' + sm_title + '" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
								  '<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form><span class="pull-left save-note" id="save-note-' + note.ID + '">save</span></div';
						$('#note-main-wrap').append(begin + files + end);
						var slider = $('#bxslidewrap_' + i).bxSlider({
									});
						
					}
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
			}
		})).done(function() {
		  $.ajaxCall(i+1, j);
	  });
	}
	$.ajaxCall(first, last);
	
	$(window).scroll(function() {
	   if($(window).scrollTop() + screen.height > $('body').height()) {
		first = last;
		last = first + 2;
		valid = 1;
		$.ajaxCall(first, last);
	   }
	});
	
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
