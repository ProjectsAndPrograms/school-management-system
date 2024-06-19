<?php
include('config.php');
$response = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $jsonData = file_get_contents('php://input');
    $decodedData = json_decode($jsonData, true);


    foreach ($decodedData as $studentId => $value) {
      
        $examId = $value['examId'];
        $marks = $value['marks'];

        // I WANT TO DO MY LOGIC HERE

        foreach ($marks as $subject => $mark) {
        
            $response = $studentId . " : ". $examId  . " : " . $subject . " : " . $mark;

            $query = "INSERT INTO `marks` (`s_no`, `exam_id`, `subject`,  `student_id`, `marks`) VALUES (NULL, ?, ?, ?, ?);";

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $examId, $subject, $studentId, $mark);

            if(mysqli_stmt_execute($stmt)){
                $response = "success";
            }else{
                $response = "Something went wrong while saving!!";
                break;
            }

        }
    }


} else {
    $response = "Something went wrong!";
}
echo $response;
?>