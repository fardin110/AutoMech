<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'autoshop_db');
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO feedback (mechanic_name, mechanic_email, feedback, customer_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $mechanic_name, $mechanic_email, $feedback, $customer_id);
    
    // Set parameters and execute the statement
    $mechanic_name = $_POST['mechanic_name'];
    $mechanic_email = $_POST['mechanic_email'];
    $feedback = $_POST['feedback'];
    $customer_id = $_SESSION['id'];
    
    $stmt->execute();
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
    
    // Redirect to thank you page
    header('Location: customer-home.php');
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Review & Feedback Page</title>
   <style>
    .container {
    background-color: #a60b00;
    max-width: 800px;
    margin: 0 auto;
    padding: 60px;
}

h1 {
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
    width: 100%;
    max-width: 500px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"], input[type="email"], textarea {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #555;
}
</style>
</head>
<body>
    <div class="container">
        <h1>Review & Feedback</h1>
        <form method="post">
            <div class="form-group">
                <label for="mechanic_name">Mechanic Name:</label>
                <input type="text" id="mechanic_name" name="mechanic_name" required>
            </div>
            <div class="form-group">
                <label for="mechanic_email">Mechanic Email:</label>
                <input type="email" id="mechanic_email" name="mechanic_email" required>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" name="feedback" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
