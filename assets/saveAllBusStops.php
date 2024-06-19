<?php
include("config.php");
session_start();

$response = array();
$response['status'] = "";
$response['message'] = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['uid'])) {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (isset($data["busId"], $data['rootsObjArray'])) {

        $busId = $data['busId'];

        $deletePrevious = "DELETE FROM `bus_root` WHERE `bus_id` = ?";
        $stmt = mysqli_prepare($conn, $deletePrevious);
        mysqli_stmt_bind_param($stmt, "s", $busId);

        if (mysqli_stmt_execute($stmt)) {
            $deletedRows = mysqli_stmt_affected_rows($stmt);

            if ($deletedRows > 0) {

                $insertQuery = "INSERT INTO `bus_root` (`s_no`, `bus_id`, `location`, `arrival_time`, `serial`) VALUES (NULL, ?, ?, ?, ?);";

                for ($i = 0; $i < sizeof($data['rootsObjArray']); $i++) {
                    $location = $data['rootsObjArray'][$i]['location'];
                    $arrival_time = $data['rootsObjArray'][$i]['arrival'];
                    $serial = ($i + 1);

                    $stmt2 = mysqli_prepare($conn, $insertQuery);
                    mysqli_stmt_bind_param($stmt2, "sssi", $busId, $location, $arrival_time, $serial);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_close($stmt2);
                }
                $response['status'] = 'success';
                $response['message'] = "Changes saved successfully!";
            } else {
                $response['status'] = 'ERROR';
                $response['message'] = "Unable to update bus root!";
            }
        } else {
            $response['status'] = "ERROR";
            $response['message'] = "Unable to update bus root!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Invalid request";
    }
} else {
    $response['status'] = "ERROR";
    $response['message'] = "Invalid request";
}

echo json_encode($response);
