<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $admission_number = $_POST['admission_number'];

    // Validate and sanitize data as needed
    if (empty($name) || empty($admission_number)) {
        die("Please fill all required fields.");
    }

    // Database connection
    $con = new mysqli("localhost", "root", "", "Login");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO StudentDetails (admission_number, name) VALUES (?, ?)");
    $stmt->bind_param("is", $admission_number, $name);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect or return success message
        header("Location: feedback.html"); // Redirect to the feedback page
        exit();
    } else {
        die("Error: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    // Handle invalid request method or direct access
    header("Location: index.html"); // Redirect to the index page
    exit();
}
?>