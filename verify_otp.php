<?php
session_start();
error_reporting(0);

$response = array();
$response['status'] = '';
$response['message'] = '';

if (isset($_POST['otp']) && isset($_POST['email'])) {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Retrieve OTP from session
    $generatedOtp = isset($_SESSION['otp']) ? $_SESSION['otp'] : null;
    $otpExpiration = isset($_SESSION['otp_expiration']) ? $_SESSION['otp_expiration'] : null;

    // Check if OTP is set and not expired
    if ($generatedOtp && $otpExpiration && time() <= $otpExpiration) {
        // Verify OTP
        if ($otp == $generatedOtp) {
            $response['status'] = 'success';
            $response['message'] = 'OTP verified successfully!';
            $response['redirect_url'] = 'student_panel/index.php'; // Replace with your target page
            unset($_SESSION['otp']); // Clear OTP from session after successful verification
            unset($_SESSION['otp_expiration']);
            

        } else {
            $response['status'] = 'ERROR';
            $response['message'] = 'Invalid OTP!';
        }
    } else {
        $response['status'] = 'ERROR';
        $response['message'] = 'OTP expired or not found. Please request a new OTP.';
    }
} else {
    $response['status'] = 'ERROR';
    $response['message'] = 'OTP and email are required.';
}

echo json_encode($response);
?>
