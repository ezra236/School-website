<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validate and sanitize data as needed
    if (empty($name) || empty($password)) {
        die("Please fill all required fields.");
    }

    // Database connection
    $con = new mysqli("localhost", "root", "", "login");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO StudentDetails (name, email, admission_number) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect or return success message
        header("Location: my_courses.html"); // Redirect to the feedback page
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

