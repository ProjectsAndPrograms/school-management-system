<?php
include("config.php");
session_start();

if(isset($_SESSION['uid'])){

    if(isset($_POST['theme'])){
        $theme = $_POST['theme'];
        $uid = $_SESSION['uid'];
        echo $theme;

        // Using prepared statement
        $query = "UPDATE `users` SET `theme` = ? WHERE `users`.`id` = ?";
        $stmt = mysqli_prepare($conn, $query);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $theme, $uid);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }
}
?>
