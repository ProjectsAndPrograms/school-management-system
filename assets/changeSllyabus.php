<?php
include("config.php");
$response = "";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senderId = $_SESSION['uid'];

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0 && isset($_POST['sllyabusId'])) {

        $sllyabusId = (int) ($_POST['sllyabusId']);
        $query = "SELECT * FROM `syllabus` WHERE `s_no`=?";
        $statement = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($statement, "i", $sllyabusId);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $existingFile = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "syllabusUploads" . DIRECTORY_SEPARATOR . $row['file'];

            if (file_exists($existingFile)) {
                if (unlink($existingFile)) {
                    $filename = $_FILES["file"]["name"];
                    $tempname = $_FILES["file"]["tmp_name"];

                    $fileInfo = pathinfo($filename);
                    $fileExtension = strtolower($fileInfo['extension']);

                    $newName = $senderId . time() . "." . $fileExtension;

                    $folder = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "syllabusUploads" . DIRECTORY_SEPARATOR . $newName;

                    if (move_uploaded_file($tempname, $folder)) {
                        $query = "UPDATE `syllabus` SET `file` = ? WHERE `s_no` = ?;";

                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "si", $newName, $sllyabusId);

                        if (mysqli_stmt_execute($stmt)) {
                            $response = "success";
                        } else {
                            $response = "Unable to upload sllyabus!";
                        }
                        mysqli_stmt_close($stmt);

                    } else {
                        $response = "Error while uploading file!";
                    }

                } else {
                    $response = "Something went wrong!";
                }
            } else {
                $filename = $_FILES["file"]["name"];
                $tempname = $_FILES["file"]["tmp_name"];

                $fileInfo = pathinfo($filename);
                $fileExtension = strtolower($fileInfo['extension']);

                $newName = $senderId . time() . "." . $fileExtension;

                $folder = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "syllabusUploads" . DIRECTORY_SEPARATOR . $newName;

                if (move_uploaded_file($tempname, $folder)) {
                    $query = "UPDATE `syllabus` SET `file` = ? WHERE `s_no` = ?;";

                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "si", $newName, $sllyabusId);

                    if (mysqli_stmt_execute($stmt)) {
                        $response = "success";
                    } else {
                        $response = "Unable to upload sllyabus!";
                    }
                    mysqli_stmt_close($stmt);

                } else {
                    $response = "Error while uploading file!";
                }
            }

        }



    } else {
        $response = "Something went Wrong!";
    }
} else {
    $response = "Something went Wrong!";
}
echo $response;


?>