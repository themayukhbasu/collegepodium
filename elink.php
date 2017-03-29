	
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "cool123";
	$dbname = "testdb";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	if (isset($_POST["submit"])) {
		
		
	$em=$_POST["email"];
	$sql="INSERT INTO sqlemail(email) VALUES('$em')";
	

	if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
	
	}
	
?>