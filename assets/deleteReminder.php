<?php
    session_start();
    include('config.php');

    if(isset($_POST['dbLine'])){
        $sr_no = $_POST['dbLine'];

        // Use prepared statement to delete reminder
        $sql = "DELETE FROM `reminders` WHERE `reminders`.`s_no` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $sr_no);

        if(mysqli_stmt_execute($stmt)){
            echo "deleted";
        }
        else{
            echo "not-deleted";
        }
    }
    else{
        echo "no-data";
    }
?>
