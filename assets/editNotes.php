<?php

include("config.php");
session_start();
$response = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $title = $_POST['title'];
    $comment = $_POST['comment'];
    $noteId = $_POST['noteId'] . "";
    $editorId = $_SESSION['uid'];


    if (
        isset($_FILES["file"]) &&
        $_FILES["file"]["error"] == 0 &&
        isset($_POST['class']) &&
        isset($_POST['subject']) &&
        isset($_POST['title']) &&
        isset($_POST['comment']) &&
        isset($noteId)
    ) {
        $query1 = "SELECT `file` FROM `notes` WHERE s_no = ?";

        $stmt1 = mysqli_prepare($conn, $query1);
        $intNoteId = (int) $noteId;

        mysqli_stmt_bind_param($stmt1, "i", $intNoteId);

        mysqli_stmt_execute($stmt1);

        $result1 = mysqli_stmt_get_result($stmt1);
        $row = mysqli_fetch_assoc($result1);

        mysqli_stmt_close($stmt1);
        $existingFilePath = ".." . DIRECTORY_SEPARATOR . "notesUploads" . DIRECTORY_SEPARATOR . $row['file'];

    
        if (unlink($existingFilePath)) {

        } else {

        }

        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];

        $fileInfo = pathinfo($filename);
        $fileExtension = strtolower($fileInfo['extension']);

        $newName = $editorId . time() . "." . $fileExtension;

        $folder = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "notesUploads" . DIRECTORY_SEPARATOR . $newName;


        if (move_uploaded_file($tempname, $folder)) {

  
            $query2 = "UPDATE `notes` SET `class` = ? , `subject`=?, `title`=? , `comment`=? , `editor_id`=? , `file`=? WHERE `notes`.`s_no` = ?;";

            $stmt2 = mysqli_prepare($conn, $query2);

            mysqli_stmt_bind_param($stmt2, "ssssssi", $class, $subject, $title, $comment, $editorId, $newName, $intNoteId);

            if (mysqli_stmt_execute($stmt2)) {
                $response = "success";

            } else {
                $response =  'Something went wrong!';
            }
            mysqli_stmt_close($stmt2);


        } else {
            $response =  'Something went wrong!';
        }

    } else {

        $query3 = "UPDATE `notes` SET `class` = ? , `subject`=?, `title`=? , `comment`=? , `editor_id`=? WHERE `notes`.`s_no` = ?;";

        $stmt3 = mysqli_prepare($conn, $query3);
        $intNoteId = (int) $noteId;

        mysqli_stmt_bind_param($stmt3, "sssssi", $class, $subject, $title, $comment, $editorId,  $intNoteId);

        if (mysqli_stmt_execute($stmt3)) {
            $response = "success";

        } else {
            $response =  'Something went wrong!';
        }
        mysqli_stmt_close($stmt3);
    }




} else {
    $response = "Unable to edit note!";
}
echo $response;

?>