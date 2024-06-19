<?php

include("config.php");
session_start();
$response = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uid = $_SESSION['uid'];

    $jsonData = file_get_contents('php://input');
    $decodedData = json_decode($jsonData, true);

    if (isset($decodedData["dayOfWeak"])) {

        $dayOfWeak = (int) ($decodedData['dayOfWeak']);
        $class = $decodedData['class'];
        $section = $decodedData['section'];

        $arrayOfDays = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');

        $query = "SELECT * FROM `time_table` WHERE `class`=? AND `section`=?;";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $class, $section);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if (mysqli_num_rows($result) > 0) {
            $response['status'] = "success";
            $response['table1Message'] = "";
            $response['table2Message'] = "";
            $response['day'] = "working_day";
            
            $editorId = "";
            $editingTime = "";
            
            $flag = 0;
            while ($row = mysqli_fetch_assoc($result)) {


                $timestamp = $row['timestamp'];
                $editingTime = date('d M, Y', strtotime($timestamp));
                

                $editorId = $row['editor_id'];
                if ($dayOfWeak < 7) {

                    if($flag < 5){
                        $response['table1Message'] .= '  <tr class="tableRow">
                   
                        <td class="tableData"> <input class="form-control tableInput srartTime_" type="text" value="' . $row['start_time'] . '" disabled></td>
                        <td class="tableData"><input class="form-control tableInput endTime_" type="text" value="' . $row['end_time'] . '" disabled></td>
                        <td class="tableData"> <input class="form-control tableInput subject_" type="text" value="' . $row[$arrayOfDays[$dayOfWeak - 1]] . '" disabled></td>
                    </tr>';
                    }else{
                        $response['table2Message'] .= '  <tr class="tableRow">
                   
                        <td class="tableData"> <input class="form-control tableInput srartTime_" type="text" value="' . $row['start_time'] . '" disabled></td>
                        <td class="tableData"><input class="form-control tableInput endTime_" type="text" value="' . $row['end_time'] . '" disabled></td>
                        <td class="tableData"> <input class="form-control tableInput subject_" type="text" value="' . $row[$arrayOfDays[$dayOfWeak - 1]] . '" disabled></td>
                    </tr>';
                    }
                   
                } else {
                    $response['day'] = "sunday";
                }


                $flag++;
            }

            $query = "SELECT CONCAT(`fname`, ' ', `lname`) AS full_name FROM `admins` WHERE `admins`.`id`=? UNION SELECT CONCAT(`fname`, ' ', `lname`) AS full_name FROM `teachers`  WHERE `teachers`.`id`=? ; ";

            $stmt2 = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt2, "ss", $editorId, $editorId);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            mysqli_stmt_close($stmt2);
            $EdiorFullName = "";
            if (mysqli_num_rows($result2) > 0) {
                $row2 = mysqli_fetch_assoc($result2);
                $EdiorFullName = ucfirst(strtolower($row2['full_name']));   
            } else {
                $EdiorFullName = "REMOVED";
            }

            if($editorId == $uid){
                $EdiorFullName = "You";
            }

            $response['editorName'] = $EdiorFullName;
            $response['editingTime'] = $editingTime;
        } else {


            for($i = 0 ; $i < 8; $i++){
                $query3 = "INSERT INTO `time_table` (`s_no`, `class`, `section`, `start_time`, `end_time`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `editor_id`, `timestamp`) VALUES (NULL, ?, ?, '', '', '', '', '', '', '', '', ?, current_timestamp());";

                $stmt3 = mysqli_prepare($conn, $query3);
                mysqli_stmt_bind_param($stmt3, "sss", $class, $section, $uid);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_close($stmt3);
            }
           

            $response['status'] = "creating";
            $response['class'] = $class;
            $response['section'] = $section;
        
        }




    } else {
        $response['status'] = "Error";
        $response['message'] = "Something went wrong!";
    }
} else {
    $response['status'] = "Error";
    $response['message'] = "Something went wrong!";
}
echo json_encode($response);

?>