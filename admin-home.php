<!DOCTYPE html>
<html>
<head>
	<title>Admin Home Page</title>
    <link rel="stylesheet" type="text/css" href="admin-home-style.css">
</head>
<body>
	<h1>Customers</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Vehicle Type</th>
				<th>Vehicle Model</th>
				<th>Vehicle Serial</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
        <a class="btn btn-danger logout-button" href="logout.php">Logout</a>


			<?php
				// Database connection
				$conn = mysqli_connect("localhost", "root", "", "autoshop_db");
				if(!$conn) {
					die("Error connecting to the database");
				}

				// Check if the delete button is clicked
				if(isset($_GET['delete_id'])) {
					$delete_id = $_GET['delete_id'];

					// Delete the customer from the database
					$sql = "DELETE FROM customers WHERE id=$delete_id";
					mysqli_query($conn, $sql);
				}

				// Fetch data from the customer table
				$sql = "SELECT * FROM customers";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['customer_email'] . "</td>";
						echo "<td>" . $row['contact'] . "</td>";
						echo "<td>" . $row['vehicle_type'] . "</td>";
						echo "<td>" . $row['vehicle_model'] . "</td>";
						echo "<td>" . $row['vehicle_serial'] . "</td>";
						echo "<td><a href='signup-cust.php?id=". $row['id'] . "'>Add</a> | <a href='admin-home.php?delete_id=". $row['id'] . "'>Delete</a></td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='8'>No Customers Found</td></tr>";
				}
				mysqli_close($conn);
			?>
		</tbody>
	</table>
</body>
</html>






<!DOCTYPE html>
<html>
<head>
	<title>Admin Home Page</title>
    <link rel="stylesheet" type="text/css" href="admin-home-style.css">
</head>
<body>
	<h1>Mechanics</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Expert Type</th>
				<th>Shop Name</th>
				<th>Shop Location</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// Database connection
				$conn = mysqli_connect("localhost", "root", "", "autoshop_db");
				if(!$conn) {
					die("Error connecting to the database");
				}

				// Check if the delete button is clicked
				if(isset($_GET['id'])) {
					$delete_id = $_GET['id'];

					// Delete the mechanic from the database
					$sql = "DELETE FROM mechanics WHERE id=$delete_id";
					mysqli_query($conn, $sql);
				}

				// Fetch data from the mechanic table
				$sql = "SELECT  * FROM mechanics";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['mechanic_email'] . "</td>";
						echo "<td>" . $row['contact'] . "</td>";
						echo "<td>" . $row['expert_type'] . "</td>";
						echo "<td>" . $row['shop_name'] . "</td>";
						echo "<td>" . $row['shop_location'] . "</td>";
						echo "<td><a href='signup-mech.php?id=". $row['id'] . "'>Add</a> | <a href='admin-home.php?id=". $row['id'] . "'>Delete</a></td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='8'>No Mechanics Found</td></tr>";
				}
				mysqli_close($conn);
			?>
		</tbody>
	</table>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Home Page</title>
</head>
<body>
	<h1>Feedbacks</h1>
	<table>
		<thead>
			<tr>
				<th>Serial</th>
				<th>Mechanic's Name</th>
				<th>Mechanic's Email</th>
				<th>Feedback</th>
				<th>Customer's ID</th>
				<th>Time-Stamp</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// Database connection
				$conn = mysqli_connect("localhost", "root", "", "autoshop_db");
				if(!$conn) {
					die("Error connecting to the database");
				}

				// Check if the delete button is clicked
				if(isset($_GET['id'])) {
					$delete_id = $_GET['id'];

					// Delete the mechanic from the database
					$sql = "DELETE FROM feedback WHERE id=$delete_id";
					mysqli_query($conn, $sql);
				}

				// Fetch data from the mechanic table
				$sql = "SELECT  * FROM feedback";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['mechanic_name'] . "</td>";
						echo "<td>" . $row['mechanic_email'] . "</td>";
						echo "<td>" . $row['feedback'] . "</td>";
						echo "<td>" . $row['customer_id'] . "</td>";
						echo "<td>" . $row['created_at'] . "</td>";
						echo "<td><a href='admin-home.php?id=". $row['id'] . "'>Delete</a></td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='8'>No Feedbacks Found</td></tr>";
				}
				mysqli_close($conn);
			?>
		</tbody>
	</table>
</body>
</html>
