<?php
 include("../../assets/config.php");
session_start();
$response = array();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

   $id=$data['id'];
   $month = date('m');         


        $presentquery = "SELECT COUNT(*) FROM `attendence` WHERE `student_id` = ? AND `attendence` = ?";
        $stmt2 = mysqli_prepare($conn, $presentquery);
        $temp = "1";
        mysqli_stmt_bind_param($stmt2, "ss", $id, $temp);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2, $presentCount);
        mysqli_stmt_fetch($stmt2);
        mysqli_stmt_close($stmt2);


        $workingDaysQuery = "SELECT COUNT(DISTINCT DATE_FORMAT(`date`, '%Y-%m-%d')) FROM `attendence`;";
        $stmt3 = mysqli_prepare($conn, $workingDaysQuery);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $workingDays);
        mysqli_stmt_fetch($stmt3);
        mysqli_stmt_close($stmt3);

           
        $present = (int) $presentCount;
        $percentPresent = 0;
        if ($workingDays != 0) {
            $percentPresent = (float) (($present / $workingDays) * 100);
        }

        $absentPresent = 100 - $percentPresent ;


        $response['status'] = "success";
        $response['present'] = $percentPresent;
        $response['absent'] =  $absentPresent;
    
    
}else{
    $response['status'] = "Error";
    $response['message'] = "Something went wrong!";

}

echo json_encode($response);
?>
