<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $year = $_POST['year'];
    $rating = $_POST['rating'];

    // Validate and sanitize data
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $year = filter_var($year, FILTER_SANITIZE_STRING);
    $rating = filter_var($rating, FILTER_VALIDATE_INT);

    if (!$name || !$email || !$year || !$rating || $rating < 1 || $rating > 5) {
        die("Invalid input. Please ensure all fields are filled correctly.");
    }

    // Database connection
    $con = new mysqli("localhost", "root", "", "Feedback");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO feedback (name, email, year, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $year, $rating);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Thank you for your feedback!";
    } else {
        die("Error: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    // Handle invalid request method
    header("Location: feedback.html");
    exit();
}
?>