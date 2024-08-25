<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $admission_number = $_POST['admission_number'];

    // Validate and sanitize data
    if (empty($name) || empty($admission_number)) {
        die("Please fill all required fields.");
    }

    // Database connection
    $con = new mysqli("localhost", "root", "", "login");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and execute the query
    $stmt = $con->prepare("SELECT admission_number, name FROM StudentDetails WHERE admission_number = ? AND name = ?");
    $stmt->bind_param("is", $admission_number, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Record exists
        header("Location: news.html"); // Redirect to the news page
        exit();
    } else {
        // Record does not exist
        header("Location: index.html"); // Redirect to the index page
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    // Handle invalid request method
    header("Location: index.html");
    exit();
}
?>
