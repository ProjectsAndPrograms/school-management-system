<?php
session_start();

// Set session timeout duration (1 hour)
$timeout_duration = 3600;

// Check if the user is logged in and if the session has timed out
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
  // Last request was more than $timeout_duration seconds ago
  session_unset();     // Unset $_SESSION variable for the run-time
  session_destroy();   // Destroy session data in storage

  // show alert message and redirect to login page

  echo "<script>alert('Session Expired! Please login again.')</script>";

  echo "<script>window.location.href = '../login.php';</script>";

  exit();
}

// Notify user that session will expire in 10 seconds due to inactivity
echo "<script>
  setTimeout(function() {
    alert('Due to inactivity, your session will expire in 10 seconds.');
  }, ($timeout_duration - 10) * 1000);
</script>";

// Update last activity time stamp
$_SESSION['LAST_ACTIVITY'] = time();

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
  // Redirect to login page or handle unauthorized access
  header("Location: ../login.php");
  exit();
}

?>