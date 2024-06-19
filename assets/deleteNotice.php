<?php
include('config.php');
$response = "";

if (isset($_POST['noticeId'])) {
    $noticeId = intval($_POST['noticeId']);

    $sql = "SELECT `file` FROM `notice` WHERE `s_no` = ?";
    $stmt2 = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt2, "i", $noticeId);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $pathToFile = ".." . DIRECTORY_SEPARATOR . "noticeUploads" . DIRECTORY_SEPARATOR . $row['file'];


        if (trim($row['file'] == '')) {
            $query = "DELETE FROM `notice` WHERE `notice`.`s_no` = ?";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $noticeId);
                if (mysqli_stmt_execute($stmt)) {
                    $response = "success";
                } else {
                    $response = "Something went wrong while deleting!";
                }
                mysqli_stmt_close($stmt);
            } else {
                $response = "Something went wrong!";
            }
        } else {
            if (file_exists($pathToFile)) {
                if (unlink($pathToFile)) {

                    $query = "DELETE FROM `notice` WHERE `notice`.`s_no` = ?";
                    $stmt = mysqli_prepare($conn, $query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "i", $noticeId);
                        if (mysqli_stmt_execute($stmt)) {
                            $response = "success";
                        } else {
                            $response = "Something went wrong while deleting!";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        $response = "Something went wrong!";
                    }
                } else {
                    $response = "Unable to delete file!";
                }
            } else {
                $query = "DELETE FROM `notice` WHERE `notice`.`s_no` = ?";
                $stmt = mysqli_prepare($conn, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $noticeId);
                    if (mysqli_stmt_execute($stmt)) {
                        $response = "success";
                    } else {
                        $response = "Something went wrong while deleting!";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $response = "Something went wrong!";
                }
            }
        }


    } else {
        $response = "Notice not found!";
    }

} else {
    $response = "Notice id is not set!";
}

echo $response;
?>