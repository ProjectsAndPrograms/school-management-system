<?php include("../assets/noSessionRedirect.php"); ?>

<?php include("./verifyRoleRedirect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <style type="text/css">
        .container main .subjects .eg #piechart {
            width: 600px;
            height: 350px;
            padding-right: 0%;
            position: relative;
            border-radius: 20px;
        }

        .container main .subjects .eg {
            border-radius: 20px;
        }

        @media screen and (max-width: 700px) {
            .container main .subjects .eg #piechart {
                width: 250px;
                height: 200px;
                padding-left: 0%;
                padding-right: 0%;
                
            }
            .container main .subjects{
                margin-left: 4%;
            }
            .leaves{
                width: 106%;
                /*margin-left: 5%;*/
                font-size: 10px;
                padding-right: 0;
            }

        }

        #myInput {
            background-image: url('search.svg');
            /* Add a search icon to input */
            background-position: 5px 2px;
            /* Position the search icon */
            background-repeat: no-repeat;
            /* Do not repeat the icon image */
            width: 80%;
            /* Full-width */
            font-size: 16px;
            /* Increase font-size */
            padding: 12px 20px 12px 40px;
            /* Add some padding */
            border: 1px solid #ddd;
            /* Add a grey border */
            margin-bottom: 12px;
            /* Add some space below the input */
            border-radius: 40px;
            position: relative;
        }

        #myTable {
            width: 80%;
            /* Full-width */
            border: 1px solid #ddd;
            /* Add a grey border */
            font-size: 15px;
            /* Increase font-size */
            border-radius: 40px;
            position: relative;
        }

        #myTable th {
            background-color: #A9A9A9;
            color: white;
        }

        #myTable th,
        #myTable td {
            text-align: center;
            /* Left-align text */
            padding: 12px;
            /* Add padding */
            border-radius: 16px;
        }


        #myTable tr {
            /* Add a bottom border to all table rows */
            border-bottom: 1px solid #ddd;
            border-radius: 40px;
            text-align: center;
        }

        #myTable tr.header,
        #myTable tr:hover {
            /* Add a grey background color to the table header and on hover */
            background-color: #f1f1f1;
        }

        @media only screen and (max-width: 768px) {
            #myTable {
                width: 95%;
                margin: 0%;
                font-size: 12.5px;
            }

            #myInput {
                width: 95%;
                margin: 0%;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo" title="University Management System">
            <img src="./images/logo.png" alt="">
            <h2>E<span class="danger">R</span>P</h2>
        </div>
        <div class="navbar">
        <a href="index.php">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <a href="timetable.php" onclick="timeTableAll()">
                <span class="material-icons-sharp">today</span>
                <h3>Time Table</h3>
            </a>
            <a href="exam.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Examination</h3>
            </a>
            <a href="workspace.php">
                <span class="material-icons-sharp">description</span>
                <h3>Workspace</h3>
            </a>
            <a href="password.php">
                <span class="material-icons-sharp">password</span>
                <h3>Change Password</h3>
            </a>
            <a href="logout.php">
                <span class="material-icons-sharp" onclick="">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
        <div id="profile-btn">
            <span class="material-icons-sharp">person</span>
        </div>
        <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>

    </header>
    <div class="container">
        <aside>
            <div class="profile">
                <div class="top">
                    <?php

                    $id = $_SESSION['uid'];
                    $query_sql = "SELECT * FROM students WHERE id='$id'";
                    $result = mysqli_query($conn, $query_sql);
                    $row = $result->fetch_assoc();
                    echo "<div class='profile-photo'>
                        <img src='../studentUploads/" . $row['image'] . "'>
                    </div>";
                    ?>

                    <div class="info">
                        <?php
                        session_start();
                        $id = $_SESSION['uid'];
                        $query = "select * from students where id='$id'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                            <p>Hey, <b>" . $row["fname"] . "</b> </p>
                        <small class='text-muted'><b>ID&nbsp;:&nbsp;</b>" . $row["id"] . "</small>";
                            }
                        }
                        ?>

                    </div>
                </div>
                <div class="about">
                    <?php
                    $query = "select * from students where id='$id'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p><h5>Class : " . $row["class"] . "</h5></p>
                    <p>Section " . $row["section"] . "</p>
                    <h5>DOB</h5>
                    <p>" . $row["dob"] . "</p>
                    <h5>Contact</h5>
                    <p>" . $row["phone"] . "</p>
                    <h5>Email</h5>
                    <p>" . $row["email"] . "</p>
                    <h5>Address</h5>
                    <p>" . $row["address"] . "</p>";
                        }
                    }

                    ?><br>
                    <b><a href="buspanel.php">Bus Panel</a></b><br><br>
                     <br>
                    <b><a href="fee-payment.php">Pay-Fee</a></b>
                </div>
            </div>
        </aside>

        <main>
            <h1>Attendance</h1>
            <div class="subjects">
                <div class="eg">
                    <div id="piechart"></div>

                </div>
            </div>


            <div class="leaves " style="margin-top: 20px;">
                <h2>Syllabus</h2>
                <?php
                $id = $_SESSION['uid'];
                $query_sql = "SELECT * FROM students WHERE id='$id'";
                $result = mysqli_query($conn, $query_sql);
                $row = $result->fetch_assoc();
                $class = $row['class'];

                $sql2 = "SELECT * FROM syllabus WHERE class='$class'";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        echo "<div class='teacher'>
                    <div class='profile-photo'>
                    <a href='../syllabusUploads/" . $row2['file'] . "'>
                    <img src='./images/profile-2.png' alt=''></div>
                    <div class='info'>
                        <h3>" . $row2['subject'] . "</h3>
                        <small class='text-muted'>Download or View</small>
                        </a>
                    </div>
                </div>";
                    }
                } else {
                    echo '<p style="padding-left: 20px;margin-top: 10px;">Syllabus not uploaded yet!</p>';
                }
                ?>


            </div>
            <div class="timetable" id="timetable">
                <h2>Monthly Attendance</h2>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Date...">

                <table id="myTable">
                    <tr class="header">
                        <th style="width:60%;">Date</th>
                        <th style="width:40%;">Attendence</th>
                    </tr>
                    <tbody id="attendence_table">

                    </tbody>
                </table>
                <br><br>
            </div>
        </main>

        <div class="right">
            <div class="announcements">
                <h2>Notice</h2>
                <div class="updates">
                    <div class="message">
                        <?php
