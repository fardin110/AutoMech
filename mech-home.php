<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="10">
	<title>Customer Requests</title>
	<style>
		body {
			font-family: "Baskerville Old Face", serif;
			background-color: #072c08;
			margin: 0;
			padding: 0;
		}	
        .header {
		background-color: #000;
		color: #fff;
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 20px;
	}
	
	.header h1 {
		margin: 0;
	}
	
	.logout {
		background-color: #FF0000;
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 5px;
	}
	
	.logout:hover {
		background-color: #3e8e41;
		cursor: pointer;
	}
	
	table {
		border-collapse: collapse;
		margin: 20px auto;
		background-color: #fff;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
	}
	
	th, td {
		text-align: left;
		padding: 10px;
		border-bottom: 1px solid #ddd;
	}
	
	th {
		background-color: #333;
		color: #fff;
	}
	
	tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	td button {
		background-color: #333;
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 5px;
	}

	td button.accept:hover {
		background-color: #3e8e41;
		cursor: pointer;
	}

	td button.decline:hover {
		background-color: #FF0000;
		cursor: pointer;
	}
</style>
</head>
<body>
	<div class="header">
		<h1>Customer Requests</h1>
		<a href="logout.php" class="logout">Log Out</a>
	</div>
    <table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Contact</th>
			<th>Vehicle Type</th>
			<th>Request Time</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			session_start();
			$mechanic_id = $_SESSION['id'];
			$conn = mysqli_connect("localhost", "root", "", "autoshop_db");

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			if (isset($_POST['accept_request'])) {
				$request_id = $_POST['accept_request'];
				$sql = "UPDATE mechanics SET accept_request='YES' WHERE id=$mechanic_id";
				mysqli_query($conn, $sql);
			} elseif (isset($_POST['decline_request'])) {
				$request_id = $_POST['decline_request'];
				$sql = "UPDATE mechanics SET accept_request='NO' WHERE id=$mechanic_id";
				mysqli_query($conn, $sql);
			}

			$sql = "SELECT customers.name, customers.customer_email, customers.contact, customers.vehicle_type, requests.request_time FROM customers INNER JOIN requests ON customers.id = requests.customer_id WHERE requests.mechanic_id = $mechanic_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td>" . $row["customer_email"] . "</td>";
					echo "<td>" . $row["contact"] . "</td>";
					echo "<td>" . $row["vehicle_type"] . "</td>";
					echo "<td>" . $row["request_time"] . "</td>";
					echo "<td>";
					echo "<form method='post' action=''>";
					echo "<input type='hidden' name='mechanic_id' value='" . $mechanic_id . "'>";
					echo "<input type='hidden' name='customer_email' value='" . $row["customer_email"] . "'>";
					echo "<input type='hidden' name='request_time' value='" . $row["request_time"] . "'>";
					echo "<button type='submit' name='accept'>Accept</button>";
echo "<input type='hidden' name='customer_email' value='" . $row["customer_email"] . "'>";
echo "<input type='hidden' name='request_time' value='" . $row["request_time"] . "'>";

					echo "<button type='submit' name='decline'>Decline</button>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='6'>No requests found.</td></tr>";
			}

			mysqli_close($conn);
		?>

		<?php
			// Handle button clicks
			if (isset($_POST["accept"])) {
                $mechanic_id = $_POST["mechanic_id"];
                $customer_email = $_POST["customer_email"];
                $request_time = $_POST["request_time"];
                $conn = mysqli_connect("localhost", "root", "", "autoshop_db");
            
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
            
                $sql = "UPDATE mechanics SET accept_request = 'YES' WHERE id = $mechanic_id";
                $result = mysqli_query($conn, $sql);
            
                if (!$result) {
                    die("Error updating record: " . mysqli_error($conn));
                }
            
                mysqli_close($conn);
            
                header("Location: mech-home.php");
                exit();
            }
            
			if (isset($_POST["decline"])) {
                $mechanic_id = $_POST["mechanic_id"];
                $customer_email = $_POST["customer_email"];
                $request_time = $_POST["request_time"];
                $conn = mysqli_connect("localhost", "root", "", "autoshop_db");
            
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

				$sql1 = "UPDATE mechanics SET accept_request = 'NO' WHERE id = $mechanic_id";
                $result1 = mysqli_query($conn, $sql1);
                $sql = "DELETE FROM requests WHERE customer_id IN (SELECT id FROM customers WHERE customer_email='$customer_email') AND mechanic_id=$mechanic_id AND request_time='$request_time'";
                $result = mysqli_query($conn, $sql);
            
                if (!$result) {
                    die("Error deleting record: " . mysqli_error($conn));
                }
            
                mysqli_close($conn);
            }
            
		?>
	</tbody>
</table>
</body>
</html> 
