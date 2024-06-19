<?php
session_start();
include("config.php");

$response = array();
$response['leave-count'] = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_SESSION['uid'], $_POST['cursorPoint'])) {
        $uid = $_SESSION['uid'];
        $cursorPoint = (int) $_POST['cursorPoint'];

        // start rejecting previous leaves

        $todayDate = date('Y-m-d');
        $rejectOlderQuery = "SELECT `s_no` FROM `leaves` WHERE `sender_id`=? AND `status`=? AND `start_date` <= ?;";
        $pendingStatus = "pending";
        $pstmt = mysqli_prepare($conn, $rejectOlderQuery);
        mysqli_stmt_bind_param($pstmt, "sss", $uid, $pendingStatus, $todayDate);
        mysqli_stmt_execute($pstmt);
        $pendingResult = mysqli_stmt_get_result($pstmt);
        if (mysqli_num_rows($pendingResult) > 0) {
            $rowIds = array();
            $i = 0;
            while ($pendingRows = mysqli_fetch_assoc($pendingResult)) {
                $rowIds[$i] = (int) $pendingRows['s_no'];
                $i++;
            }
            $newColumnValue = "rejected";
            $rowIdsString = implode(",", $rowIds);

            $rejectPendingQuery = "UPDATE `leaves` SET `status` = ?  WHERE `s_no` IN ($rowIdsString)";

            $finalStatement = $conn->prepare($rejectPendingQuery);
            $finalStatement->bind_param("s", $newColumnValue);
            $finalStatement->execute();
            $finalStatement->close();
        }
        mysqli_stmt_close($pstmt);

        // end of rejecting previous leaves


        $sql = "SELECT * FROM `leaves` WHERE `sender_id` = ? ORDER BY `s_no` DESC LIMIT 5 OFFSET ?;";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $uid , $cursorPoint);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $query = "SELECT COUNT(*) AS `count` FROM `leaves` WHERE `sender_id` = ?;";

        $stmt2 = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt2, "s", $uid );
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        $row = mysqli_fetch_assoc($result2);
        $response['leave-count'] = $row['count'];
        mysqli_stmt_close($stmt2);

        if (mysqli_num_rows($result) > 0) {
            $response['data'] = "";
            $response['status'] = "success";
            while ($row = mysqli_fetch_assoc($result)) {

                $send_date = date('d M, Y', strtotime($row['send_date']));
                $start_date = date('d M, Y', strtotime($row['start_date']));
                $end_date = date('d M, Y', strtotime($row['end_date']));

                $editor = "";
                if($row['status'] == "pending"){
                    $editor = ' <span class="text-success me-1 d-flex justify-content-center text-center edit-leave" onclick="editingMode(`'.$row['s_no'].'`)">
                    <i class="bx bxs-edit"></i>
                </span>';
                }
                
                $response['data'] .= ' <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed d-flex w-100" type="button" data-bs-toggle="collapse" data-bs-target="#flush-'.$row['s_no'].'" aria-expanded="false" aria-controls="flush-collapseOne">
                        <div class="d-flex">
                            <div class="status-ball me-1 '. $row['status'] .'"></div>
                            '. $row['leave_type'] .' 
                        </div>
                        <div class="ms-auto">'. $send_date .'</div>
                    </button>
                </h2>
                <div id="flush-'.$row['s_no'].'" class="accordion-collapse collapse" data-bs-parent="#leave-accordion">
                    <div class="accordion-body">
                        <div class="mb-2">
                            <b>STATUS - </b>'. $row['status'] .'
                        </div>
                        <div>
                            <b>DESCRIPTION - </b>
                            <p>'. $row['leave_desc'] .'</p>
                        </div>
                        <div>
                            <b>DATE RANGE - </b>
                            <p>'. $start_date .' - '. $end_date .'</p>
                        </div>
                        <div>
                            <b>ACTION - </b>
                            <div class="d-flex g-2 mt-2 leave-actions">
                               '. $editor .'
                                <span class="text-danger me-1 d-flex justify-content-center text-center delete-leave" onclick="openDeleteConfirmationDialog(`'.$row['s_no'].'`)">
                                    <i class="bx bxs-trash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
        } else {
            $response['status'] = "ERROR";
            $response['message'] = "Unable to send leave!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Unable to send leave!";
    }
} else {
    $response['status'] = "ERROR";
    $response['message'] = "Invalid request!";
}

echo json_encode($response);
