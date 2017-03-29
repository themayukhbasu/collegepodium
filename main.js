/*#################################################################

DOCUMENTATION IN PROGRESS  -MB

##################################################################*/

/* Wrapper Function to wrap all the functions till the document is ready i.e. the web page is properly loaded  */
$(document).ready(function(){  
	
	/* The function is used to parse the data from the GET method variables sent in the URI */
	function parse(val) {		 
		var result = 0, tmp = [];
		location.search      /* gets the locations of the URL sent by the GET method || http://www.w3schools.com/jsref/prop_loc_search.asp || http://www.w3schools.com/jsref/obj_location.asp */
			.substr(1)	     /* substr method cuts the first character and displays the rest, it is a string parsing method  || http://www.w3schools.com/jsref/jsref_substr.asp */
			.split("&")	     /* string parsing method splits the string by the input  || http://www.w3schools.com/jsref/jsref_split.asp */
			.forEach(function (item) {
				tmp = item.split("=");
				if (tmp[0] === val) result = decodeURIComponent(tmp[1]);   /* Decodes the URI components from HTML special characters || http://www.w3schools.com/jsref/jsref_decodeuricomponent.asp */
			});
		return result;
	} /* END parse() method */
	
	/* ======================= DOCUMENTATION DONE TILL THIS LINE ============================================= */
	
	var col = parse('col');
	var uni = parse('uni');
	var dep = parse('dep');
	var type = parse('type');
	var sort = parse('sort');
	first = 0; last = 5;
	
    $.ajaxCall = function(i, j){
		if ( i === j ) return;
		$.when($.ajax({
			url: 'pull.php',
			dataType: "json",
			data: {
				valpass: i,
				col: col,
				dep: dep,
				uni: uni,
				type: type,
				sort: sort
			},
			success: function(dat) {

				var disp = dat.post.substring(0,1500);
				disp = '<p>' + disp.split(/\n([ \t]*\n)+/g).join('</p><p>').split('\n').join('<br />');
				var title = dat.title.substring(0, 50);
				title = '<p>' + title.split(/\n([ \t]*\n)+/g).join('</p><p>').split('\n').join('<br />');
				if (dat.post.length > 1500) disp = disp + '... <a href="posts.php?post_id=' + dat.ID + '">more</a></p>';
				else disp = disp + '</p>';
				if (dat.title.length > 50) title = title + '...</p>';
				else title = title + '</p>';
				var tag;
				if ( dat.type === 'query' ) {
					var postType = "query"; 
					var typeLink = 'index.php?type=query';
				}
				else if ( dat.type === 'discuss' ) {
					var postType = "discussion";
					var typeLink = 'index.php?type=discuss';
				}
				else if ( dat.type === 'notice' ) {
					var postType = "notice";
					var typeLink = 'index.php?type=notice';
				}
				else var typeLink = 'index.php';
				if (dat.sectag === '') tag = '<div class="post_primtag"><label>University:</label>' + dat.primtag + '</div>';
				if (dat.tertag === '') tag = '<div class="post_primtag"><label>University:</label>' + dat.primtag + '</div><div class="post_sectag"><label>College:</label>' + dat.sectag + '</div>';
				else tag = '<div class="post_primtag"><label>University:</label> ' + dat.primtag + '</div><div class="post_sectag"><label>College:</label> ' + dat.sectag + '</div><div class="post_tertag"><label>Department:</label> ' + dat.tertag + '</div>';
				if ( dat.file === "NONE" ) {
					//no file to add
					$('#post-wrap').append('<div class="row"><div class="post_content" name="post_' + i + '">' +
					'<div id="post_type"><a class="post-type-link type-' + dat.type + '" href="' + typeLink + '">' + postType + '</a></div><hr class="divider-type-link" />' +
					'<div id="post_title"><a class="post-title" href="posts.php?post_id=' + dat.ID + '">' + title +'</a></div><hr class="divider-title" />' +
					'<div class="post_username">' + dat.userrealname + '</div>' +
					'<button type="button" id="pop_' + i + '" class="btn btn-default pull-right pop" data-trigger="focus hover" data-toggle="popover" title="Details"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>' +
					'<div id="post_data">' + disp + '</div><a href="report.php?id=' + dat.ID + '&type=post">Report Post</a><hr class="divider-title" />' +
					'<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
					'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
					'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
					'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +					
					//'<br/><div id="post_college">' + dat.sectag + '</div>' +
					'</div></div>' );
				}
				else {
					var ext = dat.file.split('.').pop().toLowerCase();
					if (ext === 'jpg' || ext === 'jpeg' || ext === 'png' || ext ==='gif' || ext === 'bmp' ) {
						//write condition and cast different elements into classes (pictures, post & title)
						$('#post-wrap').append('<div class="row"><div class="post_content" name="post_' + i + '">' +
						'<div id="post_type"><a class="post-type-link type-' + dat.type + '" href="' + typeLink + '">' + postType + '</a></div><hr class="divider-type-link" />' +
							'<div id="post_title"><a class="post-title" href="posts.php?post_id=' + dat.ID + '">' + title +'</a></div><hr class="divider-title" />' +
							'<div class="post_username">' + dat.userrealname + '</div>' +
							'<button type="button" id="pop_' + i + '" class="btn btn-default pull-right" data-trigger="focus hover" data-toggle="popover" title="Details"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>' +
							'<div class="pic_wrapper"><img id="post_pic_' + i + '" class="post_pic" src="' + dat.file+'"></div>' +
							'<hr class="divider-title" /><div id="post_data">' + disp + '</div><a href="report.php?id=' + dat.ID + '&type=post">Report Post</a><hr class="divider-title" />' +
							'<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
							'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
							'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
							'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +							
							//'<br/><div id="post_college">' + dat.sectag + '</div>' +
							'</div></div>' 
						);
					}
					else if (ext === 'pdf') {
						//write condition and cast different elements into classes (pictures, post & title)
						$('#post-wrap').append('<div class="row"><div class="post_content" name="post_' + i + '">' +
						'<div id="post_type"><a class="post-type-link type-' + dat.type + '" href="' + typeLink + '">' + postType + '</a></div><hr class="divider-type-link" />' +
							'<div id="post_title"><a class="post-title" href="posts.php?post_id=' + dat.ID + '">' + title +'</a></div><hr class="divider-title" />'  +
							'<div class="post_username">' + dat.userrealname + '</div>' +
							'<button type="button" id="pop_' + i + '" class="btn btn-default pull-right" data-trigger="focus hover" data-toggle="popover" title="Details"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>' +
							//'<embed id="post_pic_' + i + '"  style="width=800px; height=2100px;" class="post_pdf" src="' + dat.file+'">' +
							'<div id="post_pic_' + i + '"  style="width=800px; height=2100px;" class="post_pdf" name="' + dat.file+'">View PDF file</div>' +
							'<hr class="divider-title" /><div id="post_data">' + disp + '</div><a href="report.php?id=' + dat.ID + '&type=post">Report Post</a><hr class="divider-title" />' +
							'<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
							'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
							'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
							'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +				
							//'<br/><div id="post_college">' + dat.sectag + '</div>' +
							'</div></div>' 
						);
					}
					else {
						$('#post-wrap').append('<div class="row"><div class="post_content" name="post_' + i + '">' +						
						'<div id="post_type"><a class="post-type-link type-' + dat.type + '" href="' + typeLink + '">' + postType + '</a></div><hr class="divider-type-link" />' +
							'<div id="post_title"><a class="post-title" href="posts.php?post_id=' + dat.ID + '">' + title +'</a></div>'+
							'<a href="report.php?id=' + dat.ID + '&type=post">Report Post</a>' +
							'<hr class="divider-title" />' +
							'<div class="post_username">' + dat.userrealname + '</div>' +
							'<button type="button" id="pop_' + i + '" class="btn btn-default pull-right" data-trigger="focus hover" data-toggle="popover" title="Details"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>' +
							'<div id="post_data">' + disp + '</div><a href="report.php?id=' + dat.ID + '&type=post">Report Post</a><hr class="divider-title" />' +
							'<span class="vote"><span class="vote-up"><a class="voteup" id="vu_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a></span>' +
							'<span class="votecnt" id="vuc_' + dat.ID + '"></span>' +
							'<span class="vote-down"><a class="votedn" id="vd_' + dat.ID + '"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></span>' +
							'<span class="votecnt" id="vdc_' + dat.ID + '"></span></span>' +
							//'<br/><div id="post_college">' + dat.sectag + '</div>' +
							'</div></div>' );
					}

					/*This appends a end text at the end
					$('#post-wrap').append('<div id="end_content" class="post_content_end">No More Posts Availables</div>'); */
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
				var popoverTemplate = ['<div class="timePickerWrapper popover">',
										'<div class="arrow"></div>',
										'<div class="popover-content">',
										'</div>',
										'</div>'].join('');

				var content = ['<div class="timePickerCanvas">asfaf asfsadf</div>',
								'<div class="timePickerClock timePickerHours">asdf asdfasf</div>',
								'<div class="timePickerClock timePickerMinutes"> asfa </div>', ].join('');
				$('#pop_' + i).popover({
					placement: 'right',
					content: tag,
					html: true,
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
			$.ajaxCall(i + 1, j)
		});
	}

    $.ajaxCall(first, last); 
	$(document).on("click", ".post_pic", function(e) {
		e.preventDefault();
		var url = $(this).attr('src');
		bootbox.dialog({
									message: "<img style='height: auto; max-width: 100%;' src='" + url + "'>",
									size: 'large',
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
		bootbox.dialog({
									message: "<iframe style='height: auto; min-height: 400px; max-height: 2000px; width: 100%' src='" + url + "'>",
									 buttons: {
										close: {
										  label: "Close",
										  className: "btn-primary",
										}
									}
								}).find("div.modal-dialog").addClass("modal-md");
	});	
	
	$(window).scroll(function() {
	   if($(window).scrollTop() + screen.height > $('body').height()) {
		first = last;
		last = first + 2;
		$.ajaxCall(first, last);
	   }
	});

	//Check to see if the window is top if not then display button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
});
