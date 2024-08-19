<?php
include('../assets/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP - Buses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .bus-icon {
            height: 40px;
            width: 40px;
            border: 1px solid grey;
            margin-top: 15px;
            margin-left: 10px;
            border-radius: 50%;
            background-image: url('images/bus-icon.png');
            background-position: center;
            background-size: cover;
        }
        .pending{
            margin-left: 30%;
        }
        #pen{
            background-size: cover;
            background-position: center;
        }
       @media only screen and (max-width: 700px) {
    #pen {
        height: 200px; /* Added 'px' to the height value */
        width: 350px;
        margin-left: -60%;
    }
}

        
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SCHOOL MANAGEMENT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4 border-0 p-3 shadow border-0">
        <?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];


// Prepare and execute SQL query
$query = "SELECT * FROM students WHERE id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row2 = mysqli_fetch_assoc($result);
    
    if ($row2["request"] == "") {
        echo '<button type="button" data-uid="' . $uid . '" id="request" class="btn btn-primary" data-mdb-ripple-init>
        <i class="fas fa-paper-plane me-2"></i> Request For Bus
      </button>';

} else if ($row2["request"] == "accepted") {
        $sql = "SELECT * FROM buses";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='container shadow border-0' style='margin: 0; width: 100%; margin-bottom: 20px; border-left: 4px solid #54cb54 !important;'>
                <a href='buslocation.php?bus_id={$row['bus_id']}' class='text-decoration-none text-dark'>
                        <div class='d-flex align-items-center'>
                            <div class='bus-icon'></div>
                            <div class='ms-3'>
                                <h5 style='font-size: 15px; padding: 10px;'>Bus No: {$row['bus_number']} <br>Title: {$row['bus_title']}</h5>
                            </div>
                        </div>
                      </a>
                      </div>";
            }
        } else {
            echo "<center>No Buses found</center>";
        }
    } else {
        echo "<div class='pending'>
         <img src='images/pending.gif' id='pen'>
        </div>";
    }
} else {
    echo "Student not found";
}

// Close the database connection
mysqli_close($conn);
?>

    </div>

</body>

<script type="text/javascript">
  document.getElementById("request").addEventListener("click", function(event) {
    var result = window.confirm("Do you really want to apply for bus service?");
    if (result) {
        var id = event.target.getAttribute("data-uid");
        
        var requestData = {
            id: id
        };

        fetch("fetch-data/send-request.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(requestData)
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response data here
            console.log(data);
            window.location.reload();
        })
        .catch(error => {
            // Handle any errors here
            console.error("Error:", error);
        });
    }
});

</script>

</html>
