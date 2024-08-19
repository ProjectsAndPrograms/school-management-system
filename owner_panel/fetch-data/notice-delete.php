<?php
 include("../../assets/config.php");

// Assuming noticeId is sent via POST method
$id = $_POST['noticeId'];

// Using prepared statement to prevent SQL injection
$sql = "DELETE FROM notice WHERE s_no=?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind the parameter to the statement
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Notice deleted";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
