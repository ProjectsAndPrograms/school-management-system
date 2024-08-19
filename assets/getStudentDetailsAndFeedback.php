<?php

include('config.php');
session_start();

if (isset($_POST['id']) && isset($_SESSION['uid'])) {
    $id = $_POST['id'];
    $uid = $_SESSION['uid'];

    $data = array('id' => $id);

    $sql = "SELECT * FROM students WHERE students.id = ? LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data['status'] = "success";
            $data["name"] = ucfirst(strtolower($row["fname"])) . " " . strtolower($row['lname']);
            $row['image'] = "../studentUploads/".$row['image'];
            $data["image"] = file_exists($row['image']) ? $row['image'] : "../images/user.png";

            $dobString = $row["dob"];
            $timestamp = strtotime($dobString);
            $data["dob"] = date('d/m/Y', $timestamp);

            $data["phone"] = $row["phone"];
            $data["email"] = $row["email"];
        }
        $query = "SELECT * FROM `feedback` WHERE `receiver_id` = ? AND `sender_id` = ? ORDER BY s_no ASC";

        $stmt2 = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt2, "ss", $id, $uid);
        mysqli_stmt_execute($stmt2);

        $feedbacks = mysqli_stmt_get_result($stmt2);
        $data['feedbacks'] = "";

        if (mysqli_num_rows($feedbacks) > 0) {
            while ($row = mysqli_fetch_assoc($feedbacks)) {

                $timestamp = $row['timestamp'];
                $formattedDate = date('d M, Y', strtotime($timestamp));

             

                $data['feedbacks'] .= '<div class="card mb-2 px-3  feedback-msg">
                <p class="mt-0 pt-0 text-break">
                    ' . $row['msg'] . '
                </p>

                <div class="_flex w-100" style="align-items: center;">
                <small>' . $formattedDate . ' </small>
                <a class="ms-auto" onclick="deleteFeedback(' . $row['s_no'] . ',`' . $row['receiver_id'] . '`)"><i class="bx bxs-trash text-danger fs-4 trash-hover-red" ></i></a>
                </div>
            </div>';
            }
        } else {
            $data['feedbacks'] .= '<div class="content-center"><p class="text-center fs-3" style="opacity: .5;">No Feedbacks </p></div>';
        }
    }else{
        $data['status'] = 'error';
        $data['message'] = 'Something went wrong!';
    }

    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonData;

    mysqli_stmt_close($stmt);
}
