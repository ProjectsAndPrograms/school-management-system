<?php
include("config.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students where request = 'pending'";
$result = mysqli_query($conn, $sql);

if ($result) {
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="alert alert-primary" role="alert">
                    '.$row["fname"].' '.$row["lname"].' Class '.$row["class"].' section '.$row["section"].'  <br>
                    <a href="partials/Accept-request.php?id='.$row['id'].'" class="alert-link">
                        <button type="button" class="btn btn-success">
                            Accept Request
                        </button>
                    </a>
                       Requested   <br>
                       '.$row["request_date"].' '.$row["request_time"].'
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
