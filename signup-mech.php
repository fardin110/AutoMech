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
			<input type="text" placeholder="Enter Contact Number" name="contact" required>

			<label for="pass"><b>Password</b></label>
			<input type="text" placeholder="Enter Password" name="pass" required>

			<label for="image"><b>Image</b></label>
			<input type="file" name="image" id="image" accept="image/*" required>

			<label for="expert_type"><b>Expertise</b></label>
			<select name="expert_type" id="expert_type" required>
				<option value="">Select Your Area of Expertise</option>
				<option value="car">Car</option>
				<option value="bike">Bike</option>
				<option value="truck">Truck</option>
				<option value="bus">Bus</option>
			</select>

			<label for="shop_name"><b>Shop Name</b></label>
			<input type="text" placeholder="Enter Shop Name" name="shop_name" required>

			<label for="shop_location"><b>Shop Location</b></label>
			<input type="text" placeholder="Enter Shop Name" name="shop_location" required>

			<button type="submit" name="signup"class="button">Sign Up</button>
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
$expert_type = $_POST['expert_type'];
$shop_name = $_POST['shop_name'];
$shop_location = $_POST['shop_location'];

// Insert data into table
$sql = "INSERT INTO mechanics (name,mechanic_email, contact, password,  image, expert_type, shop_name, shop_location) 
		VALUES ('$name','$email', '$contact','$pass', '$image', '$expert_type', '$shop_name','$shop_location')";

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