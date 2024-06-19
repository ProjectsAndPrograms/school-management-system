<?php

include('config.php');
if (isset($_POST['subject_id'])) {
    $id = $_POST['subject_id'];
    $data = array(
        'subject_id' => $id
    );

    $sql = "SELECT *
       FROM subjects
       WHERE subject_id = ?";

    // $result = mysqli_query($conn, $sql);

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {

            $data["subject"] = $row["subject_name"];
        }
    }





    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonData;
}


?>