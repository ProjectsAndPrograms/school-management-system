<?php
$response = '';
include("config.php");

if (isset($_POST["class"])) {
    $class1 = $_POST["class"];
    $response = $class1 . "lskjdflksj";

    $query = "SELECT * FROM subjects WHERE `class` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $class1);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $response .= " ";
        while ($row = mysqli_fetch_assoc($result)) {
            $response .="  <option>". $row['subject_name'] ."</option>";
        }
    } else {
        $response = "No_subject";
    }

    mysqli_stmt_close($stmt);
} else {
    $response = "Something went wrong!";
}

mysqli_close($conn);

echo $response;
?>
