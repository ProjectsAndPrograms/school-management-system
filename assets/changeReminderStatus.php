<?php
session_start();

include('config.php');

if (isset($_POST['dbLine'])) {
    $line = (int)$_POST['dbLine'];

    // Use prepared statement to select reminder
    $selectQuery = "SELECT * FROM reminders WHERE `reminders`.`s_no` = ?";
    $stmtSelect = mysqli_prepare($conn, $selectQuery);
    mysqli_stmt_bind_param($stmtSelect, "i", $line);
    mysqli_stmt_execute($stmtSelect);
    $result = mysqli_stmt_get_result($stmtSelect);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'] == 'pending' ? 'completed' : 'pending';

        // Use prepared statement to update status
        $updateQuery = "UPDATE `reminders` SET `status` = ? WHERE `reminders`.`s_no` = ?";
        $stmtUpdate = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmtUpdate, "si", $status, $line);
        if (mysqli_stmt_execute($stmtUpdate)) {
            echo "Updated " . $status;
        } else {
            echo "Update failed";
        }
    } else {
        echo "Query failed";
    }
} else {
    echo "Error";
}
?>
