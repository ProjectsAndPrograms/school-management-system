<?php
session_start();
include("config.php");
$response = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if(isset($data['message']) && isset($data['receiver'])){

        $message = $data["message"];
        $receiverId = $data['receiver'];
        $senderId = $_SESSION['uid'];

        $sql = "INSERT INTO `feedback` (`sender_id`, `receiver_id`, `msg`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $senderId, $receiverId, $message); 

        if (mysqli_stmt_execute($stmt)) {
            $response['status'] = 'success';
            $response['msg'] = 'successfully sent!'; 
        } else {
            $response['status'] = 'error';
            $response['msg'] = 'unable to send feedback!';
        }

        mysqli_stmt_close($stmt);

    }else{
        $response['status'] = 'error';
        $response['msg'] = 'messages are not received by server!'; 
    }
   
} else {
    $response['status'] = 'error';
    $response['msg'] = 'request method is unauthorized!';
}


echo json_encode($response);
