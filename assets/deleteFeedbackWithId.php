<?php
include("config.php");
$response = array();

if (isset($_POST["feedbackid"])) {
    $feedbackid = (int) $_POST["feedbackid"];

    $sql = "DELETE FROM `feedback` WHERE `feedback`.`s_no` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $feedbackid);
    if(mysqli_stmt_execute($stmt)){
        $response['status'] = "success";
        $response['message'] = "Feedback deleted successfully!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Unable to delete feedback!";
    }
} else {
    $response['status'] = "success";
    $response['message'] = "Invalid request!";
}

echo json_encode($response);