$id = $_SESSION['uid'];
$query_sql2 = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn, $query_sql2);
$row = $result->fetch_assoc();
$class = $row['class'];

$sql_query = "SELECT * FROM notice WHERE (role = 'student' AND class='$class') OR (role = 'all' OR role='') ORDER BY s_no DESC LIMIT 3";
$result = mysqli_query($conn, $sql_query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p> <b>" . $row['title'] . "</b> <br>" . $row['body'] . "<br></p>";
        if ($row['file'] != null) {
            echo "<a href='../noticeUploads/" . $row['file'] . "'><img src='file.svg' height='30px' width='30px'><p style='color:red;'>View Notice</p></a>";
        }
        echo "<small class='text-muted'><b>" . $row['timestamp'] . "</b></small><hr><br>";
    }
}
?>



                    </div>

                </div>
            </div>

            <div class="leaves">
                <h2>Feedbacks</h2>
                <?php
                $id = $_SESSION['uid'];

                $sql2 = "SELECT * FROM `feedback` WHERE `receiver_id`='$id' LIMIT 5";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $timestamp = $row2['timestamp'];
                        $formattedDate = date('d M, Y', strtotime($timestamp));

                        $senderId = $row2['sender_id'];
                        $tableName = ($senderId >= 1000) ? 'admins' : 'teachers'; 
                        $sql = "SELECT `fname`, `lname` FROM `$tableName` WHERE id = '$senderId' LIMIT 1";

                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $sender = ucfirst(strtolower($row['fname'])) . " " . strtolower($row['lname']);
                        } else {
                            $sender = "REMOVED";
                        }

                        echo "<div class='teacher'>
                            <div class='info' style='width: 100%;'>
                                <p class='text-muted para-text'>
                                <i class='bx bxs-chat' ></i>
                                " . $row2['msg'] . "</p>
                                <div class='flexbox' style='margin-top: 8px;'>
                                    <small>" . $formattedDate . "</small>
                                    <small style='margin-left: auto;'>" .  $sender . "</small>
                                </div>
                            </div>
                        </div>";
                    }
                }else{
                    echo "<div class='teacher'>
                    <div class='info' style='width: 100%;'>
                        <p class='text-muted para-text'>
                        <i class='bx bxs-chat' ></i>
                       No Feedbacks</p>
                       
                    </div>
                </div>";
                }
                ?>


            </div>

        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        let presentPer = 30;
        let absentPer = 70;


        document.addEventListener("DOMContentLoaded", function() {
            fetch("fetchAttendencePercentage.php", {
                    method: "POST",
                })
                .then(response => response.json())
                .then(data => {


                    if (data['status'] === "success") {
                        presentPer = parseFloat(data['present']);
                        absentPer = parseFloat(data['absent']);



                        google.charts.load("current", {
                            packages: ["corechart"]
                        });
                        google.charts.setOnLoadCallback(drawChart);

                    } else {
                        alert("Something went wrong!");
                    }
                })
                .catch(error => {
                    console.error("error" + error)
                })
        });


        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Attandence', 'percentage'],
                ['preset', presentPer],
                ['Absent', absentPer],
            ]);

            var options = {
                legend: 'none',
                pieSliceText: 'label',
                title: 'Student Attendence All time',
                pieStartAngle: 100,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>


    <script type="text/javascript" src="app.js"></script>
    <!-- <script type="text/javascript" src="timeTable.js"></script> -->
    <script type="text/javascript" src="index.js"></script>
</body>

</html>