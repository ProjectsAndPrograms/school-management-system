<?php
include("config.php");
session_start();
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {



    $uid = $_SESSION['uid'];
    $response['test'] = $_POST['fname'] . " / " . $_POST['lname'];
    if (
        isset($_POST['fname']) &&
        isset($_POST['lname']) &&
        isset($_POST['email']) &&
        isset($_POST['dob']) &&
        isset($_POST['gender']) &&
        isset($_POST['phone']) &&
        isset($_POST['address'])
    ) {
        $query = "UPDATE `admins` SET `fname` = ?, `lname` = ?, `dob` = ?, `phone` = ?, `gender` = ?, `address` = ? WHERE `admins`.`id` = ?;";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssss",$_POST['fname'],$_POST['lname'],$_POST['dob'],  $_POST['phone'], $_POST['gender'], $_POST['address'] ,$uid);
        

        $sql = 'UPDATE `users` SET `email` = ? WHERE `users`.`id` = ?;';
        $stmt2 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt2, "ss",$_POST['email'], $uid);

        if(mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt2)){
            $response['status'] = "success";
            $response['message'] = "Profile Edited Successfully.";
        }else{
            $response['status'] = "Error";
            $response['message'] = "Something went wrong!";
        }
    } else {
        $response['status'] = "Error";
        $response['message'] = "Something went wrong!";
    }


} else {
    $response['status'] = "Error";
    $response['message'] = "Something went wrong!";

}
echo json_encode($response);
?>