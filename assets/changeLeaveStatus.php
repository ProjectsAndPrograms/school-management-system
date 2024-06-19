<?php

include("config.php");
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['s_no'], $_POST['status'])) {
        $s_no = (int) $_POST['s_no'];
        $status = $_POST['status'];

        if ($status == "approved" || $status == "rejected") {

            $query = "UPDATE `leaves` SET `status` = ? WHERE `s_no` = ?";

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $status, $s_no);
            mysqli_stmt_execute($stmt);

            if (mysqli_affected_rows($conn) > 0) {
                $response['status'] = "success";
                $response['message'] = ucfirst(strtolower($status)) . " successfully!";
            } else {
                $response['status'] = "ERROR";
                $response['message'] = "Something went wrong!";
            }
            mysqli_stmt_close($stmt);
        } else {
            $response['status'] = "ERROR";
            $response['message'] = "Invalid status!";
        }
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Something went wrong!";
    }
} else {
    $response['status'] = "ERROR";
    $response['message'] = "Something went wrong!";
}

echo json_encode($response);
