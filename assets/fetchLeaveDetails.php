<?php
session_start();
include("config.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_SESSION['uid'], $_POST['s_no'])) {

        $s_no = (int) $_POST['s_no'];

        $query = "SELECT * FROM `leaves` WHERE `leaves`.`s_no` = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $s_no);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $teacher_id = $row['sender_id'];

            $query2 = "SELECT `fname`, `lname`, `phone`, `image`, `subject` FROM `teachers` WHERE `teachers`.`id` = ? LIMIT 1";
            $stmt2 = mysqli_prepare($conn, $query2);
            mysqli_stmt_bind_param($stmt2, "s", $teacher_id);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);

            if (mysqli_num_rows($result2) > 0) {
                $teacherInfo = mysqli_fetch_assoc($result2);

                $teacher_name = ucfirst(strtolower($teacherInfo['fname'])) . " " . strtolower($teacherInfo['lname']);

                $send_date = date('d M, Y', strtotime($row['send_date']));
                $start_date = date('d M, Y', strtotime($row['start_date']));
                $end_date = date('d M, Y', strtotime($row['end_date']));
                $leave_type = $row['leave_type'];
                $leave_desc = $row['leave_desc'];


                $subject = $teacherInfo['subject'];
                $contact = $teacherInfo['phone'];

                $image = ".." . DIRECTORY_SEPARATOR . "teacherUploads" . DIRECTORY_SEPARATOR . $teacherInfo['image'];
                $image_path = file_exists($image) ? $image : ".." . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "user.png";

                $response['status'] = 'success';

                $response['data'] = '<div class="modal-header">
				<div class="d-flex">
					<img src="' . $image_path . '" id="image">
					<div class="d-flex ms-3" style="flex-direction: column;">
						<h1 class="modal-title fs-5" id="staticBackdropLabel" id="teacher_name">
							' . $teacher_name . '
						</h1>
						<div id="teacher_id">' . $teacher_id . '</div>
					</div>
				</div>
				<button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
			</div>
			<div class="modal-body px-3">
				<h1 class="fs-5" id="leave_type">' . $leave_type . '</h1>
				<p class="px-3 leave-description text-break" style="text-align: justify;" id="leave_description ">' . $leave_desc . '</p>
				<br>
				<div class="d-flex justify-content-between">
					<span class="text-start" >
						<div><b>Apply date - </b></div>
						<small id="apply_date">' . $send_date . '</small>
					</span>
					<span class="text-end">
						<div><b>From - </b><small id="start_date">' . $start_date . '</small></div>
						<div><b>To -</b> <small id="end_date">' . $end_date . '</small></div>
					</span>
				</div>
			</div>
			<div class="modal-footer">
				<div class="d-flex justify-content-between" style="width: 100% !important; ">
					<span class="text-start ">
						<div class="-details"><b>Contact - </b> <small id="contact">' . $contact . '</small></div>
						<div class="-details"><b>Subject - </b> <small id="subject"> ' . $subject . '</small></div>
					</span>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>';
            } else {
                $response['status'] = "ERROR";
                $response['message'] = "No data found!";
            }
        } else {
            $response['status'] = "ERROR";
            $response['message'] = "No data found!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['status'] = "ERROR";
        $response['message'] = "Incomplete parameters!";
    }
} else {
    $response['status'] = "ERROR";
    $response['message'] = "Invalid request method!";
}

echo json_encode($response);
