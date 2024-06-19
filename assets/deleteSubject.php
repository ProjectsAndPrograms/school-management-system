<?php
include('config.php');
$response = "";

if (isset($_POST['subjectId'])) {
    $subID = $_POST['subjectId'];

    // Use prepared statement to delete subject
    $sql = "DELETE FROM `subjects` WHERE `subject_id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $subID);

    if (mysqli_stmt_execute($stmt)) {
        $response = "success";
    } else {
        $response = "Unable to delete subject";
    }

} else {
    $response = 'Something went wrong!';
}

echo $response;
?>
