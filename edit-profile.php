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
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION["id"];

// Select the customer's information from the database
$sql = "SELECT * FROM customers WHERE id = $id";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the customer's information
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["customer_email"];
    $contact = $row["contact"];
    $password = $row["password"];
    $image = $row["image"];
    $vehicle_type = $row["vehicle_type"];
    $vehicle_model = $row["vehicle_model"];
    $vehicle_serial = $row["vehicle_serial"];
} else {
    // Redirect to an error page if the customer's ID is invalid
    header("Location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Edit Profile</title>
    <style>
        /* Set the font family to Baskerville Old Face */
        body {
            background-color: #444444;
            font-family: "Baskerville Old Face", serif;
        }
        /* Add some padding and a border to the form */
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        h1 {
    text-align: center;
    margin-top: 50px;
    color: #fff;
    font-family: "Baskerville Old Face", serif;
}

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 18px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <h1>Edit Profile</h1>
    <form method="post" action="update-profile.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="contact">Contact:</label>
        <input type="text" name="contact" value="<?php echo $contact; ?>"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $password; ?>"><br>
        <label for="image">Image:</label>
        <input type="text" name="image" value="<?php echo $image; ?>"><br>
        <label for="vehicle_type">Vehicle Type:</label>
        <input type="text" name="vehicle_type" value="<?php echo $vehicle_type; ?>"><br>
        <label for="vehicle_model">Vehicle Model:</label>
        <input type="text" name="vehicle_model" value="<?php echo $vehicle_model; ?>"><br>
        <label for="vehicle_serial">Vehicle Serial:</label>
        <input type="text" name="vehicle_serial" value="<?php echo $vehicle_serial; ?>"><br>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
