<?php
session_start();
include('config.php');
$data = array();

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    $sql = "SELECT * FROM reminders WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $count = 0;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $msg = $row['message'];
            $status = $row['status'];
            $line = $row['s_no'];
            $class =  $status == 'pending' ? 'not-completed' : 'completed';
            $icon =  $status == 'pending' ? '<i class="bx bx-info-circle not-done"></i>' : '<i class="bx bx-check-circle ok-done"></i>';

            $data[$count] = '<li class="' . $class  . '">
                                <div class="task-title">
                                    <a class="status-btn" onclick="changeReminderStatus(' . $line . ')">
                                       ' . $icon . '
                                    </a>
                                    <p>' . $msg . '</p>
                                </div>
                                 <a onclick="deleteReminder(' . $line . ', ' . $count . ')"><i class="bx bx-trash ml-2 text-danger"></i></a>
                             </li>';

            $count++;
        }
    }

    mysqli_stmt_close($stmt);
}

echo json_encode($data);
?>
