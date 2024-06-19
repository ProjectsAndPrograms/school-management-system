<?php

include('config.php');
session_start();
$response = array();

if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];

    $studentCountQuery = "SELECT COUNT(`id`) FROM `students`;";
    $stmt1 = mysqli_prepare($conn, $studentCountQuery);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_bind_result($stmt1, $studentCount);
    mysqli_stmt_fetch($stmt1);
    mysqli_stmt_close($stmt1);

    $noticeCountQuery = "SELECT COUNT(*) FROM `notice`;";
    $stmt2 = mysqli_prepare($conn, $noticeCountQuery);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result($stmt2, $noticeCount);
    mysqli_stmt_fetch($stmt2);
    mysqli_stmt_close($stmt2);
    
    $teacherCountQuery = "SELECT COUNT(`id`) FROM `teachers`;";
    $stmt3 = mysqli_prepare($conn, $teacherCountQuery);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $teacherCount);
    mysqli_stmt_fetch($stmt3);
    mysqli_stmt_close($stmt3);


    $classCountQuery = "SELECT COUNT(*) FROM `notes`;";
    $stmt4 = mysqli_prepare($conn, $classCountQuery);
    mysqli_stmt_execute($stmt4);
    mysqli_stmt_bind_result($stmt4, $classCount);
    mysqli_stmt_fetch($stmt4);
    mysqli_stmt_close($stmt4);

    if(isset($studentCount)){
        $response['status'] = "success";
       
        $response['studentCount'] = $studentCount;
        $response['teacherCount'] = $teacherCount;
        $response['noticeCount'] = $noticeCount;
        $response['classCount'] = $classCount;

    }else{
        $response['status'] = "Error";
        $response["message"] = "Something went wrong.";
    }

}else{
    $response['status'] = "Error";
    $response["message"] = "Something went wrong, user not found.";
}


echo  json_encode($response);
?>
