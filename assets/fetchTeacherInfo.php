<?php

include('config.php');
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $data = array(
        'id' => $id
    );

    $sql = "SELECT *
       FROM teachers
       INNER JOIN teacher_guardian ON teachers.id = teacher_guardian.id  
       WHERE teachers.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {

            $data["fname"] = $row["fname"];
            $data["lname"] = $row["lname"];
            
            $data["class"] = $row["class"];
            $data["section"] = $row["section"];

            $data["subject"] = $row["subject"];
            $data["gender"] = $row["gender"];

            $dobString = $row["dob"];
            $timestamp = strtotime($dobString);
            $data["dob"] = date('Y-m-d', $timestamp);

            $data["phone"] = $row["phone"];
            $data["email"] = $row["email"];
            $data["address"] = $row["address"];
            $data["city"] = $row["city"];
            $data["zip"] = $row["zip"];
            $data["state"] = $row["state"];

            $data["guardian"] = $row["gname"];
            $data["gphone"] = $row["gphone"];
            $data["gaddress"] = $row["gaddress"];
            $data["gcity"] = $row["gcity"];
            $data["gzip"] = $row["gzip"];
            $data["relation"] = $row["relation"];
        }
    }

    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonData;

    mysqli_stmt_close($stmt);
}
?>
