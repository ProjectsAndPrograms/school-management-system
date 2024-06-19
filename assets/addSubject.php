<?php
include("config.php");

$response = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (isset($data["subject"]) && isset($data["class"])) {
        $class = $data["class"];
        $subject = $data["subject"];

        $subjectId = $class . uniqid();

        // Use prepared statement to check if the subject already exists
        $query = "SELECT * FROM subjects WHERE class=? AND subject_name=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $class, $subject);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $response = "This subject already exists!";
        } else {
            // Use prepared statement to insert the new subject
            $sql = "INSERT INTO `subjects` (`s_no`, `subject_id`, `subject_name`, `class`) VALUES (NULL, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $subjectId, $subject, $class);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $response = "success";
            } else {
                $response = "Unable to add a new subject!";
            }
        }
    } else {
        $response = "Invalid request";
    }

    echo $response;
}
?>
