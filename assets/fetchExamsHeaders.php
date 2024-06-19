<?php
session_start();
include('config.php');
$response = array();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    if (isset($data['class'], $data['section'], $data['session'])) {
        $class = $data['class'];
        $section = $data['section'];
        $sessionYear = (int)$data['session'];

        if (empty($class) || empty($section) || $sessionYear <= 0) {
            $response["status"] = "error";
            $response["message"] = "Invalid input values";
            echo json_encode($response);
            exit();
        }

        $sql = "SELECT * FROM `exams` WHERE `class` = ? AND `section` = ? 
                AND `timestamp` >= ? AND `timestamp` < ? ORDER BY `s_no` DESC LIMIT 15";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            $startDate = $sessionYear . "-04-01 00:00:00";
            $endDate = ($sessionYear + 1) . "-03-31 00:00:00";
            mysqli_stmt_bind_param($stmt, "ssss", $class, $section, $startDate, $endDate);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $response["status"] = "success";
                $response["message"] = "Data retrieved successfully";
                $response['data'] = "";

                while ($row = mysqli_fetch_array($result)) {
                    $title = $row['exam_title'];
                    $databaseDate = $row['timestamp'];
                    $formattedDate = date("d/m/Y", strtotime($databaseDate));
                    $shortTitle = strlen($title) > 30 ? substr($title, 0, 25) . "..." : $title;

                    $viewBtns = "";
                    if ($row['subject'] == "ALL") {
                        $sql2 = "SELECT * FROM `subjects` WHERE `class` = ? ORDER BY `subject_name` ASC";
                        $stmt2 = mysqli_prepare($conn, $sql2);

                        if ($stmt2) {
                            mysqli_stmt_bind_param($stmt2, "s", $class);
                            mysqli_stmt_execute($stmt2);
                            $result2 = mysqli_stmt_get_result($stmt2);

                            while ($subRow = mysqli_fetch_assoc($result2)) {
                                $viewBtns .= '<div class="col-6 col-md-3 mb-2"><a class="btn btn-warning view-result-btn" onclick="showResultDialog(`'.$row['exam_id'].'`, `'. $subRow['subject_name'] .'`)" aria-controls="markSheerOffcanvas">
                                                <span> '. $subRow['subject_name'] .' </span>
                                            </a></div>';
                            }
                            mysqli_stmt_close($stmt2);
                        }
                    } else {
                        $viewBtns .= '
                            <div class="col-6 col-md-3 mb-2">
                            <a class="btn btn-warning view-result-btn" onclick="showResultDialog(`'.$row['exam_id'].'`, `'. $row['subject'] .'`)" aria-controls="markSheerOffcanvas">
                                       <span> '. $row['subject'] .' </span>
                                      </a>
                            </div>
                        ';
                    }

                    $response['data'] .= '<div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-'.$row['exam_id'].'" aria-expanded="false" aria-controls="flush-collapseOne" data-bs-parent="#Exam-Titles">
                                                    <b> '. ucfirst(strtolower($title)) .' </b> &nbsp; <small>(Data - '.$formattedDate.')</small>
                                                </button>
                                            </h2>
                                            <div id="flush-'.$row['exam_id'].'" class="accordion-collapse collapse" data-bs-parent="#Exam-Titles">
                                                <div class="accordion-body">
                                                    <div class="mx-2 mt-3">
                                                        <small> Consolidated Subject-Wise Results Overview - </small>
                                                        <div class="row">
                                                            '. $viewBtns .'
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>';
                }
            } else {
                $response["status"] = "error";
                $response["message"] = "No data found for the given criteria";
            }

            mysqli_stmt_close($stmt);
        } else {
            $response["status"] = "error";
            $response["message"] = "Database query error";
        }
    } else {
        $response["status"] = "error";
        $response["message"] = "Required fields are missing";
    }
} else {
    $response["status"] = "error";
    $response["message"] = "Invalid request method";
}

echo json_encode($response);
?>
