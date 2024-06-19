<?php
    session_start();
    include("config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = "";

    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);

    $class = mysqli_real_escape_string($conn, $_POST["class"]);
    $subject = mysqli_real_escape_string($conn, $_POST["subject"]);
    $senderId = $_SESSION['uid'];

    if (
        isset($_FILES["file"]) &&
        $_FILES["file"]["error"] == 0 &&
        isset($_POST["title"]) &&
        isset($_POST["class"]) &&
        isset($_POST["subject"]) &&
        isset($_POST["comment"])
    ) {


        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];


        $fileInfo = pathinfo($filename);
        $fileExtension = strtolower($fileInfo['extension']);

        $newName = $senderId . time() . "." . $fileExtension;

        $folder = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "notesUploads" . DIRECTORY_SEPARATOR . $newName;

        if (move_uploaded_file($tempname, $folder)) {

            $query = "INSERT INTO `notes` (`s_no`, `sender_id`, `editor_id`, `class`, `subject`, `title`, `comment`, `file`, `timestamp`) VALUES (NULL,?,?,?,?,?,?,?, current_timestamp());";

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssss",$senderId, $senderId, $class, $subject, $title, $comment, $newName);

            if(mysqli_stmt_execute($stmt)){
                $response = "success";
            }else{
                $response = "Unable to create note!";
            }


            mysqli_stmt_close($stmt);

        } else {
            $response = "Something went wrong!";
        }
    } else {
        $response = "Something went Wrong!1";
    }


} else {
    $response = "Something went wrong!2";
}

echo $response;
mysqli_close($conn);

?>