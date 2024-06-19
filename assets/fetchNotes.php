<?php
include('config.php');
$response = array();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $jsonData = file_get_contents('php://input');
    $decodedData = json_decode($jsonData, true); 

    $classOfNote = $decodedData['_class'];
    $begin = (int) ($decodedData['begin']);

    $query = "SELECT * FROM `notes` WHERE `class`=? ORDER BY `s_no` DESC LIMIT 6 OFFSET ? ";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $classOfNote, $begin);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $counter = 1;

            $sql = "SELECT COUNT(*) FROM `notes` WHERE `class`= ? ";
            $stmt1 = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt1, "s", $classOfNote);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1, $rowCount);
            mysqli_stmt_fetch($stmt1);

            $response[0] = $rowCount;

            while ($row = mysqli_fetch_assoc($result)) {

                $noteTitle = $row['title'];
                $title = strlen($noteTitle) > 30 ? substr($noteTitle, 0, 25) . "..." : $noteTitle;

                $rowComment = $row['comment'];
                $body = strlen($rowComment) > 200 ? substr($rowComment, 0, 200) . "..." : $rowComment;

                $timestamp = $row['timestamp'];
                $formattedTime = date('d M, Y', strtotime($timestamp));

                if ($rowComment == "") {
                    $rowComment = "no body";
                }

                $pathToFile = ".." . DIRECTORY_SEPARATOR . "notesUploads" . DIRECTORY_SEPARATOR . $row['file'];



                $file_extension = "";
                $showFileSize = "";
                $haveFile = "";

                if ($row['file'] == "") {
                } else {

                    if (is_file($pathToFile)) {
                        $file_info = pathinfo($pathToFile);
                        $file_extension = "(" . $file_info['extension'] . ")";

                        $fileSizeInKB = (int) (filesize($pathToFile) / 1024);
                        $fileSizeInMB = (int) (filesize($pathToFile) / (1024 * 1024));

                        $showFileSize = $fileSizeInMB > 1 ? $fileSizeInMB . "MB" : $fileSizeInKB . "KB";


                        $haveFile = $row['file'] == "" ? "" : ' <a href="' . $pathToFile . '" download="' . $row['file'] . '" class="other-file"><i class="bx bxs-download"></i></a>&nbsp; <small>' . $showFileSize . ' ' . $file_extension . '</small>';

                    }

                }

                $response[$counter] = ' <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="flex-heading">
                                <h5 class="card-title">' . ucfirst($title). '</h5>
                            </div>
                            <small>' . $formattedTime . '</small>
                            <p class="card-text">' . ucfirst($body) . '</p>
                        </div>

                        <div class="card-buttons">
                        <div class="files">
                        <a class="image-file" onclick="showNotesInfo(`'.$row["s_no"].'`)">  <i class="bx bx-show-alt" ></i></a>
                          ' . $haveFile . '
                        </div>
                            <div class="actions25">
                            <a class="edit-btn" onclick="showEditDialog('.$row["s_no"].')"> <i
                            class="bx bxs-edit"></i></a>
                    <a class="delete-btn" onclick="deleteConfirmDialog('.$row["s_no"].')" ><i
                            class="bx bxs-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';


                $counter++;
            }
        } else {
            $response[0] = "No_Data";
        }

        mysqli_stmt_close($stmt);
    } else {
        $response[0] = "Something went wrong1!";
    }
} else {
    $response[0] = "Something went wrong!2";
}


echo json_encode($response);


?>