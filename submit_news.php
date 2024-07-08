<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $password = $_POST['password'];
    $news_content = $_POST['news'];

    // Check if the password is correct
    if ($password !== "123") {
        die("Incorrect password");
    }

    // Sanitize news content
    $news_content = filter_var($news_content, FILTER_SANITIZE_STRING);

    // Database connection
    $con = new mysqli("localhost", "root", "", "admin");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO news (content) VALUES (?)");
    $stmt->bind_param("s", $news_content);

    // Execute the statement
    if ($stmt->execute()) {
        echo "News submitted successfully!";
    } else {
        die("Error: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    // Handle invalid request method
    header("Location: admin.html");
    exit();
}
?>