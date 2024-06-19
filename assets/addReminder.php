<?php
if (isset($_POST["msg"])) {
    session_start();
    include("config.php");

    $msg = $_POST["msg"];
    $uid = $_SESSION['uid'];

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO `reminders` (`id`, `message`, `status`) VALUES (?, ?, 'pending')";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $uid, $msg);

        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Something went wrong while inserting!";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement!";
    }
} else {
    echo "Message is empty";
}
?>
