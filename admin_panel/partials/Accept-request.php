<?php
include("config.php"); // Include your database connection file

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update query
    $sql = "UPDATE students SET request = 'accepted' WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the 'id' parameter
    mysqli_stmt_bind_param($stmt, "s", $id);

    // Execute the statement
    if(mysqli_stmt_execute($stmt)) {
        echo "<alert>Record updated successfully</alert>";
        header("Location: ../buses.php");

    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "ID parameter is missing";
}
?>
