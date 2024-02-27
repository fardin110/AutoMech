<!DOCTYPE html>
<html>
<head>
	<title>Mechanics in Dhanmondi</title>
	<link rel="stylesheet" type="text/css" href="mech_list.css">
</head>
<body>
	<h1>List of Mechanics in Dhanmondi</h1>

	<?php
		// Replace the values in the following line with your own MySQL server details
		$conn = mysqli_connect("localhost", "root", "", "autoshop_db");

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT id, name, expert_type, shop_name FROM mechanics WHERE shop_location = 'Dhanmondi'";
		$result = mysqli_query($conn, $sql);

		echo "<table class='transparent-table'>";
		echo "<thead><tr><th>Name</th><th>Expert Type</th><th>Shop Name</th><th>Action</th></tr></thead>";
		echo "<tbody>";

		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" . $row["name"] . "</td>";
			echo "<td>" . $row["expert_type"] . "</td>";
			echo "<td>" . $row["shop_name"] . "</td>";
			echo '<td><a class="btn-request" href="request.php?id=' . $row["id"] . '">View</a></td>';
			echo '</tr>';
		}

		echo "</tbody></table>";

		mysqli_close($conn);
	?>
</body>
</html>
