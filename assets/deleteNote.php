<?php
include("config.php");
$response = "";

if (isset($_POST["noteId"])) {
    $noteId = (int) $_POST["noteId"];

    $sql = "SELECT `file` FROM `notes` WHERE `s_no` = ?";
    $stmt2 = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt2, "i", $noteId);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $pathToFile = ".." . DIRECTORY_SEPARATOR . "notesUploads" . DIRECTORY_SEPARATOR . $row['file'];

        if (file_exists($pathToFile)) {
            if (unlink($pathToFile)) {
                $query = "DELETE FROM `notes` WHERE `s_no` = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "i", $noteId);

                if (mysqli_stmt_execute($stmt)) {
                    $response = "success";
                } else {
                    $response = "Unable to delete Note! " . mysqli_error($conn);
                }
            } else {
                $response = "Unable to delete file!";
            }
        } else {
            $response = "File not found!";
        }
    } else {
        $response = "Note not found!";
    }
} else {
    $response = "Invalid request!";
}

echo $response;
?>
