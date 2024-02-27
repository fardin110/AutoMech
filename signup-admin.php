<!DOCTYPE html>
<html>
<head>
	<title>Sign Up - AutoMech</title>
	<link rel="stylesheet" type="text/css" href="signup-style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVpDMN7iSXA+NIEDbIcYv2v+79V3OWq1uU1LWqbQ6Lr" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<form action="" method="POST" enctype="multipart/form-data">
			<h1>Sign Up</h1>
			<p>Please fill in this form to create an account as an Admin.</p>
			<hr>

			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Name" name="name" required>

            <label for="email"><b>Email</b></label>
			<input type="text" placeholder="Enter Email" name="email" required>

			<label for="contact"><b>Contact</b></label>
			<input type="text" placeholder="Enter Contact Number" name="contact" required>

			<label for="pass"><b>Password</b></label>
			<input type="text" placeholder="Enter Password" name="pass" required>

			<label for="image"><b>Image</b></label>
			<input type="file" name="image" id="image" accept="image/*" required>

			<label for="nid"><b>National ID</b></label>
			<input type="text" placeholder="Enter NID number" name="nid" required>

			<label for="auth-code"><b>Authorized Code</b></label>
			<input type="text" placeholder="Enter Provided Authorized Code" name="auth_code" required>

	

			<button type="submit" name="signup" class="button">Sign Up</button>
		</form>
	</div>
</body>
</html>


<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autoshop_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['signup'])) {
	// Get form data

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$pass = $_POST['pass'];
$image = $_FILES['image']['name'];
$nid = $_POST['nid'];
$auth_code = $_POST['auth_code'];

// Insert data into table
$sql = "INSERT INTO admins (name,admin_email, contact, password, image, nid,  auth_code) 
		VALUES ('$name','$email', '$contact','$pass', '$image', '$nid', '$auth_code')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		header("Location: home.php");
		exit;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
?>