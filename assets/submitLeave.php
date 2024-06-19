<?php
session_start();
include("config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (isset(
        $_POST["leave-type"],
        $_POST["leave-desc"],
        $_POST["start-date"],
        $_POST["end-date"]
    )) {

        $user_id = $_SESSION['uid'] . "";
        $leaveType = $_POST["leave-type"] . "";
        $leaveDesc = $_POST["leave-desc"] . "";
        $startDate = DateTime::createFromFormat('Y-m-d', $_POST["start-date"]);
        $endDate = DateTime::createFromFormat('Y-m-d', $_POST["end-date"]);

        $startDateStr = $startDate->format('Y-m-d');
        $endDateStr = $endDate->format('Y-m-d');

        $todaysDate = date('Y-m-d');
        if ($todaysDate >= $startDateStr) {
            $response['status'] = "ERROR";
            $response['message'] = "Start date must be greater than today!";
        } else {

            if (isset($_POST['s_no'])) {

                $s_no = (int) $_POST['s_no'];

                $sql = "UPDATE `leaves` SET  `send_date` = current_timestamp() , `leave_type` = ?, `leave_desc` = ?, `start_date` = ?, `end_date` = ?  WHERE `leaves`.`s_no` = ? AND `sender_id` = ? AND `leaves`.`status`= ?;";

                $pending = "pending";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssssiss", $leaveType, $leaveDesc, $startDateStr, $endDateStr, $s_no, $user_id, $pending);

                    if (mysqli_stmt_execute($stmt)) {
                        $response["status"] = "updated";
                        $response["message"] = "Leave application updated successfully!";
                    } else {
                        $response['status'] = "ERROR";
                        $response['message'] = "Unable to update leave!";
                    }
                } else {
                    $response['status'] = "ERROR";
                    $response['message'] = "Unable to send leave!";
                }
            } else {

                $sql = "INSERT INTO `leaves` (`s_no`, `sender_id`, `send_date`, `leave_type`, `leave_desc`, `start_date`, `end_date`) VALUES (NULL, ?, current_timestamp(), ?, ?, ?, ?);";

                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssss", $user_id, $leaveType, $leaveDesc, $startDateStr, $endDateStr);

                    if (mysqli_stmt_execute($stmt)) {
                        $response["status"] = "success";
                        $response["message"] = "Leave application sended successfully!";
                    } else {
                        $response['status'] = "ERROR";
                        $response['message'] = "Unable to send leave!";
                    }
                } else {
                    $response['status'] = "ERROR";
                    $response['message'] = "Unable to send leave!";
                }
            }
        }
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Invalid request!";
    }

    echo json_encode($response);
}
