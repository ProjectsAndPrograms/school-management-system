<?php

include("config.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = "";
    $senderId = $_SESSION['uid'];
    $class = mysqli_real_escape_string($conn, $_POST["class"]);
    $subject = mysqli_real_escape_string($conn, $_POST["subject"]);

    $query = "SELECT * FROM `syllabus` WHERE `class`= ? AND `subject` = ?";
    $statement = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($statement, "ss", $class, $subject);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);


    if (
        isset($_FILES["file"]) &&
        $_FILES["file"]["error"] == 0 &&
        isset($_POST["class"]) &&
        isset($_POST["subject"])
    ) {

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
                        $query = "UPDATE `syllabus` SET `file` = ? WHERE `class` = ? AND `subject` = ?;";
        
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "sss",$newName, $class, $subject);
        
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
                $query = "INSERT INTO `syllabus` (`s_no`, `class`, `subject`, `file`) VALUES (NULL, ?, ?, ?)";

                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "sss", $class, $subject, $newName);

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



    } else {
        $response = "Something went Wrong!";
    }


} else {
    $response = "Something went wrong!";
}

echo $response;

mysqli_close($conn);
?>