$(document).ready(function() {
	$( "#coursewrap" ).toggle();
	$( "#semwrap" ).toggle();
	var c = 1;
	var valid = 1;
	var first = 0, last = 4;
	$.ajaxCall = function(i, j){
		if ( i === j || c === 2 ) return;
		$.when($.ajax({
			url: 'api.notes.php',
			dataType: "json",
			type: "GET",
			data: {
				valpass: i
			},
			success: function(note) {
				if (note === 0) valid = 0;
				if ( valid != 0 ) {
					var count = 0;
					/*if ( c === 1 ) c = 0;
					else c = 1;
					if ( c === 0 ) {
						$('#note-main-wrap').append('<div class="row">');
					}*/
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
					var sm_title = title.substring(0, 50).replace(/<\/?[^>]+(>|$)/g, "") + '.zip';
					if (disp.length > 1500) disp = disp + '... <a href="notes_full.php?id=' + note.ID + '">more</a></p>';
					else disp = disp + '</p>';
					if (title.length > 50) title = title + '...</p>';
					else title = title + '</p>';
					title = '<p>' + title.split(/\n([ \t]*\n)+/g).join('</p><p>').split('\n').join('<br />') + '</p>';
					if ( count === 0 ) {
						$('#note-main-wrap').append('<div class="note_wrapper" id="note_wrap_' + i + '">' +
												'<div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div><hr class=\"divider-title\"/>' +													
												'<div class="note_user"><a href="userdata.php?user_id=' + note.userid + '"> ' + note.userrealname + '</a></div>' +
												'<div class="note_content">' + disp + '</div>' +
												'<hr class=\"divider-title\"/>' +
												'<span>Subject: ' + note.subject + '</span>' +
												'<span>Teacher: ' + note.teacher + '</span>' +
												'<hr class=\"divider-title\"/>' +
												'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
												'</div>');
					}
					else if ( count === 1 ) {
						if ( ext === 'jpeg' || ext === 'jpg' || ext === 'png' || ext === 'bmp' || ext === 'gif' ) {
							$('#note-main-wrap').append('<div class="note_wrapper" id="note_wrap_' + i + '">' +
													'<div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div><hr class=\"divider-title\"/>' +													
													'<div class="note_user"><a href="userdata.php?user_id=' + note.userid + '"> ' + note.userrealname + '</a></div>' +
													'<div class="note_file_wrap"><img class="note_pic" id="note_pic_' + i + '" src="' + file + '"></img></div>' +
													'<div class="note_content">' + disp + '</div>' + 
													'<form class="note_dl" action="api-downloadfiles.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button-single" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
													'<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form>'+
													'<hr class=\"divider-title\"/>' +
													'<span>Subject: ' + note.subject + '</span>' +
													'<span>Teacher: ' + note.teacher + '</span>' +
													'<hr class=\"divider-title\"/>' +
													'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
													'</div>');
						}
						else if ( ext === 'pdf' ) {
							$('#note-main-wrap').append('<div class="note_wrapper" id="note_wrap_' + i + '">' +
													'<div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div><hr class=\"divider-title\"/>' +
													'<div class="note_user"><a href="userdata.php?user_id=' + note.userid + '"> ' + note.userrealname + '</a></div>' +
													'<div class="note_file_wrap"><embed class="note_pdf" id="note_pdf_' + i + '" src="' + file + '"></embed></div>' +
													'<div class="note_title">' + title + '</div>' +
													'<div class="note_content">' + disp + '</div>'+
													'<form class="note_dl" action="api-downloadfiles.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button-single" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
													'<input type="hidden" name="id" value="' + note.ID + '"><input type="hidden" id="file_name_' + note.ID + '" name="filename" value="notes.zip"></form>'+
													'<hr class=\"divider-title\"/>' +
													'<span>Subject: ' + note.subject + '</span>' +
													'<span>Teacher: ' + note.teacher + '</span>'+
													'<hr class=\"divider-title\"/>' +
													'<span class="pull-left save-note" id="save-note-' + note.ID + '">save</span>' +
													'</div>');
						}
					}
					else {
						//might want JQuery objects
						var begin = '<div class="note_wrapper" id="note_wrap_' + i + '"><div class="note_title" id="' + note.ID + '"><a href="notes_full.php?id=' + note.ID + '">' + title + '</a></div><hr class=\"divider-title\"/>' +													
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
								  '<form class="note_dl" action="zip.php" id="form_' + note.ID + '" method="POST"><button type="submit" id="dlb_' + note.ID + '" class="btn btn-default pull-right download-button" name="' + sm_title + '" aria-label="Left Align"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></button>'+
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
