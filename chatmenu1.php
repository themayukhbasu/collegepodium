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
	<script src="header.js"></script>
	
	<?php
		require_once 'session.php';
		include 'TokenMethod.php';
		$csrf = new csrfToken;
		$csrf->setToken();
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
		
			p{
			
		 text-align:center;
			overflow:auto;
	padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 270px;
			
		}
		
	</style>

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
						 <span id="btn-draw" class="glyphicon glyphicon glyphicon-align-justify" aria-hidden="true"></span>
						</button>
					</div>
				</div>
				<div class="col-sm-6 col-md-6" id="col-draw">
					<a id="head-link"href="index.php">college podium</a>
				</div>
				<div class="col-sm-3 col-md-3">
					<form class="navbar-form" role="search">			
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>

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
                    <a href="#">college</a>
                </li>
                <li>
                    <a href="#">university</a>
                </li>
                <li>
                    <a href="#">department</a>
                </li>
                <li>
                    <a href="index.php">all posts</a>
                </li>
				
				<hr class="divider" />
				
				<li>
                    <a href="notes.php">all notes</a>
                </li>
				
				<hr class="divider" />
				
				<li>
                    <a href="#" id="logout">logout</a>
                </li>
				<hr class="divider" />
				<li>
				<input type="hidden" value="<?php echo($_SESSION['csrftoken']); ?>" id="sidebar-token">
				</li>
            </ul>
        </div>
        <!-- END/#sidebar-wrapper -->
		

        <!-- #page-content-wrapper----->
		
		
		
		<!-- END/#page-content-wrapper----->
		
		

		</div>
			  

	 </div>	
	 
	 
	 
	 <p>
	 <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mvp_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT * FROM register");

 
    $stmt->execute(); 

    $meta = $stmt->result_metadata(); 
    while ($field = $meta->fetch_field()) 
    { 
        $params[] = &$row[$field->name]; 
		
    } 

    call_user_func_array(array($stmt, 'bind_result'), $params); 

 
 while ($stmt->fetch()) { 
        foreach($row as $key => $val) 
        { 
            $c[$key] = $val; 
        } 
        $output[] = $c; 
    } 
    
    $stmt->close();  
	var_dump($output);


	 ?>
	 </p>
	 

</body>
</html>