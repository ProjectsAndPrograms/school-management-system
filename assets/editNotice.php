<?php
include("config.php");
session_start();

$response = "";
$deleted = false;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noticeId = (int) ($_POST["noticeId"]);
    $disks = $_POST["disks"];
    $body =  mysqli_real_escape_string($conn, $_POST["body"]);;
    $title =  mysqli_real_escape_string($conn, $_POST["title"]);;
    
    $editorId = $_SESSION['uid'];

    $query = "UPDATE `notice` SET `editor_id`=?, `title`=?, `body`=?, `importance`=?, `timestamp`=current_timestamp() WHERE `s_no`=?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $editorId, $title, $body, $disks, $noticeId);

    if (mysqli_stmt_execute($stmt)) {

        $response = 'success';
        if (isset($_FILES["files"]) && $_FILES["files"]["error"] == 0) {


            $sql = "SELECT `file` FROM `notice` WHERE s_no = ?";
            $stmt2 = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt2, 'i', $noticeId);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $result);
            mysqli_stmt_fetch($stmt2);
            mysqli_stmt_close($stmt2);


            $filename = $_FILES["files"]["name"];
            $tempname = $_FILES["files"]["tmp_name"];

            $fileInfo = pathinfo($filename);
            $fileExtension = strtolower($fileInfo['extension']);

            if ($result == "") {
                // Uncomment the following code after testin
               $deleted = true;
            } else {

                $currentFileLocation = ".." . DIRECTORY_SEPARATOR . "noticeUploads" . DIRECTORY_SEPARATOR . $result;
                if (file_exists($currentFileLocation)) {
                    if (unlink($currentFileLocation)) {
                        $deleted = true;
                    } else {
                        $response = "something went wrong!";
                    }

                }
            }

            if($deleted){
                $newName = $editorId . time() . "." . $fileExtension;
                
                $folder = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "noticeUploads" . DIRECTORY_SEPARATOR . $newName;
    
                if (move_uploaded_file($tempname, $folder)) {
    
                    $updateQuery = "UPDATE `notice` SET `editor_id`=? , `file`=? WHERE `s_no`=?";
                    $stmt = mysqli_prepare($conn, $updateQuery);
                    mysqli_stmt_bind_param($stmt, "ssi", $editorId, $newName, $noticeId);
    
                    if (mysqli_stmt_execute($stmt)) {
                        $response = "success";
                    } else {
                        $response = "something went wrong!";
                    }
    
                    
                } else {
                    $response = "something went wrong!";
                }
    
                $updateFileQuery = "UPDATE notice SET `file`=? WHERE `s_no`=?";
                $stmt3 = mysqli_prepare($conn, $updateFileQuery);
                mysqli_stmt_bind_param($stmt3, "si", $newName, $noticeId);
                if(mysqli_stmt_execute($stmt3)){
                    $response = "success";
                }else{
                    $response = "Something went wrong!";
                }
                mysqli_stmt_close($stmt3);
            }else{
                $response = "Something went wrong!";
            }

           

        }
        mysqli_stmt_close($stmt);
    } else {
        $response = "something went wrong! Database error";
    }
} else {
    $response = 'Invalid request method';
}


echo $response;
?>