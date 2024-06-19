<?php
    error_reporting(0);
    include('../assets/config.php');
    if(isset($_SESSION['uid'])){

        $userId = $_SESSION['uid'];
        $sql = 'SELECT `role` FROM `users` WHERE `users`.`id`=? ;';

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_assoc($result);
        if($row['role'] == 'admin'){

        }else{
            include('../assets/logout.php');
            header("Location: ../login.php");
            exit();
        }

    }
?>