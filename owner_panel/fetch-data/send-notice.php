<?php
include("../../assets/config.php");

// Assuming form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data 
    $panel = mysqli_real_escape_string($conn, $_POST['panel']);
    $class = mysqli_real_escape_string($conn, $_POST['cla']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into database
    $query = "INSERT INTO notice(title, body, role, class) VALUES ('{$title}', '{$message}', '{$panel}', '{$class}')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Notice saved successfully.";
    } else {
        // Handle database error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle case where form is not submitted via POST
    echo "Form submission method not recognized.";
}
