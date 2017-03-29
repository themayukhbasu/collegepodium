<html>

<head>
<meta charset="utf-8">
<title>College Podium :: Update Primary Tag</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js"></script>
</head>

<body>
<div id="wrapper">
  <header id="top">
    <h1>College Podium</h1>
    <h3>By Mayukh & Prachatos</h3>
    <nav id="mainnav">
      <ul>
        <li><a href="http://collegePodium.comeze.com/" >Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Post</a></li>
        <li><a href="#" class="thispage">Upload</a></li>
      </ul>
    </nav>
  </header>
 <div id="hero">
 <?php
include_once 'session.php';

if (!$_SESSION) header("location: login.php");
if($_SESSION['userlevel']===0) header("location: login.php");
?>
 <form action="primtag.php" method="POST" enctype="multipart/form-data" id="discuss"> 
    Name: <input type="text" name="gtName"></input><br>
	Type: <input type="text" name="gtType"></input><br/>
	Address: <input type="text" name="gtAddress"></input><br/>
	City: <input type="text" name="gtCity"></input><br/>
	State: <input type="text" name="gtState"></input><br/>
	Country: <input type="text" name="gtCountry"></input><br/>
	<input type="submit" value="Post" class="submit" id ="submit"></input>

</form>
 <form action="sectag.php" method="POST" enctype="multipart/form-data" id="discuss"> 
	Primary ID: <input type="number" name="stPID"></input><br/>
	Primary ID Name: <input type="text" name="stPName"></input><br/>
    Name: <input type="text" name="stName"></input><br/>
	Type: <input type="text" name="stType"></input><br/>
	Address: <input type="text" name="stAddress"></input><br/>
	City: <input type="text" name="stCity"></input><br/>
	State: <input type="text" name="stState"></input><br/>
	Country: <input type="text" name="stCountry"></input><br/>
	<input type="submit" value="Post" class="submit" id ="submit"></input>

</form>
 <form action="tritag.php" method="POST" enctype="multipart/form-data" id="discuss"> 
	Secondary ID: <input type="number" name="ttPID"></input><br/>
	Secondary ID Name: <input type="text" name="ttPName"></input><br/>
    Name: <input type="text" name="ttName"></input><br>
	Type: <input type="text" name="ttType"></input><br/>
	Address: <input type="text" name="ttAddress"></input><br/>
	City: <input type="text" name="ttCity"></input><br/>
	State: <input type="text" name="ttState"></input><br/>
	Country: <input type="text" name="ttCountry"></input><br/>
	<input type="submit" value="Post" class="submit" id ="submit"></input>

</form>
 <form action="quartag.php" method="POST" enctype="multipart/form-data" id="discuss"> 
	Secondary ID: <input type="number" name="qtPID"></input><br/>
	Secondary ID Name: <input type="text" name="qtPName"></input><br/>
    Name: <input type="text" name="qtName"></input><br>
	Type: <input type="text" name="qtType"></input><br/>
	Address: <input type="text" name="qtAddress"></input><br/>
	City: <input type="text" name="qtCity"></input><br/>
	State: <input type="text" name="qtState"></input><br/>
	Country: <input type="text" name="qtCountry"></input><br/>
	<input type="submit" value="Post" class="submit" id ="submit"></input>

</form>

</div>
    

  
<footer>© Copyright 2013 Prachatos & Mayukh</footer> 
</div>
</body>

</html>

