
<?php include("../assets/noSessionRedirect.php"); ?>

<?php include("./verifyRoleRedirect.php"); ?>

<?php 

    // session_start();
    include('../assets/config.php');
 error_reporting(0);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="style.css">

    <style>
        body{overflow: hidden;}
        header{position: relative;}
        .exam{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 80vh;
            width: 80%;
            margin: auto;
        }
        .btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 10px;
  border-radius: 3px;
  text-decoration: none;
}





body {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */
}
body::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}

.btn a{
    color: white;
    font-size: 20px;
}
#myInput {
  background-image: url('search.svg'); /* Add a search icon to input */
  background-position: 5px 2px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 80%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
  margin-top: 30px;
  margin-left: 150px;
}

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 80%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 18px; /* Increase font-size */
  border: #bdc3c7 1px solid;
  margin-left: 150px;
}

#myTable th, #myTable td {
  text-align: left; /* Left-align text */
  padding: 10px; /* Add padding */
}

#myTable tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
}
#myTable th, #myTable td.theme-toggler {
  text-align: left; /* Left-align text */
  padding: 10px; /* Add padding */
  background-color: black;
  color: white;
}

#myTable tr.theme-toggler {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
  background-color: #363949;
}

 #myTable tr:hover{
    background-color: #779ca6;
 }
@media only screen and (max-width: 768px){
    #myTable {
        width: 100%;
        margin: 0%;
        font-size: 12px;
        flex: auto;
        position: absolute;
    }
    #myInput{
        width: 100%;
        margin: 0%;
    }
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
            <a href="exam.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Examination</h3>
            </a>
            <a href="workspace.php" class="active">
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
   <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Subject.">

<div class="scrollableBox" >
<table id="myTable" >
  <tr class="header">
    <th>Subject</th>
    <th>Title</th>
    <th>Downloads</th>
    <th>Date</th>
  </tr>
  <tr>
    <?php
        $id = $_SESSION['uid'];

        $sql  = "SELECT * FROM students WHERE id='$id'";
       $result2=mysqli_query($conn,$sql);
       $row=$result2->fetch_assoc();
       $class = $row['class'];

       $query="select * from notes where class='$class' order by s_no desc";
       $result=mysqli_query($conn,$query);
       if($result->num_rows>0){
        while($rows=$result->fetch_assoc()) {


            $dateDB = $rows['timestamp'];
           $formattedDate = date("d-m-Y", strtotime($dateDB));


            echo "<td>".$rows['subject']."</td>
    <td>".$rows['title']."</td>
    <td><button class='btn'><a href='../notesUploads/".$rows['file']."' download='".$rows['file']."'>Download</a></button></td>
    <td>".$formattedDate."</td>
    </tr>";
        }
       }
     
     ?>
   
</table> 
     </div>

<br><br><br>
    <!-- <script src="timeTable.js"></script> -->
    <script src="app.js"></script>
</body>
</html>