<?php
include('config.php');
$response = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $jsonData = file_get_contents('php://input');
    $decodedData = json_decode($jsonData, true);


    foreach ($decodedData as $key => $value) {
      
        $class = $value['class'];
        $section = $value['section'];
        $attendence = $value['attendence'];

        $query = "INSERT INTO `attendence` (`s_no`, `student_id`, `attendence`, `class`, `section`, `date`) VALUES (NULL, ?, ?, ?, ?, current_timestamp());";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $key, $attendence, $class, $section);

        if(mysqli_stmt_execute($stmt)){
            $response = "success";
        }else{
            $response = "Something went wrong while saving!!";
        }


    }


} else {
    $response = "Something went wrong!";
}
echo $response;
?>