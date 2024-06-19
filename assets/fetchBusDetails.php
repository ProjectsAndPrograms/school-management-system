<?php
session_start();
include('config.php');
$response = array();

if (isset($_SESSION['uid']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $busID = $_POST['busId'] . '';

    $fetchBusQuery = "SELECT * FROM `buses` WHERE `bus_id` = ?;";
    $stmt = mysqli_prepare($conn, $fetchBusQuery);
    mysqli_stmt_bind_param($stmt, "s", $busID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($busData = mysqli_fetch_assoc($result)) {

            $busTitle = $busData['bus_title'];
            $busNumber = $busData['bus_number'];

            $fetchStaffQuery = "SELECT * FROM `bus_staff` WHERE `bus_id` = ? LIMIT 2;";
            $fetchStaffStmt = mysqli_prepare($conn, $fetchStaffQuery);
            mysqli_stmt_bind_param($fetchStaffStmt, "s", $busID);
            mysqli_stmt_execute($fetchStaffStmt);
            $staffResult = mysqli_stmt_get_result($fetchStaffStmt);

            if (mysqli_num_rows($staffResult) > 0) {

                $driverName = "";
                $driverContact = "";
                $helperName = "";
                $helperContact = "";
                while ($staffRow = mysqli_fetch_assoc($staffResult)) {
                    if ($staffRow['role'] == "driver") {
                        $driverName = ucfirst(strtolower($staffRow['name']));
                        $driverContact = $staffRow['contact'];
                    } elseif ($staffRow['role'] == "helper") {
                        $helperName = ucfirst(strtolower($staffRow['name']));
                        $helperContact = $staffRow['contact'];
                    }
                }

                if (isset($driverName, $driverContact, $helperName, $helperContact, $busTitle, $busNumber)) {
                    $response['status'] = "success";
                    $response['busTitle'] = $busTitle;
                    $response['busNumber'] = $busNumber;
                    $response['driverName'] = $driverName;
                    $response['driverContact'] = $driverContact;
                    $response['helperName'] = $helperName;
                    $response['helperContact'] = $helperContact;
                } else {
                    $response['status'] = "ERROR";
                    $response['message'] = 'Something went wrong!';
                }
            } else {
                $response['status'] = "ERROR";
                $response['message'] = 'Something went wrong! Staff not available!';
            }
            mysqli_stmt_close($fetchStaffStmt);
        }
    } else {
        $response['status'] = "ERROR";
        $response['message'] = 'No information available';
    }
    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'ERROR';
    $response['message'] = 'Invalid Request!';
}
echo json_encode($response);
