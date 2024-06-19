<?php
session_start();
include("config.php");

$response = array();

$pending = "pending";
$approved = "approved";
$rejected = "rejected";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        

        $totalTeacherQuery = "SELECT COUNT(*) AS `count` FROM `teachers`";        
        $stmt1 = mysqli_prepare($conn, $totalTeacherQuery);
        mysqli_stmt_execute($stmt1);
        $result1 = mysqli_stmt_get_result($stmt1);
        $row1 = mysqli_fetch_assoc($result1);
        $response['teachers-count'] = $row1['count'];
        mysqli_stmt_close($stmt1);
        
        $countLeaveQuery = "SELECT COUNT(*) AS `count` FROM `leaves` WHERE `leaves`.`status` = ?";
        $stmt2 = mysqli_prepare($conn, $countLeaveQuery);
        mysqli_stmt_bind_param($stmt2, "s", $approved);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        $row2 = mysqli_fetch_assoc($result2);
        $response['approved-count'] = $row2['count'];
        mysqli_stmt_close($stmt2);

        $stmt3 = mysqli_prepare($conn, $countLeaveQuery);
        mysqli_stmt_bind_param($stmt3, "s", $pending);
        mysqli_stmt_execute($stmt3);
        $result3 = mysqli_stmt_get_result($stmt3);
        $row3 = mysqli_fetch_assoc($result3);
         $response['pending-count'] = $row3['count'];
        mysqli_stmt_close($stmt3);

        $stmt4 = mysqli_prepare($conn, $countLeaveQuery);
        mysqli_stmt_bind_param($stmt4, "s", $rejected);
        mysqli_stmt_execute($stmt4);
        $result4 = mysqli_stmt_get_result($stmt4);
        $row4 = mysqli_fetch_assoc($result4);
        $response['rejected-count'] = $row4['count'];
        mysqli_stmt_close($stmt4);
       

        $response['status'] = 'success';
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Something went wrong!";
    }
} else {
    $response['status'] = "ERROR";
    $response['message'] = "Invalid request!";
}

echo json_encode($response);
