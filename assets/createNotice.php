<?php
include('config.php');
session_start();



$allowedFileSize = 200 * 1024 * 1024;
$response = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title =  mysqli_real_escape_string($conn, $_POST["title"]);
    $body = "";
    $file = "";
    $importance = $_POST['disks'];
    $senderId = $_SESSION['uid'];

    if (isset($_POST['body'])) {
        $body = mysqli_real_escape_string($conn, $_POST["body"]);;
    }

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {

    
        $fileSize = $_FILES['file']['size'];

        if ($fileSize > $allowedFileSize) {
            $response = "File is too large, allowed limit is 200 MB";
        } else {
            $filename = $_FILES["file"]["name"];
            $tempname = $_FILES["file"]["tmp_name"];

            $fileInfo = pathinfo($filename);
            $fileExtension = strtolower($fileInfo['extension']);

            $newName = $senderId . time() . "." . $fileExtension;

            $folder = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "noticeUploads" . DIRECTORY_SEPARATOR . $newName;

            if (move_uploaded_file($tempname, $folder)) {
                $file = $newName;
            } else {
                $file = "";
            }
        }

    } else {
        $fileSize = 0;
    }

    if ($fileSize > $allowedFileSize) {

    } else {
       
        // Use prepared statement to insert notice
        $query = "INSERT INTO `notice` (`s_no`, `sender_id`, `editor_id`, `title`, `body`,  `importance`,`file`, `timestamp`) VALUES (NULL, ?, ?, ?, ?, ?, ?, current_timestamp())";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $senderId, $senderId, $title, $body, $importance, $file);

     

        if (mysqli_stmt_execute($stmt)) {
            $response = "success";
        } else {
            $response = "Unable to create notice!";
        }
        mysqli_stmt_close($stmt);
    }

} else {
    $response = "Invalid request!";
}

echo $response;
?>
