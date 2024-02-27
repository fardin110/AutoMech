<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="2">

	<title>Request a Mechanic</title>
	<style>
body {
	background-color: #333333;
	color: #00000;
	font-family: "Baskerville Old Face", serif;
	font-size: 16px;
	line-height: 1.5;
	margin: 0;
	padding: 0;
}

.profile-box {
	display: flex;
	flex-direction: column;
	align-items: center;
	background-color: #ffffff;
	border-radius: 10px;
	padding: 20px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
	max-width: 400px;
	margin: 0 auto;
	margin-top: 50px;
    margin-bottom: 50px;
}

.profile-box img {
	width: 150px;
	height: 150px;
	border-radius: 5%;
	object-fit: cover;
	margin-bottom: 20px;
}

.profile-box h2 {
	margin-bottom: 10px;
}

.profile-box p {
	margin-bottom: 8px;
	font-weight: bold;
	padding-bottom: 5px;
	border-bottom: 1px solid #ccc;
}
.profile-box .unavailable {
		font-weight: bold;
		color: red;
	}
    
	</style>
</head>
<body>
<?php
  
    $conn = mysqli_connect("localhost", "root", "", "autoshop_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM mechanics WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo '<div class="profile-box">';
        echo '<img src="' . $row["image"] . '">';
        echo '<h2>' . $row["name"] . '</h2>';

		if ($row["accept_request"] == "YES") {
        echo '<p>Email:   ' . $row["mechanic_email"] . '</p>';


			echo '<p>Contact:   ' . $row["contact"] . '</p>';
		} else {
			echo '<p class="unavailable">Contact information is not available at the moment.</p>';
		}
        echo '<p>Expert Type:   ' . $row["expert_type"] . '</p>';
        echo '<p>Shop Name:   ' . $row["shop_name"] . '</p>';
        echo '<p>Shop Location:   ' . $row["shop_location"] . '</p>';

        // Check if the request has already been made by the customer
        session_start();
        $customer_id = $_SESSION['id'];
        $sql = "SELECT * FROM requests WHERE mechanic_id = $id AND customer_id = $customer_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Request already made by the customer
            echo '<button disabled>Request Sent</button>';
        } else {

// Button to make a request
echo '<form method="POST">';
echo '<input type="hidden" name="mechanic_id" value="' . $id . '">';
echo '<input type="hidden" name="customer_id" value="' . $customer_id . '">';

echo '<button type="submit" name="request" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Request</button>';


echo '</form>';
}
echo '</div>';
} else {
echo "No mechanic found.";
}

// Handle request submission
if (isset($_POST['request'])) {
$mechanic_id = $_POST['mechanic_id'];
$customer_id = $_POST['customer_id'];

$sql = "INSERT INTO requests (mechanic_id, customer_id) VALUES ($mechanic_id, $customer_id)";
if (mysqli_query($conn, $sql)) {
echo "Request submitted successfully.";
} else {
echo "Error: " . mysqli_error($conn);
}
}

mysqli_close($conn);
?>
