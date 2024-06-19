<?php
    include("config.php");
    session_start();
    $response = "";

    if(isset($_SESSION['uid'])){
        $id = $_SESSION['uid'];
        $defaultImage = "1701517055user.png";

        $sql = "SELECT `role` FROM `users` WHERE `users`.id = ?";


        $stmt2 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt2, "s", $id);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);

        if (mysqli_num_rows($result2)) {
           $row = mysqli_fetch_assoc($result2);    
        
           $query = "";
           if($row['role'] == 'admin'){
                $query = "UPDATE `admins` SET `image` = ? WHERE `admins`.`id` = ?;";

            }else if($row['role'] == 'teacher'){
                 $query = "UPDATE `teachers` SET `image` = ? WHERE `teachers`.`id` = ?;";
           }else{
                $query = "UPDATE `students` SET `image` = ? WHERE `students`.`id` = ?;";
           }

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



       

    }else{
        $response = "Something went wrong!";
    }

echo  $response;

?>