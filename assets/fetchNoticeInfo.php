<?php

include('config.php');

if (isset($_POST['noticeId'])) {
    $id = $_POST['noticeId'];
    $data = array('noticeId' => $id);
    
    $sql = "SELECT *
    FROM notice
    WHERE s_no = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data['status'] = "success";
            $data["sender_id"] = $row["sender_id"];
            $data["editor_id"] = $row["editor_id"];
            $data["title"] = $row["title"];
            $data["body"] = $row["body"];
            $data["file"] = $row["file"] == "" ? "": ".." . DIRECTORY_SEPARATOR . "noticeUploads" . DIRECTORY_SEPARATOR . $row['file'];
            $data["importance"] = $row["importance"];
            $data["timestamp"] = $row["timestamp"];
        }
    }else{
        $data['status'] = "unable to fetch data!";
    }

    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonData;

    mysqli_stmt_close($stmt);
}
?>
