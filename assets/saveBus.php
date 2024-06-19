<?php
session_start();
include('config.php');
$response = array();
$driverRole = "driver";
$helperRole = "helper";

if (isset($_SESSION['uid']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset(
        $_POST['bus-title'],
        $_POST['bus-number'],
        $_POST['driver-name'],
        $_POST['driver-contact'],
        $_POST['helper-name'],
        $_POST['helper-contact'],
    )) {

        $busTitle = $_POST['bus-title'] . '';
        $busNumber = strtoupper($_POST['bus-number'] . "");
        $driverName = $_POST['driver-name'] . '';
        $driverContact = $_POST['driver-contact'] . '';
        $helperName = $_POST['helper-name'] . '';
        $helperContact = $_POST['helper-contact']. '';

        mysqli_begin_transaction($conn);

        $saveBusQuery = "";
        if (isset($_POST['bus_id'])) {
            $saveBusQuery = "UPDATE `buses` SET `bus_title` = ?, `bus_number` = ? WHERE `buses`.`bus_id` = ?;";

            $busID =  $_POST['bus_id'];
          
            $saveBusStmt = mysqli_prepare($conn, $saveBusQuery);
            mysqli_stmt_bind_param($saveBusStmt, "sss", $busTitle, $busNumber, $busID);

            $updateStaffQuery = "UPDATE `bus_staff` SET `name` = ?, `contact` = ? WHERE `bus_id` = ? AND `role` = ?";

            $updateDriverStmt = mysqli_prepare($conn, $updateStaffQuery);
            mysqli_stmt_bind_param($updateDriverStmt, "ssss", $driverName, $driverContact,$busID , $driverRole);

            $updateHelperStmt = mysqli_prepare($conn, $updateStaffQuery);
            mysqli_stmt_bind_param($updateHelperStmt, "ssss", $helperName, $helperContact,$busID , $helperRole);

            if (
                mysqli_stmt_execute($saveBusStmt)
                && mysqli_stmt_execute($updateDriverStmt)
                && mysqli_stmt_execute($updateHelperStmt)
            ) {
                $response['status'] = "success";
                mysqli_commit($conn);
                $response['message'] = "Updated successfully!";
            } else {
                mysqli_rollback($conn);
                $response['status'] = "ERROR";
                $response['message'] = "Something went wrong while updating!";
            }

        } else {
            $saveBusQuery = "INSERT INTO `buses` (`s_no`, `bus_id`, `bus_title`, `bus_number`) VALUES (NULL, ?, ?, ?);";

            $busID = time() . "";
            $saveBusStmt = mysqli_prepare($conn, $saveBusQuery);
            mysqli_stmt_bind_param($saveBusStmt, "sss", $busID, $busTitle, $busNumber);

            $saveStaffQuery = "INSERT INTO `bus_staff` (`s_no`, `id`, `bus_id`, `name`, `contact`, `role`) VALUES (NULL, ?, ?, ?, ?, ?);";

            $newDriverId = "B" . time();
            $saveDriverStmt = mysqli_prepare($conn, $saveStaffQuery);
            mysqli_stmt_bind_param($saveDriverStmt, "sssss", $newDriverId, $busID, $driverName, $driverContact, $driverRole);


            $newHelperId = "B" . time();
            $saveHelperStmt = mysqli_prepare($conn, $saveStaffQuery);
            mysqli_stmt_bind_param($saveHelperStmt, "sssss", $newHelperId, $busID, $helperName, $helperContact, $helperRole);

            $createEmptyRootQuery = "INSERT INTO `bus_root` (`s_no`, `bus_id`, `location`, `arrival_time`, `serial`) VALUES (NULL, ?,'SCHOOL', '10:00 AM', '1');";

            $saveRootStmt = mysqli_prepare($conn, $createEmptyRootQuery);
            mysqli_stmt_bind_param($saveRootStmt, "s",$busID);

            if (
                mysqli_stmt_execute($saveBusStmt)
                && mysqli_stmt_execute($saveDriverStmt)
                && mysqli_stmt_execute($saveHelperStmt)
                && mysqli_stmt_execute($saveRootStmt)
            ) {
                mysqli_commit($conn);
                $response['status'] = "success";
                $response['message'] = "Created successfully!";
            } else {
                mysqli_rollback($conn);
                $response['status'] = "ERROR";
                $response['message'] = "Something went wrong while creating!";
            }
        }
    }else{
        $response['status'] = 'ERROR';
        $response['message'] = 'Something went wrong!';
    }
}else{
    $response['status'] = 'ERROR';
    $response['message'] = 'Invalid Request!';
}
echo json_encode($response);
