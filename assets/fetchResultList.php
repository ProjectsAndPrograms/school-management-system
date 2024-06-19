<?php

include("config.php");
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["examId"])) {
        $examId = $_POST["examId"] . "";
        $subject = $_POST["subject"] . "";

        // Fetch exam details
        $query = 'SELECT * FROM `exams` WHERE `exam_id`=? LIMIT 1';
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $examId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $totalMarks = $row['total_marks'];
            $passingMarks = $row['passing_marks'];

            // Fetch students' marks for the exam
            $query2 = 'SELECT `student_id`,`marks` FROM `marks` WHERE `exam_id` = ? AND `subject` = ?';
            $stmt2 = mysqli_prepare($conn, $query2);
            mysqli_stmt_bind_param($stmt2, "ss", $examId, $subject);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);

            if (mysqli_num_rows($result2) > 0) {
                $studentsData = array(); // Array to hold student details

                $count = 1;
                $response['data'] = "";
                while ($marksRow = mysqli_fetch_assoc($result2)) {
                    $studentId = $marksRow['student_id'];
                    $obtainedMarks = $marksRow['marks'];

                    // Fetch student details
                    $query3 = 'SELECT `fname`, `lname` FROM `students` WHERE `id` = ?';
                    $stmt3 = mysqli_prepare($conn, $query3);
                    mysqli_stmt_bind_param($stmt3, "s", $studentId);
                    mysqli_stmt_execute($stmt3);
                    $result3 = mysqli_stmt_get_result($stmt3);

                    if (mysqli_num_rows($result3) > 0) {
                        $row3 = mysqli_fetch_assoc($result3);


                        $passFail = ((int)($obtainedMarks)) >= ((int)($passingMarks)) ? "style='color:green;'": "style='color:red;'";

                        $Name = $row3['fname'] . " " . $row3['lname'];
                        $response['status'] = "success";
                        $response['data'] .= '<tr>
                        <th scope="row">'.$count.'</th>
                        <td>'.$studentId.'</td>
                        <td>
                            <p>'. ucfirst(strtolower($Name)).'</p>
                        </td>

                        <td '.$passFail.'>'.$obtainedMarks.' / '.$totalMarks.'</td>
                    </tr>';

                      mysqli_stmt_close($stmt3);
                    } else {
                        continue;
                    }
                  
                    $count++;
                }
                

            } else {
                $response['status'] = "error";
                $response['message'] = "No student data found for this exam!";
            }
            mysqli_stmt_close($stmt2);
        } else {
            $response['status'] = "error";
            $response['message'] = "No exam found with provided ID! ";
        }
        mysqli_stmt_close($stmt);
    } else {
        $response['status'] = "error";
        $response['message'] = "Exam ID not provided!";
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Invalid request method!";
}

echo json_encode($response);

?>