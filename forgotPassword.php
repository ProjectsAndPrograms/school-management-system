<?php
error_reporting(0);
  session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include('assets/config.php');
    $response = array();


    $response['status'] = '';
    $response['message'] = '';

    if(isset($_POST['otp']) && isset($_POST['email'])){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $otp = mysqli_real_escape_string($conn, $_POST['otp']) . '';

        $generatedOtp = $_SESSION['otp'];

        if($otp == $generatedOtp){
            $response['status'] = 'success';
            $response['message'] = 'otp matched';
            unset($_SESSION['otp']);
        }else{
            $response['status'] = 'ERROR';
            $response['message'] = 'Invalid OTP! ';
        }
        

    }else if(isset($_POST['password']) && isset($_POST['email'])){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE `users` SET `password_hash` = ? WHERE `users`.`email` = ?;";
        $stmt2 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt2, "ss",$passwordHash, $email);

        $sql2 = "SELECT `id` FROM `users` WHERE `users`.`email`=?;";
        $stmt3 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt3, "s", $email);
        mysqli_stmt_execute($stmt3);
        $result = mysqli_stmt_get_result($stmt3);


        if(mysqli_stmt_execute($stmt2) && mysqli_num_rows($result) > 0){

            $row = mysqli_fetch_assoc($result);
            $_SESSION['uid'] = $row['id'];
            $response['status'] = 'update_success';
            $response['message'] = 'Password successfully updated';
        }else{
            $response['status'] = 'Error';
            $response['message'] = 'Unable to update password...!';
        }

        mysqli_stmt_close($stmt2);
    }
    else if(isset($_POST['email'])){

        $email = mysqli_real_escape_string($conn, $_POST['email']);

        function domain_exists($email, $record = 'MX'){
            list($user, $domain) = explode('@', $email);
            return checkdnsrr($domain, $record);
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) && domain_exists($email)) {  

            $query = "SELECT * FROM `users` WHERE `email`=?;";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0){
                $response['status'] = 'success';

                $OTP = generateOTP();
                $mail = getEmailObject($email, $OTP);

                try {
                    $mail->send();
                    $response['status'] = 'success';
                    $response['email'] = $email . '';
                    $_SESSION['otp'] = $OTP . "";
                } catch (Exception $e) {
                    $response['status'] = 'ERROR';
                    $response['message'] = 'Something went wrong!';
                }

              
            }else{
                $response['status'] = 'ERROR';
                $response['message'] = 'Email not found!';
            }
            mysqli_stmt_close($stmt);
          } else {
            $response['status'] = 'ERROR';
            $response['message'] = 'Invalid email!';
          }
    }else{
        $response['status'] = 'ERROR';
        $response['message'] = 'Somehing went wrong!';
    }

    echo json_encode($response);

function generateOTP(){
    return rand(100000, 999999);
}

function getEmailObject($reciever, $otp){
    
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    
    
    $title = 'OTP Verification email';
    $message = '<h3>OTP Verification email</h3><p>Your one time password is <b>'.$otp.'</b>. Stay connected with Us.</p><p>This email is computer generated so please do not reply this email.</p>';
    
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'erp.schoolmanagementsystem@gmail.com';
    $mail->Password = 'whqbysomdhdjthvr'; 
    $mail->SMTPSecure = 'tls';  
    $mail->Port = 587;
    
    $mail->setFrom('erp.schoolmanagementsystem@gmail.com');
    $mail->addAddress(''.$reciever);
  
    $mail->isHTML(true);
    
    $mail->Subject = $title;
    $mail->Body = $message;

    return $mail;
}
?>



