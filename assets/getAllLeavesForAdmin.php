<?php
session_start();
include("config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_SESSION['uid'], $_POST['status'], $_POST['limit'], $_POST['offset'])) {

        $status = $_POST['status'];
        $limit = (int) $_POST['limit'];
        $offset = (int) $_POST['offset']; 

        $query = "SELECT * FROM `leaves` WHERE `leaves`.`status` = ? ORDER BY `s_no` DESC LIMIT ? OFFSET ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sii", $status, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $sql = "SELECT COUNT(*) AS `count` FROM `leaves` WHERE `leaves`.`status` = ?";
        $stmt1 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt1, "s", $status);
        mysqli_stmt_execute($stmt1);
        $result1 = mysqli_stmt_get_result($stmt1);
        $countRow = mysqli_fetch_assoc($result1);

        $todayDate = date('Y-m-d');
        $rejectOlderQuery = "SELECT `s_no` FROM `leaves` WHERE `status`=? AND `start_date` <= ?;";
        $pendingStatus = "pending";
        $pstmt = mysqli_prepare($conn, $rejectOlderQuery);
        mysqli_stmt_bind_param($pstmt, "ss", $pendingStatus, $todayDate);
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

        if (mysqli_num_rows($result) > 0) {
            $response['count'] = $countRow['count'];
            $response['status'] = 'success';
            $response['data'] = '';


            while ($row = mysqli_fetch_assoc($result)) {

                $teacher_id = $row['sender_id'];

                $query2 = "SELECT fname, lname FROM `teachers` WHERE `teachers`.`id` = ? LIMIT 1";
                $stmt2 = mysqli_prepare($conn, $query2);
                mysqli_stmt_bind_param($stmt2, "s", $teacher_id);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);

                $actions = "";
                if ($status == "pending") {
                    $actions = '<button class="btn btn-success me-1 btn-sm border-0 d-flex justify-content-center text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Approve Leave"
                    onclick="openApproveConfirmationDialog(' . (int) $row['s_no'] . ')"
                    >
                    <i class="bx bx-check"></i>
                    </button>
                    <button class="btn btn-danger me-1 btn-sm border-0 d-flex justify-content-center text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Reject Leave" onclick="openRejectConfirmationDialog(' . (int) $row['s_no'] . ')">
                        <i class="bx bx-x"></i>
                    </button>';
                } elseif ($status == "rejected") {
                    $actions = '<button class="btn btn-danger me-1 btn-sm border-0 d-flex justify-content-center text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Delete" onclick="openLeaveDeleteConfirmationDialog(' . (int) $row['s_no'] . ')">
                    <i class="bx bxs-trash"></i>
                </button>';
                } else {
                }

                if (mysqli_num_rows($result2) > 0) {
                    $teacherInfo = mysqli_fetch_assoc($result2);

                    $teacherName = ucfirst(strtolower($teacherInfo['fname'])) . " " . strtolower($teacherInfo['lname']);

                    $send_date = date('d M, Y', strtotime($row['send_date']));
                    $start_date = date('d M, Y', strtotime($row['start_date']));
                    $end_date = date('d M, Y', strtotime($row['end_date']));

                    $response['data'] .= '<tr>
                    <td class="text-center">' . $teacherName . '</td>
                    <td class="text-center">' . $row['leave_type'] . '</td>
                    <td class="text-center">' . $send_date . '</td>
                    <td class="text-center">' . $start_date . ' - ' . $end_date . '</td>
                    <td class="content-center">
                        <div class="d-flex small-flex-column">
                                <button class="btn btn-warning me-1 btn-sm border-0 d-flex justify-content-center text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="View Details" onclick="showLeaveDeatilsDialog(' . $row['s_no'] . ')">
                                    <i class="bx bx-show-alt"></i>
                                </button>
                            ' . $actions . '
                        </div>
        
                    </td>
                </tr>';
                } else {
                    $response['status'] = "ERROR";
                    $response['message'] = "Something went wrong!";
                }
            }
        } else {
            $response['status'] = "ERROR";
            $response['message'] = "No data found!";
        }
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt1);
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Incomplete parameters!";
    }
} else {
    $response['status'] = "ERROR";
    $response['message'] = "Invalid request method!";
}

echo json_encode($response);
