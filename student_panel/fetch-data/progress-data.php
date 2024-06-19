<?php
error_reporting(0);
include('../../assets/config.php');

$data = file_get_contents("php://input");
$input = json_decode($data,true);
$id = $input['id'] . "";
$output = array();

$stmt = $conn->prepare("SELECT * FROM `marks` WHERE `student_id`=? ORDER BY `s_no` DESC LIMIT 10");
$stmt->bind_param("s", $id); 
$stmt->execute();
$result2 = $stmt->get_result();


if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $examId = $row2['exam_id'];
        $mark = $row2['marks'];

        $query3 = "SELECT * FROM `exams` WHERE `exam_id`='$examId'";
        $result3 = $conn->query($query3);
        $row3 = $result3->fetch_assoc();

        // Formatting date
        $dateDB = $row3['timestamp'];
        $formattedDate = date("d-m-Y", strtotime($dateDB));

        // Determining status
        $status = "";
        if ((int)$mark >= (int)$row3['passing_marks']) {
            $status = "Pass";
        } else {
            $status = "Fail";
        }

        // Building the output array
        $output[] = array(
            's_id' => $id,
            'exam_id' => $row3['exam_id'],
            'exam_name' => $row3['exam_title'], 
            'date' => $formattedDate,
            'marks' => $mark,
            'status' => $status
        );
    }

    $output[] = array(
        'error'=>'failed' . $result3->num_rows
       );
}
else{
    $output[] = array(
     'error'=>'failed'
    );
}

echo json_encode($output);
?>
