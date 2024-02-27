<?php
session_start();
// Replace the placeholders with your own database information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autoshop_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the customer's ID from the session
$id = $_SESSION["id"];

// Retrieve the updated information from the form submission
$name = $_POST["name"];
$email = $_POST["email"];
$contact = $_POST["contact"];
$password = $_POST["password"];
$image = $_POST["image"];
$vehicle_type = $_POST["vehicle_type"];
$vehicle_model = $_POST["vehicle_model"];
$vehicle_serial = $_POST["vehicle_serial"];

// Update the customer's information in the database
$sql = "UPDATE customers SET name = '$name', customer_email = '$email', contact = '$contact', password = '$password', image = '$image', vehicle_type = '$vehicle_type', vehicle_model = '$vehicle_model', vehicle_serial = '$vehicle_serial' WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    // Redirect to the profile page after the update is successful
    header("Location: customer-home.php");
    exit();
} else {
    // Redirect to an error page if the update fails
    header("Location: error.php");
    exit();
}

$conn->close();
?>
