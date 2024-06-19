<?php
include("config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (isset($data["section"]) && isset($data["class"])) {

        $query = "SELECT * FROM `students` WHERE `class`=? AND `section`=? ORDER BY `fname` ASC , `lname` ASC";

        $class = $data["class"];
        $section = $data["section"];
        $totalMarks = $data['totalMarks'];

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $class, $section);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);




        if (mysqli_num_rows($result) > 0) {
            $response["status"] = "DATA";
            $count = 1;
            $response["body"] = "";

            $response["head"] = '<th scope="col" class="thead">#</th>
            <th scope="col" class="thead">Roll no</th>
            <th scope="col" class="thead">Name</th>
            <th scope="col" class="thead">Total Marks</th>
           ';


            $subjects = array();
            if ($data['subject'] == "ALL") {

                $query2 = "SELECT `subject_name` FROM `subjects` WHERE `class`=?";
                $stmt2 = mysqli_prepare($conn, $query2);


                mysqli_stmt_bind_param($stmt2, "s", $class);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);

                if ($result2 && mysqli_num_rows($result2) > 0) {
                    if (!isset($response["head"])) {
                        $response["head"] = '';
                    }
                    $i = 0;
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $response["head"] .= '<th scope="col" class="thead">&nbsp;' . htmlspecialchars($row2['subject_name'], ENT_QUOTES, 'UTF-8') . '&nbsp;</th>';
                        $subjects[$i] = htmlspecialchars($row2['subject_name'], ENT_QUOTES, 'UTF-8');
                        $i++;
                    }
                }

                mysqli_stmt_close($stmt2);
            } else {
                $response["head"] .= ' <th scope="col" class="thead ">&nbsp;' . $data['subject'] . '&nbsp;</th>';
                $subjects[0] = $data['subject'];
            }

            while ($row = mysqli_fetch_assoc($result)) {

                $pathToFile = ".." . DIRECTORY_SEPARATOR . "studentUploads" . DIRECTORY_SEPARATOR . $row['image'];

                if (!file_exists($pathToFile)) {
                    $pathToFile = "../images/user.png";
                }

                $subjectiveMarksInput = "";
                for ($i = 0; $i < sizeof($subjects); $i++) {
                    $subjectiveMarksInput .= '<td class="flex-center marks-input-container">
                                                <input type="hidden" value="' . $subjects[$i] . '" id="subject-name" class="subject-name">
                                                 <input type="number" class="form-control marks-input" >
                                                <div class="invalid-feedback invalidMarks">
                                                    Invalid marks!
                                                </div>
                                                  </td>';
                }


                $response["body"] .= '<tr>
            <td>' . $count . '.&nbsp;&nbsp;</td>
            <td class="student_id">' . $row['id'] . '</td>
            <td class="user">
                <img src="' . $pathToFile . '">
                <p>' . ucfirst(strtolower($row['fname'])) . " " . strtolower($row['lname']) . '</p>
            </td>
            <td class="exam-total-marks">' . $totalMarks . '</td>
             '. $subjectiveMarksInput .'
        </tr>';

                $count++;
            }

            $response['class'] = $data["class"] . "";
            $response['section'] = $section;
        } else {
            $response["status"] = "NO_DATA";
        }
    } else {
        $response["status"] = "Invalid request";
    }
} else {
}
echo json_encode($response);
