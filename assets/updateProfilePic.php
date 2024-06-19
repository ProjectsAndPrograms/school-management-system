<?php
include("config.php");
session_start();
error_reporting(1);
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_SESSION['uid'];

    $sql9 = "SELECT `role` FROM `users` WHERE `users`.id = ?";


        $stmt29 = mysqli_prepare($conn, $sql9);
        mysqli_stmt_bind_param($stmt29, "s", $id);
        mysqli_stmt_execute($stmt29);
        $result29 = mysqli_stmt_get_result($stmt29);

        if (mysqli_num_rows($result29)) {
           $row9 = mysqli_fetch_assoc($result29);    
        
           $query = "";
           if($row9['role'] == 'admin'){
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {

                $filename = $_FILES["file"]["name"];
                $tempname = $_FILES["file"]["tmp_name"];
                $file_mime_type = mime_content_type($tempname);
                $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        
                // Allowed MIME types
                $allowed_mime_types = ['image/jpeg', 'image/jpg', 'image/png'];
        
                if (!in_array($file_mime_type, $allowed_mime_types)) {
                    $response['status'] = "Error0";
                    $response['message'] = "Invalid file type. Only JPEG, JPG, and PNG are allowed.";
                    echo json_encode($response);
                    exit();
                }
        
                $query = "SELECT `image` FROM `admins` WHERE `admins`.`id`=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
        
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
        
                    $currentFilePath = ".." . DIRECTORY_SEPARATOR . "adminUploads" . DIRECTORY_SEPARATOR . $row['image'];
        
                    $deleted = false;
                    $newName = $id . time();
        
                    if (!file_exists($currentFilePath)) {
                        $deleted = true;
                    } else {
                        // $newName = pathinfo($row['image'], PATHINFO_FILENAME);
                        $response['test'] = $newName . " " . $currentFilePath;
                        if (file_exists($currentFilePath)) {
                            if (unlink($currentFilePath)) {
                                $deleted = true;
                            } else {
                                $deleted = false;
                            }
                        }
                    }
        
                    if ($deleted) {
                        $folder = ".." . DIRECTORY_SEPARATOR . "adminUploads" . DIRECTORY_SEPARATOR  . $newName . "." . $file_extension;
        
                        $response['test'] = $tempname . " || " . $folder;
        
                        if (move_uploaded_file($tempname, $folder)) {
                            // Update the database with the new file name
                            $updateQuery = "UPDATE `admins` SET `image`=? WHERE `id`=?";
                            $stmt = mysqli_prepare($conn, $updateQuery);
                            $updatedFileName = $newName . "." . $file_extension;
                            mysqli_stmt_bind_param($stmt, "ss",$updatedFileName, $id );
        
                            if (mysqli_stmt_execute($stmt)) {
                                $response['status'] = "success";
                                $response['message'] = "Successfully Updated.";
                            } else {
                                $response['status'] = "Error1";
                                $response['message'] = "Error updating database.";
                            }
                        } else {
                            $response['status'] = "Error2";
                            $response['message'] = "Something went wrong!";
                        }
                    } else {
                        $response['status'] = "Error3";
                        $response['message'] = "Something went wrong!";
                    }
                } else {
                    $response['status'] = "Error4";
                    $response['message'] = "Something went wrong!";
                }
            } else {
                $response['status'] = "Error";
                $response['message'] = "Invalid request method or file not provided.";
            }

            }else if($row9['role'] == 'teacher'){
                if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {

                    $filename = $_FILES["file"]["name"];
                    $tempname = $_FILES["file"]["tmp_name"];
                    $file_mime_type = mime_content_type($tempname);
                    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
            
                    // Allowed MIME types
                    $allowed_mime_types = ['image/jpeg', 'image/jpg', 'image/png'];
            
                    if (!in_array($file_mime_type, $allowed_mime_types)) {
                        $response['status'] = "Error0";
                        $response['message'] = "Invalid file type. Only JPEG, JPG, and PNG are allowed.";
                        echo json_encode($response);
                        exit();
                    }
            
                    $query = "SELECT `image` FROM `teachers` WHERE `teachers`.`id`=?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "s", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
            
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
            
                        $currentFilePath = ".." . DIRECTORY_SEPARATOR . "teacherUploads" . DIRECTORY_SEPARATOR . $row['image'];
            
                        $deleted = false;
                        $newName = $id . time();
            
                        if (!file_exists($currentFilePath)) {
                            $deleted = true;
                        } else {
                            // $newName = pathinfo($row['image'], PATHINFO_FILENAME);
                            $response['test'] = $newName . " " . $currentFilePath;
                            if (file_exists($currentFilePath)) {
                                if (unlink($currentFilePath)) {
                                    $deleted = true;
                                } else {
                                    $deleted = false;
                                }
                            }
                        }
            
                        if ($deleted) {
                            $folder = ".." . DIRECTORY_SEPARATOR . "teacherUploads" . DIRECTORY_SEPARATOR  . $newName . "." . $file_extension;
            
                            $response['test'] = $tempname . " || " . $folder;
            
                            if (move_uploaded_file($tempname, $folder)) {
                                // Update the database with the new file name
                                $updateQuery = "UPDATE `teachers` SET `image`=? WHERE `id`=?";
                                $stmt = mysqli_prepare($conn, $updateQuery);
                                $updatedFileName = $newName . "." . $file_extension;
                                mysqli_stmt_bind_param($stmt, "ss",$updatedFileName, $id );
            
                                if (mysqli_stmt_execute($stmt)) {
                                    $response['status'] = "success";
                                    $response['message'] = "Successfully Updated.";
                                } else {
                                    $response['status'] = "Error1";
                                    $response['message'] = "Error updating database.";
                                }
                            } else {
                                $response['status'] = "Error2";
                                $response['message'] = "Something went wrong!";
                            }
                        } else {
                            $response['status'] = "Error3";
                            $response['message'] = "Something went wrong!";
                        }
                    } else {
                        $response['status'] = "Error4";
                        $response['message'] = "Something went wrong!";
                    }
                } else {
                    $response['status'] = "Error";
                    $response['message'] = "Invalid request method or file not provided.";
                }
           }else{
                
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {

                $filename = $_FILES["file"]["name"];
                $tempname = $_FILES["file"]["tmp_name"];
                $file_mime_type = mime_content_type($tempname);
                $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        
                // Allowed MIME types
                $allowed_mime_types = ['image/jpeg', 'image/jpg', 'image/png'];
        
                if (!in_array($file_mime_type, $allowed_mime_types)) {
                    $response['status'] = "Error0";
                    $response['message'] = "Invalid file type. Only JPEG, JPG, and PNG are allowed.";
                    echo json_encode($response);
                    exit();
                }
        
                $query = "SELECT `image` FROM `students` WHERE `students`.`id`=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
        
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
        
                    $currentFilePath = ".." . DIRECTORY_SEPARATOR . "studentUploads" . DIRECTORY_SEPARATOR . $row['image'];
        
                    $deleted = false;
                    $newName = $id . time();
        
                    if (strtolower($row['image']) === strtolower("1701517055user.png")) {
                        $deleted = true;
                    } else {
                        // $newName = pathinfo($row['image'], PATHINFO_FILENAME);
                        $response['test'] = $newName . " " . $currentFilePath;
                        if (file_exists($currentFilePath)) {
                            if (unlink($currentFilePath)) {
                                $deleted = true;
                            } else {
                                $deleted = false;
                            }
                        }
                    }
        
                    if ($deleted) {
                        $folder = ".." . DIRECTORY_SEPARATOR . "studentUploads" . DIRECTORY_SEPARATOR  . $newName . "." . $file_extension;
        
                        $response['test'] = $tempname . " || " . $folder;
        
                        if (move_uploaded_file($tempname, $folder)) {
                            // Update the database with the new file name
                            $updateQuery = "UPDATE `students` SET `image`=? WHERE `id`=?";
                            $stmt = mysqli_prepare($conn, $updateQuery);
                            $updatedFileName = $newName . "." . $file_extension;
                            mysqli_stmt_bind_param($stmt, "ss",$updatedFileName, $id );
        
                            if (mysqli_stmt_execute($stmt)) {
                                $response['status'] = "success";
                                $response['message'] = "Successfully Updated.";
                            } else {
                                $response['status'] = "Error1";
                                $response['message'] = "Error updating database.";
                            }
                        } else {
                            $response['status'] = "Error2";
                            $response['message'] = "Something went wrong!";
                        }
                    } else {
                        $response['status'] = "Error3";
                        $response['message'] = "Something went wrong!";
                    }
                } else {
                    $response['status'] = "Error4";
                    $response['message'] = "Something went wrong!";
                }
            } else {
                $response['status'] = "Error";
                $response['message'] = "Invalid request method or file not provided.";
            }
       
           }

    
            
        }else{
            $response['status'] = "Error";
            $response['message'] = "Something went wrong!";
        }

   
} else {
    $response['status'] = "Error";
    $response['message'] = "Something went wrong!";
}

echo json_encode($response);
?>
