<?php
include("config.php");

// Sanitize user input to prevent SQL injection
$input = mysqli_real_escape_string($conn, $_POST["val"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students WHERE request = 'Accepted' AND fname LIKE '{$input}%'";

$result = mysqli_query($conn, $sql);

if ($result) {
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="alert alert-primary" role="alert">
                    '.$row["fname"].' '.$row["lname"].' Class '.$row["class"].' section '.$row["section"].'  <br>
                       <b>Bus Request Accepted</b>
                </div>';
        }
    } else {
        echo "No pending requests.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
