<?php
session_start();
include('config.php');
$response = array();
$selected = true;
if (isset($_SESSION['uid']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $fetchBusQuery = "SELECT * FROM `buses` ORDER BY `s_no` ASC";
    $stmt = mysqli_prepare($conn, $fetchBusQuery);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $response['status'] = "success";
        $response['buses'] = "";

        while ($busData = mysqli_fetch_assoc($result)) {

            $busID = filter_var($busData['bus_id'], FILTER_SANITIZE_SPECIAL_CHARS);
            $busTitle = filter_var($busData['bus_title'], FILTER_SANITIZE_SPECIAL_CHARS);

            if($selected){
                $response['buses'] .= '<option value="'. $busID .'" selected>'. $busTitle .'</option>';
                $selected = false;
            }else{
                $response['buses'] .= '<option value="'. $busID .'">'. $busTitle .'</option>';
            }
        
        }
    }else{
        $response['status'] = "ERROR";
        $response['message'] = 'Data not available!';
    }
    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'ERROR';
    $response['message'] = 'Invalid Request!';
}
echo json_encode($response);
