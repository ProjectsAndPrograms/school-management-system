<?php
include("config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (
        isset($data['title']) &&
        isset($data['class']) &&
        isset($data['total']) &&
        isset($data['passing']) &&
        isset($data['subject']) &&
        isset($data['section'])
    ) {
        $query = "INSERT INTO `exams` (`s_no`, `exam_id`, `exam_title`, `subject`, `class`, `section`, `total_marks`, `passing_marks`, `timestamp`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP());";

        $examId = "E" . time() . uniqid();

        $stmt = mysqli_prepare($conn, $query);

        $title = $data['title'] . "";
        $subject = $data['subject'] . "";
        $class = $data['class'] . "";
        $section = $data['section'] . "";
        $total = $data['total'] . "";
        $passing = $data['passing'] . "";

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssss", $examId, $title, $subject, $class,$section,  $total, $passing);

            if (mysqli_stmt_execute($stmt)) {
                $response['status'] = 'success';
                $response['examId'] = $examId;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Unable to create exam title.';
            }

            mysqli_stmt_close($stmt);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to prepare the statement.';
        }

    } else {
        $response['status']  = 'error';
        $response['message'] = 'Missing required parameters.';
    }

} else {
    $response['status']   = 'error';
    $response['message']  = 'Invalid request method.';
}

echo json_encode($response);
?>