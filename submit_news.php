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

// Retrieve news content from form
$newsContent = $_POST['news'];

// Prepare and execute SQL query
$sql = "INSERT INTO news (content) VALUES (?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param('s', $newsContent);

if ($stmt->execute()) {
    echo "News submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
