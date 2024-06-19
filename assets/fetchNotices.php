<?php
include('config.php');
$response = array();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['begin'])) {

    $begin = (int) ($_POST['begin']);

    $query = "SELECT * FROM `notice` ORDER BY `s_no` DESC LIMIT 6 OFFSET $begin;";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $counter = 1;

            $sql = "SELECT COUNT(*) FROM `notice`";
            $stmt1 = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1, $rowCount);
            mysqli_stmt_fetch($stmt1);

            $response[0] = $rowCount;

            while ($row = mysqli_fetch_assoc($result)) {

                $noticeTitle = $row['title'];
                $title = strlen($noticeTitle) > 30 ? substr($noticeTitle, 0, 25) . "..." : $noticeTitle;

                $rowBody = $row['body'];
                $body = strlen($rowBody) > 200 ? substr($rowBody, 0, 200) . "..." : $rowBody;

                $timestamp = $row['timestamp'];
                $formattedTime = date('d M, Y', strtotime($timestamp));

                $disks = array("msg-green", "msg-yellow", "msg-red");
                $importanceInt = (int) ($row['importance'] . "");

                if ($rowBody == "") {
                    $rowBody = "no body";
                }

                $pathToFile = ".." . DIRECTORY_SEPARATOR . "noticeUploads" . DIRECTORY_SEPARATOR . $row['file'];



                $file_extension = "";
                $showFileSize = "";
                $haveFile  = "";

                if($row['file'] == ""){}
                else {

                    if(is_file($pathToFile)){
                        $file_info = pathinfo($pathToFile);
                        $file_extension = "(".$file_info['extension'].")";
    
                        $fileSizeInKB = (int) (filesize($pathToFile) / 1024);
                        $fileSizeInMB = (int) (filesize($pathToFile) / (1024 * 1024));
    
                        $showFileSize = $fileSizeInMB > 1 ? $fileSizeInMB . "MB" : $fileSizeInKB . "KB";


                        $haveFile = $row['file'] == "" ? "" : ' <a href="' . $pathToFile . '" download="' . $row['file'] . '" class="other-file"><i class="bx bxs-download"></i></a>&nbsp; <small>'.$showFileSize.' '.$file_extension.'</small>';
    
                    }
                    
                }

               
             

                $response[$counter] = '<div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="flex-heading">
                                    <h5 class="card-title">' . ucfirst($title)  . '</h5> <span class="' . $disks[$importanceInt - 1] . '"></span>
                                </div>
                                <small>' . $formattedTime . '</small>
                                <p class="card-text">' .ucfirst($body)   . '</p>
                            </div>
                            <div class="card-buttons">
                                <div class="files">
                                <a onclick="showFullNotice(`' . $row['s_no'] . '`)" class="image-file">  <i class="bx bx-show-alt" ></i></a>
                                  ' . $haveFile . '
                                </div>
                                
                                <div class="actions25">
                                    <a class="edit-btn" onclick="openEditDialog(`' . $row['s_no'] . '`)"> <i
                                            class="bx bxs-edit"></i></a>
                                    <a class="delete-btn" onclick="openDeleteConfirmationDialog(' . $row['s_no'] . ')"><i
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
        $response[0] = "Something went wrong!";
    }
} else {
    $response[0] = "Something went wrong!";
}


echo json_encode($response);


?>