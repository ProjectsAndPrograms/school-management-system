<?php

include("config.php");
session_start();
$response = array();
$arrayOfDays = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat');

$jsonData = file_get_contents("php://input");
$dataArray = json_decode($jsonData, true);
$class = $dataArray['class'];
$section = $dataArray['section'];
$dayOfWeek = (int)$dataArray['dayOfWeak'];
$uid = $_SESSION['uid']; 

if ($dataArray !== null) {
    $receivedData = $dataArray['data'];

    $response['status'] = 'success';
    $response['message'] = $receivedData[0]['startTime'];

    $query = 'SELECT `s_no` FROM `time_table` WHERE `class`=? AND `section`=?;';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $class, $section);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        $count = 0;
        $response['status'] = '';
        while ($row = mysqli_fetch_assoc($result)) {
            if ($dayOfWeek < 7) {
                $sql = 'UPDATE `time_table` SET `start_time` = ?, `end_time` = ?, '.$arrayOfDays[$dayOfWeek - 1].' = ?, `editor_id` = ?, `timestamp` = CURRENT_TIMESTAMP() WHERE `time_table`.`s_no` = ?;';
                $stmt2 = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt2, "ssssi", $receivedData[$count]['startTime'], $receivedData[$count]['endTime'], $receivedData[$count]['subject'], $uid, $row['s_no']);
                
                if (mysqli_stmt_execute($stmt2)) {
                    $response['status'] = 'success : ' ;
                } else {
                    $response['status'] = 'error';
                    break;
                }

                mysqli_stmt_close($stmt2);
                $count++;
            } else {
                $response['status'] = 'sunday error';
                $response['message'] = 'Something went wrong!';
            }
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Something went wrong!';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Something went wrong!';
}

echo json_encode($response);

?>
