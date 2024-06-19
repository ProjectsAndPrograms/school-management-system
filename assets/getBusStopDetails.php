<?php
session_start();
include('config.php');
$response = array();

if (isset($_SESSION['uid']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $busID = filter_var($_POST['busId'], FILTER_SANITIZE_SPECIAL_CHARS);
    $serial = (int) filter_var($_POST['serial'], FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "SELECT * FROM `bus_root` WHERE `bus_id` = ? AND `serial` = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $busID, $serial);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $response['status'] = "success";
        $response['location'] = $row['location'];
        $response['arrival_time'] = $row['arrival_time'];

    } else {
        $response['status'] = "ERROR";
        $response['message'] = 'Data not available!';
    }
    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'ERROR';
    $response['message'] = 'Invalid Request!';
}
echo json_encode($response);
