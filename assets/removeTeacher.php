
<?php
include("config.php");

if (isset($_POST['teacherid'])) {
    $teacherid = $_POST['teacherid'];

    // Check if teacher exists
    $checkSql = "SELECT * FROM `teachers` WHERE `id`=?";
    $checkStmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "s", $teacherid);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if (mysqli_num_rows($checkResult) > 0) {

        $row = mysqli_fetch_assoc($checkResult);
        $pathToFile = ".." . DIRECTORY_SEPARATOR . "teacherUploads" . DIRECTORY_SEPARATOR . $row['image'];

        // Start a transaction
        mysqli_begin_transaction($conn);

        // Prepare and execute DELETE statements
        $deleteStmts = [
            mysqli_prepare($conn, "DELETE FROM `teachers` WHERE `id` = ?"),
            mysqli_prepare($conn, "DELETE FROM `teacher_guardian` WHERE `id` = ?"),
            mysqli_prepare($conn, "DELETE FROM `users` WHERE `id` = ?"),
            mysqli_prepare($conn, "DELETE FROM `reminders` WHERE `id` = ?"),
            mysqli_prepare($conn, "DELETE FROM `leaves` WHERE `sender_id` = ?"),
            mysqli_prepare($conn, "DELETE FROM `feedback` WHERE `sender_id` = ?")
        ];

        foreach ($deleteStmts as $stmt) {
            mysqli_stmt_bind_param($stmt, "s", $teacherid);
            if (!mysqli_stmt_execute($stmt)) {
                // Rollback on failure
                mysqli_rollback($conn);
                echo "Deletion Failed!";
                break;
            }
            mysqli_stmt_close($stmt);
        }

        if (empty($response)) {
            // Delete the image file if it exists
            if ($row['image'] != '1701517055user.png' && file_exists($pathToFile)) {
                if (unlink($pathToFile)) {
                    // Commit the transaction if all is successful
                    mysqli_commit($conn);
                    echo "success";
                } else {
                    // Rollback if file deletion fails
                    mysqli_rollback($conn);
                    echo "Unable to delete image file!";
                }
            } else {

                mysqli_commit($conn);
                echo "success";
            }
        }

    } else {
        echo "This teacher id does not exist!";
    }

    mysqli_stmt_close($checkStmt);
} else {
    echo "Please provide a valid teacher id!";
}
?>
