<?php
include('config.php');
$response = array();
session_start();

if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];

    $query = "SELECT `image` FROM `admins` WHERE `admins`.`id`=? UNION SELECT `image` FROM `teachers` WHERE `teachers`.`id`=? ";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);


        $sql = 'SELECT `role` FROM `users` WHERE `users`.`id`=?';
        $stmt2 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt2, "s", $uid);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        if(mysqli_num_rows($result2) > 0){
            $row2 = mysqli_fetch_assoc($result2);

            if($row2['role'] == 'admin'){
                $response['status'] = 'success';
                if($row['image'] == ''){
                    $path = ".." . DIRECTORY_SEPARATOR . "adminUploads" . DIRECTORY_SEPARATOR . "1701517055user.png";
                    $path = file_exists($path) ? $path : "../images/user.png";
                    $response['data'] = '<img src="'.$path.'" >';
                }else{
                    $path = ".." . DIRECTORY_SEPARATOR . "adminUploads" . DIRECTORY_SEPARATOR . $row['image'];
                    $path = file_exists($path) ? $path : "../images/user.png";
                    $response['data'] = '<img src="'.$path.'" >';
                }
            }else if($row2['role'] == 'teacher'){
                $response['status'] = 'success';
                if($row['image'] == ''){
                    $path =  ".." . DIRECTORY_SEPARATOR . "teacherUploads" . DIRECTORY_SEPARATOR . "1701517055user.png";
                    $path = file_exists($path) ? $path : "../images/user.png";
                    $response['data'] = '<img src="'.$path.'" >';
                }else{
                    $path = ".." . DIRECTORY_SEPARATOR . "teacherUploads" . DIRECTORY_SEPARATOR . $row['image'];
                    $path = file_exists($path) ? $path : "../images/user.png";
                    $response['data'] = '<img src="'.$path.'" >';
                }
            }else{
                $response['status'] = 'success';
                $path =  ".." . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "user.png";
                $path = file_exists($path) ? $path : "../images/user.png";
                $response['data'] = '<img src="'.$path.'" >';
            }
        

        }else{
            $response['status'] = 'error';
            $response['message'] = 'Something went wrong!';
        }

       
    }else{
        $response['status'] = 'error';
        $response['message'] = 'Something went wrong!';
    }

}else{
    $response['status'] = 'error';
    $response['message'] = 'Something went wrong!';
}
echo json_encode($response);
?>
