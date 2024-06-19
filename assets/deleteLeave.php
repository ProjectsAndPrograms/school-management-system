<?php
session_start();
include("config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_SESSION['uid'], $_POST['s_no'])) {
        $uid = $_SESSION['uid'];
        $s_no = (int) $_POST['s_no'];

        $query = "SELECT `role` FROM `users` WHERE `users`.`id`=? LIMIT 1";
        $stmt2 = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt2, "s", $uid);
        mysqli_stmt_execute($stmt2);
        $result = mysqli_stmt_get_result($stmt2);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $role = strtolower($row['role']);

    
            if ($role == "admin") {
                $sql = "DELETE FROM `leaves` WHERE `leaves`.`s_no` = ?";

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $s_no);

                if (mysqli_stmt_execute($stmt)) {
                    $response['status'] = "success";
                    $response['message'] = "Leave Deleted successfully!";
                } else {
                    $response['status'] = "ERROR";
                    $response['message'] = "Unable to delete leave!";
                }

                mysqli_stmt_close($stmt);
            } elseif ($role == "teacher") {
                $sql = "DELETE FROM `leaves` WHERE `leaves`.`s_no` = ? AND `leaves`.`sender_id`= ?;";

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "is", $s_no, $uid);

                if (mysqli_stmt_execute($stmt)) {
                    $response['status'] = "success";
                    $response['message'] = "Leave Deleted successfully!";
                } else {
                    $response['status'] = "ERROR";
                    $response['message'] = "Unable to delete leave!";
                }

                mysqli_stmt_close($stmt);
            } else {
                $response['status'] = "ERROR";
                $response['message'] = "You have no rights to delete this Leave!";
            }
        } else {
            $response['status'] = "ERROR";
            $response['message'] = "Leave not found!";
        }
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Unable to delete leave!";
    }
} else {
    $response['status'] = "ERROR";
    $response['message'] = "Invalid request!";
}

echo json_encode($response);
