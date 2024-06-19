<?php
include("config.php");
$response = '';

if (isset($_POST['studentid'])) {
    $studentid = $_POST['studentid'];

    // Check if student exists
    $checkSql = "SELECT * FROM students WHERE id=?";
    $checkStmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "s", $studentid);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($checkResult) > 0) {
        $row = mysqli_fetch_assoc($checkResult);
        $pathToFile = ".." . DIRECTORY_SEPARATOR . "studentUploads" . DIRECTORY_SEPARATOR . $row['image'];

        // Start a transaction
        mysqli_begin_transaction($conn);

        // Prepare and execute DELETE statements
        $deleteStmts = [
            mysqli_prepare($conn, "DELETE FROM students WHERE id = ?"),
            mysqli_prepare($conn, "DELETE FROM student_guardian WHERE id = ?"),
            mysqli_prepare($conn, "DELETE FROM users WHERE id = ?"),
            mysqli_prepare($conn, "DELETE FROM `feedback` WHERE `receiver_id` = ?")
        ];

        foreach ($deleteStmts as $stmt) {
            mysqli_stmt_bind_param($stmt, "s", $studentid);
            if (!mysqli_stmt_execute($stmt)) {
                // Rollback on failure
                mysqli_rollback($conn);
                $response = "Deletion Failed!";
                break;
            }
            mysqli_stmt_close($stmt);
        }

        if (empty($response)) {
            if ($row['image'] != '1701517055user.png' && file_exists($pathToFile)) {
                if (unlink($pathToFile)) {
                    // Commit the transaction if all is successful
                    mysqli_commit($conn);
                    $response = "success";
                } else {
                    // Rollback if file deletion fails
                    mysqli_rollback($conn);
                    $response = "Unable to delete file!";
                }
            } else {
                // Commit the transaction if there is no file or file deletion is not needed
                mysqli_commit($conn);
                $response = "success";
            }
        }
    } else {
        $response = "This student id does not exist!";
    }

    mysqli_stmt_close($checkStmt);
} else {
    $response = "Please provide a valid student id!";
}

echo $response;
?>
