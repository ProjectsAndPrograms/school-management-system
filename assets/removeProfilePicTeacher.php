<?php
    include("config.php");
    session_start();
    $response = "";

    if(isset($_SESSION['uid'])){
        $id = $_SESSION['uid'];
        $defaultImage = "1701517055user.png";

        $query = "UPDATE `teachers` SET `image` = ? WHERE `teachers`.`id` = ?;";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $defaultImage, $id);

        if(mysqli_stmt_execute($stmt)){
            $response = "success";
        }else{
            $response = "Something went wrong!";
        }

    }else{
        $response = "Something went wrong!";
    }

echo  $response;

?>