<?php
include("config.php");
session_start();
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);


    $uid = $_SESSION['uid'];

    if (
        isset($data['currentPass']) &&
        isset($data['newPass']) &&
        isset($data['confirmPass'])
    ) {
        $query = "SELECT `password_hash` FROM `users` WHERE `id`=?";

        $currentPass = $data['currentPass'];
        $newPass = $data['newPass'];
        $confirmPass = $data['confirmPass'];


        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($currentPass, $row['password_hash'])) {
            // if ($currentPass == $row['password_hash']) {
                $response['status'] = "success";

                $query2 = "UPDATE `users` SET `password_hash` = ? WHERE `users`.`id` = ?;";

                $stmt2 = mysqli_prepare($conn, $query2);

                $newPassword_hash = password_hash($newPass, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt2, "ss", $newPassword_hash, $uid);
                if (mysqli_stmt_execute($stmt2)) {
                    $response['status'] = "success";
                    $response["message"] = "Password changed successfully.";

                } else {
                    $response['status'] = "Error";
                    $response['message'] = "Something went wrong!";
                }



            } else {
                $response['status'] = "Not_Match";
                $response['message'] = "Wrong password!";
            }
        } else {
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