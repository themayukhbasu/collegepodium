$(document).ready(function() {
	$(".navbar-fixed-top").headroom();
	$("#sidebar-wrapper").headroom();
	$("#logout").click(function(){
		bootbox.confirm("Are you sure?", function(result) {
			if ( result === true ) {
				$.ajax({
					url: 'logout.php',
					dataType: "json",
					data: {
						csrftoken: $('#sidebar-token').val()
					},
					type: "POST",
					success: function(val) {
						if ( val === 1 ) 
							window.location = "login.php";
						else bootbox.alert("Logout operation failed. Please refresh and try logging out again");
					}
				});
			} 
		});
	});
	$("#settings-logout").click(function(){
		bootbox.confirm("Are you sure?", function(result) {
			if ( result === true ) {
				$.ajax({
					url: 'logout.php',
					dataType: "json",
					data: {
						csrftoken: $('#sidebar-token').val()
					},
					type: "POST",
					success: function(val) {
						if ( val === 1 ) 
							window.location = "login.php";
						else bootbox.alert("Logout operation failed. Please refresh and try logging out again");
					}
				});
			} 
		});
	});
	$( "#sidebar-wrapper" ).toggle();
	$("#drawer").click(function() {
        $("#sidebar-wrapper").toggle();
	});
	$("#left-menu-tgl").click(function() {
        $("#sidebar-wrapper").toggle();
	});
});