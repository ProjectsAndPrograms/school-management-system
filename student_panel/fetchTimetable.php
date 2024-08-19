<?php
include('../assets/config.php');
$response = array();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['uid'];
    $sql = "SELECT `class`,`section` FROM `students` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();

    $class = $row['class'];
    $section = $row['section'];

    $query = "SELECT * FROM `time_table` WHERE `class`='$class' AND `section`='$section'";
    $result2 = mysqli_query($conn, $query);

    $daysOfWeek = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat');
    $response['status'] = "success";
    $timetable = array();

    while ($row2 = $result2->fetch_assoc()) {
        foreach ($daysOfWeek as $day) {
            $timetable[$day][] = array(
                "start_time" => $row2['start_time'],
                "subject" => $row2[$day],
                "end_time"=> $row2['end_time']
                
            );
        }
    }

    $response['data'] = $timetable;
} else {
    $response['status'] = "error";
}

echo json_encode($response);
?>
