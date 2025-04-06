<?php
session_start();
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('assets/config.php');
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$response = array();
$response['status'] = '';
$response['message'] = '';

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Function to check if the email domain exists
    function domain_exists($email, $record = 'MX'){
        list($user, $domain) = explode('@', $email);
        return checkdnsrr($domain, $record);
    }

    // Validate email format and domain
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && domain_exists($email)) {
        // Check if the email exists in the database
        $query = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Email exists, generate OTP and send it
            $OTP = generateOTP();
            $_SESSION['otp'] = $OTP;
            $_SESSION['otp_expiration'] = time() + 300; // OTP valid for 5 minutes

            // Send OTP via email
            $mail = getEmailObject($email, $OTP);

            try {
                $mail->send();
                $response['status'] = 'success';
                $response['message'] = 'OTP sent successfully!';
                $response['email'] = $email;
            } catch (Exception $e) {
                $response['status'] = 'ERROR';
                $response['message'] = 'Failed to send OTP. Please try again later.';
            }
        } else {
            // Email not found in the database
            $response['status'] = 'ERROR';
            $response['message'] = 'Email not found!';
        }
        mysqli_stmt_close($stmt);
    } else {
        $response['status'] = 'ERROR';
        $response['message'] = 'Invalid email!';
    }
} else {
    $response['status'] = 'ERROR';
    $response['message'] = 'Email is required!';
}

// Output the response in JSON format
echo json_encode($response);

// Function to generate a 6-digit OTP
function generateOTP() {
    return rand(100000, 999999);
}

// Function to configure PHPMailer and create an email object
function getEmailObject($receiver, $otp) {
    $mail = new PHPMailer(true);
    
    // Email content
    $title = 'OTP Verification Email';
    $message = '<h3>OTP Verification</h3><p>Your one-time password is <b>' . $otp . '</b>. This OTP is valid for 5 minutes.</p><p>This email is computer-generated, please do not reply.</p>';

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'erp.schoolmanagementsystem@gmail.com';  // Your SMTP username
    $mail->Password = 'whqbysomdhdjthvr'; // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email configuration
    $mail->setFrom('erp.schoolmanagementsystem@gmail.com', 'Your App');
    $mail->addAddress($receiver);
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $message;

    return $mail;
}
?>
