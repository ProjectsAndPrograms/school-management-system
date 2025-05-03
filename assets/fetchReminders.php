<?php
session_start();
include('config.php');

$data = array();

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    $sql = "SELECT s_no, message, status FROM reminders WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $currentReminders = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $currentReminders[] = [
                's_no' => $row['s_no'],
                'message' => $row['message'],
                'status' => $row['status']
            ];
        }
    }
    mysqli_stmt_close($stmt);

    $currentHash = md5(json_encode($currentReminders));

    if (isset($_SESSION['reminder_hash']) && $_SESSION['reminder_hash'] === $currentHash ) {
       
        $rawData = file_get_contents("php://input");
        $postData = json_decode($rawData, true);
        if(!(!empty($postData['refresh']) && $postData['refresh'] == 'true')){
            http_response_code(204);
            exit;
        }
    }

    $_SESSION['reminder_hash'] = $currentHash;

    foreach ($currentReminders as $index => $row) {
        $msg = $row['message'];
        $status = $row['status'];
        $line = $row['s_no'];
        $class =  $status == 'pending' ? 'not-completed' : 'completed';
        $icon =  $status == 'pending' ? '<i class="bx bx-info-circle not-done"></i>' : '<i class="bx bx-check-circle ok-done"></i>';

        $data[$index] = '<li class="' . $class  . '">
                            <div class="task-title">
                                <a class="status-btn" onclick="changeReminderStatus(' . $line . ')">
                                   ' . $icon . '
                                </a>
                                <p>' . $msg . '</p>
                            </div>
                             <a onclick="deleteReminder(' . $line . ', ' . $index . ')"><i class="bx bx-trash ml-2 text-danger"></i></a>
                         </li>';
    }

    echo json_encode($data);
}
?>
