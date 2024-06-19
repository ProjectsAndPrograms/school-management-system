<?php

include('config.php');
session_start();
$response = array();

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    $sql = 'SELECT * FROM `notice` ORDER BY `s_no` DESC LIMIT 5';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $response['status'] = "success";
        $response["message"] = ""; 

        while ($row = mysqli_fetch_assoc($result)) {

            $noticeTitle = $row['title'];
            $title = strlen($noticeTitle) > 30 ? substr($noticeTitle, 0, 25) . "..." : $noticeTitle;

            $timestamp = $row['timestamp'];
            $formattedTime = date('d M, Y', strtotime($timestamp));

            $importance = $row['importance'];
            $image = '<img src="../images/green.png">';
            if ($importance == "2") {
                $image = '<img src="../images/yellow.png">';
            } else if ($importance == "3") {
                $image = '<img src="../images/red.png">';
            }

            $editorId = $row['editor_id'];

            $query = "SELECT CONCAT(`fname`, ' ', `lname`) AS full_name FROM `admins` WHERE `admins`.`id`=? UNION SELECT CONCAT(`fname`, ' ', `lname`) AS full_name FROM `teachers`  WHERE `teachers`.`id`=? ; ";

            $stmt2 = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt2, "ss", $editorId, $editorId);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);

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

            $response["message"] .= '<tr>
            <td class="user">
               ' . $image . '
                <p>' . $title . '</p>
            </td>
            <td>' . $formattedTime . '</td>
            <td><span>' . $EdiorFullName . '</span></td>
        </tr>';

        }
    } else {
        $response['status'] = "success";
        $response["message"] = '<td class="text-center" colspan="3">No Notices</td>';
    }
    mysqli_stmt_close($stmt);
} else {
    $response['status'] = "Error";
    $response["message"] = "User not found.";
}

echo json_encode($response);
?>
