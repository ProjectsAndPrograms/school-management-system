<?php
include("config.php");
session_start();
$theme = "light";

if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];

    // Using prepared statement
    $query = "SELECT theme FROM users WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "s", $uid);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result
    mysqli_stmt_bind_result($stmt, $themeResult);
    mysqli_stmt_fetch($stmt);

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Update theme variable
    if ($themeResult !== null) {
        $theme = $themeResult;
    }
}

echo $theme;
?>
