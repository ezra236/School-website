<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve new password from form
$newPassword = $_POST['new_password'];

// Sanitize input to prevent SQL injection
$newPassword = $conn->real_escape_string($newPassword);

// Prepare and execute SQL query
$sql = "UPDATE news SET password = ? WHERE id = 1"; // Assuming you want to update a specific admin with id = 1
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param('s', $newPassword);

if ($stmt->execute()) {
    echo "Password changed successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
