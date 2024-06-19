<?php include("../assets/noSessionRedirect.php"); ?>

<?php include("./verifyRoleRedirect.php");
$id = $_SESSION['uid'];
// error_reporting(1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../images/1.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>

    <style>
        body {
            overflow: hidden;
        }

        header {
            position: relative;
        }

        .cursor-pointer{
            cursor: pointer;
        }
        

        .exam {
            display: flex;
            align-items: center;
            /* justify-content: center; */
            flex-direction: column;
            height: 80vh;
            width: 80%;
            margin: auto;
        }

        #gfg {
            background-image: url('search.svg');
            /* Add a search icon to input */
            background-position: 5px 2px;
            /* Position the search icon */
            background-repeat: no-repeat;
            /* Do not repeat the icon image */
            width: 90%;
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

        @media only screen and (max-width: 768px) {
            #gfg {
                width: 100%;
                margin: 0%;
            }
        }
        .subjective-result-btn{
            padding: 5px 15px;
            background-color: #c9eff6;
            cursor: pointer;
        }
        .dark-theme .subjective-result-btn{
            color: black;
        }

        .exam {
            height: fit-content;
        }

        .vertical-elements {
            display: flex;
            flex-direction: column;
        }

        table {
            margin-bottom: 3rem;
        }


        .hide {
            display: none !important;
        }


        body {
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }

        body::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }
    </style>
</head>

<body style="overflow-y: scroll;">
    <header>
        <div class="logo">
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
            <a href="exam.php" class="active">
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
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
        <div id="profile-btn" style="display: none;">
            <span class="material-icons-sharp">person</span>
        </div>
        <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>
    </header>

    <main>
        <div class="exam timetable">
            <h2>Exam Result </h2>
            <h2><?php echo "<a href='progress.php'>Progress Report</a>"; ?></h2>


            <table class="allResultTable" id="allResultList">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Subject</th>
                        <th>Title</th>
                        <th>Obtain Marks</th>
                        <th>Total Marks</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <input id="gfg" class="marks-table-search-box" type="text" placeholder="Search for Title ,Date ,Subjects or Grade">
                <tbody id="geeks">
                    <?php

                    $query2 = "SELECT DISTINCT(`exam_id`) FROM `marks` WHERE `student_id` = ? ORDER BY `s_no`  DESC LIMIT 50";
                    $stmt2 = $conn->prepare($query2);
                    $stmt2->bind_param("s", $id);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();

                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $examId = $row2['exam_id'];

                            $query3 = "SELECT * FROM `exams` WHERE `exam_id` = ?";
                            $stmt3 = $conn->prepare($query3);
                            $stmt3->bind_param("s", $examId);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();
                            $row3 = $result3->fetch_assoc();

                            $dateDB = $row3['timestamp'];
                            $formattedDate = date("d-m-Y", strtotime($dateDB));

                            $status = "";

                            if ($row3['subject'] == "ALL") {
                                $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ?";
                                $stmt4 = $conn->prepare($sql);
                                $stmt4->bind_param("ss", $row3['exam_id'], $id);
                                $stmt4->execute();
                                $marksResult = $stmt4->get_result();

                                $totalGainMarks = 0;
                                $subjectCount = 0;
                                $isFail = false;
                                while ($tempRow = $marksResult->fetch_assoc()) {
                                    $totalGainMarks += (int)$tempRow['marks'];
                                    $subjectCount++;

                                    if ((int)$tempRow['marks'] < (int)$row3['passing_marks']) {
                                        $isFail = true;
                                    }
                                }

                                $status = $isFail ? "<td style='color:red;text-align:center;'>Fail</td>" : "<td style='color:green;text-align:center;'>Pass</td>";

                                echo " <td>$formattedDate</td>
                                        <td><a class='no-submit subjective-result-btn cursor-pointer' id='hit' onClick='handleShowAllSubjectMarks(`" . $row3['exam_id'] . "`)'>" . $row3['subject'] . "</a></td>
                                        <td>" . $row3['exam_title'] . "</td>
                                        <td style='text-align:center;'>$totalGainMarks</td>
                                        <td style='text-align:center;'>". ($subjectCount * $row3['total_marks']) ."</td>
                                        $status
                                    </tr>";
                            } else {
                                $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ? AND `subject`=? LIMIT 1";
                                $stmt4 = $conn->prepare($sql);
                                $stmt4->bind_param("sss", $row3['exam_id'], $id, $row3['subject']);
                                $stmt4->execute();
                                $marksResult = $stmt4->get_result();
                                $marksResultRow = $marksResult->fetch_assoc();
                                $mark = $marksResultRow['marks'];

                                $status = ((int)$mark >= (int)$row3['passing_marks']) ? "<td style='color:green;text-align:center;'>Pass</td>" : "<td style='color:red;text-align:center;'>Fail</td>";

                                echo "
                                    <td>$formattedDate</td> 
                                    <td>" . $row3['subject'] . "</td>
                                    <td>" . $row3['exam_title'] . "</td>
                                    <td style='text-align:center;'>$mark</td>
                                    <td style='text-align:center;'>" . $row3['total_marks'] . "</td>
                                    $status
                                </tr>";
                            }

                            $stmt3->close();
                            if (isset($stmt4)) {
                                $stmt4->close();
                            }
                        }
                    }else{
                        echo '<td colspan="6" style="text-align:center;padding-top: 3rem;">No Data</td>';
                    }

                    $stmt2->close();
                  
                    ?>
                </tbody>
            </table>

            <div class="vertical-elements" id="subjectiveResultTable">

            </div>

            <script>
                $(document).ready(function() {
                    $("#gfg").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#geeks tr").filter(function() {
                            $(this).toggle($(this).text()
                                .toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>

        </div>
    </main>


</body>

<script src="app.js"></script>

</html>