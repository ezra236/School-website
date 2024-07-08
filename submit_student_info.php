<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $admission_number = $_POST['admission_number'];
    $age = $_POST['age'];
    $course = $_POST['course'];
    $units = $_POST['units'];
    $id_card = $_POST['id_card'];
    $year = $_POST['year'];

    // Validate and sanitize data
    $admission_number = filter_var($admission_number, FILTER_SANITIZE_STRING);
    $age = filter_var($age, FILTER_VALIDATE_INT);
    $course = filter_var($course, FILTER_SANITIZE_STRING);
    $units = array_map('sanitize_units', $units);
    $units = implode(', ', $units); // Convert array to string
    $id_card = filter_var($id_card, FILTER_SANITIZE_STRING);
    $year = filter_var($year, FILTER_SANITIZE_STRING);

    if (!$admission_number || !$age || !$course || !$units || !$id_card || !$year) {
        die("Invalid input. Please ensure all fields are filled correctly.");
    }

    // Database connection
    $con = new mysqli("localhost", "root", "", "Course");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO students (admission_number, age, course, units, id_card, year) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $admission_number, $age, $course, $units, $id_card, $year);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Student information has been submitted successfully!";
    } else {
        die("Error: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    // Handle invalid request method
    header("Location: my_courses.html");
    exit();
}

function sanitize_units($unit) {
    return filter_var($unit, FILTER_SANITIZE_STRING);
}
?>