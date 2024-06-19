<?php

include('config.php');

if (isset($_POST['noticeId'])) {
    $noticeId = $_POST['noticeId'];
    $data = array('noticeId' => $noticeId);
    
    $sql = "SELECT *
    FROM notice
    WHERE s_no = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $noticeId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data['status'] = "success";
            
            $data["title"] = $row["title"];
            $data["body"] = $row["body"];
           
        }
    }else{
        $data['status'] = "Unable to fetch data!";
    }

    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonData;

    mysqli_stmt_close($stmt);
}
?>
