<?php
// Database connection setup
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Leave this empty if no password is set for root
$dbname = "admin"; // Using the 'admin' database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered password from the form
    $entered_password = $_POST['password'];

    // Query to get the stored password from the admin table
    $sql = "SELECT password FROM news WHERE id = 1"; // Assuming id = 1 is for admin
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the password from the database
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Check if the entered password matches the stored password
        if ($entered_password === $stored_password) {
            // If correct, redirect to Admin.html
            header("Location: Admin.html");
            exit();
        } else {
            // If incorrect, display an error message
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        echo "Error: Admin not found.";
    }
}

// Close the database connection
$conn->close();
?>
