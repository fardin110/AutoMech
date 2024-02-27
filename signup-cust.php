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
			<p>Please fill in this form to create an account.</p>
			<hr>

			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Name" name="name" required>

            <label for="email"><b>Email</b></label>
			<input type="text" placeholder="Enter Email" name="email" required>

			<label for="contact"><b>Contact</b></label>
			<input type="text" placeholder="Enter Contact Number" name="contact" pattern="[0-9]{11}" title="Enter 11 digit Number" required>


			<label for="pass"><b>Password</b></label>
			<input type="text"  placeholder="Enter Password" name="pass" required>

			<label for="image"><b>Image</b></label>
			<input type="file" name="image" id="image" accept="image/*" required>

			<label for="vehicle_type"><b>Vehicle Type</b></label>
			<select name="vehicle_type" id="vehicle_type" required>
				<option value="">Select Vehicle Type</option>
				<option value="car">Car</option>
				<option value="bike">Bike</option>
				<option value="truck">Truck</option>
				<option value="bus">Bus</option>
			</select>

			<label for="vehicle_model"><b>Vehicle Model</b></label>
			<input type="text" placeholder="Enter Vehicle Model" name="vehicle_model" required>

			<label for="vehicle_serial"><b>Vehicle Serial Number</b></label>
			<input type="text" placeholder="Enter Vehicle Serial Number" name="vehicle_serial" required>

	

			<button type="submit" name='signup'class="button">Sign Up</button>
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

// Check if form has been submitted
if (isset($_POST['signup'])) {
	// Get form data
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$pass = $_POST['pass'];
	$image = $_FILES['image']['name'];
	$vehicle_type = $_POST['vehicle_type'];
	$vehicle_model = $_POST['vehicle_model'];
	$vehicle_serial = $_POST['vehicle_serial'];

	// Insert data into table
	$sql = "INSERT INTO customers (name,customer_email, contact,password,  image, vehicle_type, vehicle_model, vehicle_serial) 
			VALUES ('$name','$email', '$contact', '$pass', '$image', '$vehicle_type', '$vehicle_model', '$vehicle_serial')";

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
