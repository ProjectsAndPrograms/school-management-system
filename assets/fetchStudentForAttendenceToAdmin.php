<?php
include("config.php");
session_start();
error_reporting(1);

$response = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $jsonData = file_get_contents('php://input');
    $decodedData = json_decode($jsonData, true);

    $class = $decodedData['class'];
    $section = $decodedData['section'];

    $currentDay = date('d') . "";
    $currentMonth = date('m') . "";
    $currentYear = date('Y') . "";

    $query = "SELECT * FROM `attendence` WHERE (`class`=? AND `section`=?) AND (Day(`date`)=? AND Month(`date`)=? AND Year(`date`)=?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $class, $section, $currentDay, $currentMonth, $currentYear);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $response[0] = "ALREADY_TAKEN";
        $response[1] = "Already Taken";
    } else {
        $response[0] = "READY_TO_TAKE";

        $query = "SELECT * FROM `students` WHERE `class`=? AND `section`=? ORDER BY `fname` ASC, `lname` ASC;";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $class, $section);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $count = 1;

            $response[1] = "";
            while ($row = mysqli_fetch_assoc($result)) {

                $pathToFile = ".." . DIRECTORY_SEPARATOR . "studentUploads" . DIRECTORY_SEPARATOR . $row['image'];

                if (!file_exists($pathToFile)) {
                    $pathToFile = "../images/user.png";
                }


            $currentYear = date("Y");
            $currentMonth = date('m');

            $startDate = "";
            $endDate = "";
            if($currentMonth <= 3){
                $startDate = ($currentYear - 1) . "-04-01";
                $endDate = $currentYear . "-03-31";
            }else{
                $startDate = $currentYear . "-04-01";
                $endDate = ($currentYear + 1) . "-03-31";
            }

                
                $presentquery = "SELECT COUNT(*) 
                                 FROM `attendence` 
                                 WHERE `student_id` = ? 
                                 AND `attendence` = ? 
                                 AND `date` BETWEEN ? AND ?";
                $stmt2 = mysqli_prepare($conn, $presentquery);
                $temp = "1";
                mysqli_stmt_bind_param($stmt2, "ssss", $row['id'], $temp, $startDate, $endDate);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $presentCount);
                mysqli_stmt_fetch($stmt2);
                mysqli_stmt_close($stmt2);
                
                $workingDaysQuery = "SELECT COUNT(DISTINCT DATE_FORMAT(`date`, '%Y-%m-%d')) 
                                     FROM `attendence`
                                     WHERE `date` BETWEEN ? AND ?";
                $stmt3 = mysqli_prepare($conn, $workingDaysQuery);
                mysqli_stmt_bind_param($stmt3, "ss", $startDate, $endDate);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $workingDays);
                mysqli_stmt_fetch($stmt3);
                mysqli_stmt_close($stmt3);


                $present = (int) $presentCount;
                $percent = 0;
                if ($workingDays != 0) {
                    $percent = (int) (($present / $workingDays) * 100);
                }
                // $percent = (int)(($presentCount/$total)*100);


                $response[1] .= '<tr>
                                    <td>' . $count . '.&nbsp;&nbsp;</td>
                                    <td class="student_id">' . $row['id'] . '</td>
                                    <td class="user">
                                        <img src="' . $pathToFile . '">
                                        <p>' . ucfirst(strtolower($row['fname'])) . " " . strtolower($row['lname']) . '</p>
                                    </td>
                                    <td class="text-center"> ' . $workingDays . '</td>
                                <td class="text-center"> ' . $present . '</td>
                                '.$attendence_str.'
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="attendenceCheckbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>';
                $count++;


            }
        } else {
            $response[1] = "No Data";
        }


    }






} else {
    $response[0] = "Something went wrong!";
}
echo json_encode($response);

?>