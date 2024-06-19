<?php
session_start();
include('config.php');
$response = array();
if (isset($_POST['exam_id'])) {
    $examId = $_POST['exam_id'];
    $studentId = $_SESSION['uid'];


    $tableHeader = '';

    // Prepare and execute the first SQL query
    $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $examId, $studentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Prepare and execute the second SQL query
    $sql2 = "SELECT * FROM `exams` WHERE `exam_id` = ? LIMIT 1";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "s", $examId);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);


    $body = "";
    
    if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result2) > 0) {
        $examRow = mysqli_fetch_assoc($result2);
        $dateDB = $examRow['timestamp'];
        $formattedDate = date("d-m-Y", strtotime($dateDB));

        $tableHeader = '
     <table style="padding: 10px;margin: 10px;">
                <tr>
                    <th>'. $examRow['exam_title'] . '</th>
                </tr>
            </table>
            
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Obtain Marks</th>
                <th>Total Marks</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody id="geeks">';


        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $mark = $row['marks'];
            $status = ((int)$mark >= (int)$examRow['passing_marks']) ? 
                "<td style='color:green;text-align:center;'>Pass</td>" : 
                "<td style='color:red;text-align:center;'>Fail</td>";

            $body .= "<tr>
                <td> <strong>".$counter."</strong></td>
                <td>" . $row["subject"] . "</td>
                <td style='text-align:center;'>" . $mark . "</td>
                <td style='text-align:center;'>" . $examRow["total_marks"] . "</td>
                " . $status . "
            </tr>";
            $counter++;
        }


        $tableFooter = "</tbody></table>";
        $response['data'] = $tableHeader . $body . $tableFooter;

        $response['status'] = "success";
    } else {
        $response['data'] = "";
        $response['status'] = "error";
        $response['message'] = "Something went wrong!!";
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response['status'] = "error";
    $response['message'] = "exam_id not set!";
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
