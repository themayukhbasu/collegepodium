<html>

<head>
<meta charset="utf-8">
<title>College Podium :: Post</title>
<link href="Style/post.css" rel="stylesheet" type="text/css">
<style>
#upload-sign {
	background: #F0F0F0 url("thumb/plus.png") no-repeat scroll left;
	height: 40px;
	width: 40px;
}
</style>
<script src="js/jquery.js"></script>
<script>
$(document).ready(function() {
	$("#upload-sign").click(function() {
			$('#file').click();
	});
});
</script>

<?php
include_once 'session.php';
if (!isset($_SESSION['userid'])) header("location: login.php");
?>
</head>

<body>

 
<div class="register-form">
 
	<form action="post.php" method="POST" enctype="multipart/form-data" id="uploadimage"> 
		<h1>Post</h1>
		<div id="register-form-main">			
			<div>
				<span><label>Title</label></span> 
				<input type="text" name="post_title"></input>
			</div>
			<div>
				<span><label>Post</label></span> 
				<textarea name="post_data"> </textarea>
			
			</div>
			<div>
				<span><label>Type</label></span>
				<input type="radio" name="post_type" value="discuss" checked><label id="radio-label">Discussion</label>
				<input type="radio" name="post_type" value="query"><label id="radio-label">Query</label>
				<input type="radio" name="post_type" value="notice"><label id="radio-label">Notice</label> 
				
			</div>
			<div>	
				<span id="upload-sign"></span>
				<div id="upload-div" style='height: 0px;width: 0px; overflow:hidden;'><input name="file" id="file" type="file"/></div>
			</div>
			
			<div>	
				<span><label>Privacy</span></label> 
				<select name="post_priv">
						<option value="public" name="post_priv">Public</option>
						<option value="india" name="post_priv">College</option>
						<option value="usa" name="post_priv">Department</option>
						<option value="uk" name="post_priv">Class</option>
					</select>
			</div>
			<div>
				<input type="submit" value="Post" class="submit" id ="submit"></input>
			</div>
		</div>
	</form>
</div>
    

</body>

</html>