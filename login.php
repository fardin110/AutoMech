<?php
// start the session
session_start();

$conn = mysqli_connect("localhost", "root", "", "autoshop_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST["role"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    switch ($role) {
        case "admin":
            $table_name = "admins";
            $email_name = "admin_email";
            $password_name = "password";
            $session_id = "id";
            break;
        case "customer":
            $table_name = "customers";
            $email_name = "customer_email";
            $password_name = "password";
            $session_id = "id";
            break;
        case "mechanic":
            $table_name = "mechanics";
            $email_name = "mechanic_email";
            $password_name = "password";
            $session_id = "id";
            break;
        default:
            die("Invalid role specified.");
    }
    // Construct the SQL query using the selected table and column names
    $sql = "SELECT * FROM $table_name WHERE $email_name = '$email' AND $password_name = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Get the user's ID
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        
        // Store the user's ID in the session variable
        $_SESSION[$session_id] = $user_id;
        
        // Redirect to the appropriate home page
        switch ($role) {
            case "admin":
                header("Location: admin-home.php");
                break;
            case "customer":
                header("Location: customer-home.php");
                break;
            case "mechanic":
                header("Location: mech-home.php");
                break;
        }
        exit;
    } else {
        echo "Invalid email or password.";
    }
} 
mysqli_close($conn);
?>


	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="login-style.css">
	</head>
	<body>
		<h1>Login </h1>
		<form method="post" action="login.php">
			<label for="role">Select your role:</label>
			<select id="role" name="role">
				<option value="admin">Admin</option>
				<option value="customer">Customer</option>
				<option value="mechanic">Mechanic</option>
			</select>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Login">
		</form>
	</body>
</html>

