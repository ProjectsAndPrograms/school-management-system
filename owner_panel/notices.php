<?php
include("../assets/noSessionRedirect.php"); 
include('./fetch-data/verfyRoleRedirect.php');

error_reporting(0);
?>
  <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../images/1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>ERP</title>
    <style type="text/css">
  .text-muted{
    margin-left: 2%;
    margin-bottom: 2%;
  }
 .card{
  margin-left: 10%;
  margin-right: 10%;
  margin-top: 3%;
 }
#Download{
   height: 50px;
   width: 150px;
   background-color: lightblue;
   color: black;
   border: none;
   border-radius: 10px;
}
 .notice-send{
  margin-left: 10%;
  margin-top: 2%;
 }
 #class{
  margin-top: 3%;
 }
 .form-label{
  margin-top: 3%;
 }
 #delete{
  background-color: white;
  margin-left: 90%;
  border: none;
 }
#sends{
        width: 90%;
        margin-top: 2%;
        background-color: green;
        border-color: none;
    }
/*#else{*/
/*        margin-top: 15%;*/
/*    }*/
.nothing{
    height: 10%;
    width: 15%;
    margin-left: 37%;
    margin-top: 5%;
    
}
.nothing img{
    background-size: cover;
    background-position: center;
    height: 400px;
    width: 400px;
}
@media only screen and (max-width: 700px) {
    #time {
        margin-left: 5%;
        font-size: 10px;
    }
    .to{
        font-size: 15px;
    }
    .card-title{
        font-size: 18px;
    }
    #else{
        margin-top: 15%;
    }
    #sends{
        width: 90%;
        margin-top: 4%;
    }
    .nothing{
    height: 10%;
    width: 15%;
    margin-left: 10%;
    
}
.nothing img{
    background-size: cover;
    background-position: center;
    height: 300px;
    width: 300px;
}

}


    </style>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">SCHOOL MANAGEMENT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Notice</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Fee Pay
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="make-payment.php">Make Payment</a></li>
            <li><a class="dropdown-item" href="see-payment.php">See Payment</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="change-password.php">Change-Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="form-select" aria-label="Default select example" id="select" required>
             <option value="none" selected>Open this select menu</option>
             <option value="student">Students</option>
             <option value="teacher">Teacher</option>
             <option value="admin">Admin</option>
             <option value="all">All</option>
          </select>
          <select class="form-select" aria-label="Default select example" id="class" required>
             <option selected>----SELECT CLASS----</option>
             <option value="12m">12 (Math)</option>
<option value="12b">12 (Bio)</option>
<option value="12c">12 (Commerce)</option>
<option value="11m">11 (Math)</option>
<option value="11b">11 (Bio)</option>
<option value="11c">11 (Commerce)</option>
<option value="10">10</option>
<option value="9">9</option>
<option value="8">8</option>
<option value="7">7</option>
<option value="6">6</option>
<option value="5">5</option>
<option value="4">4</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
<option value="pg">pg</option>
<option value="lkg">lkg</option>
<option value="ukg">ukg</option>
          </select>
         <label for="exampleDatepicker1" class="form-label">Title</label>
          <input type="text" class="form-control" id="title"  required />

          <div class="form-outline">
        <label class="form-label" for="textAreaExample">Message</label>
      <textarea class="form-control" id="message" required></textarea>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="send">Send </button>
      </div>
    </div>
  </div>
</div>
      <div class="notice-send">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="sends">
  Send Notice <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="color: white;">
  <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
</svg>

</button>        
      </div>


<?php 
$sql_query = "SELECT * FROM notice ORDER BY s_no DESC";
$result = mysqli_query($conn, $sql_query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Sanitize output
        $title = htmlspecialchars($row['title']);
        $body = htmlspecialchars($row['body']);
        $role = htmlspecialchars($row['role']);
        $class = htmlspecialchars($row['class']);

        if($role==''){
            $role='All';
        }
        
        echo "<div class='card'>
                <div class='card-header'>
                  Notice
                </div>
                <div class='card-body'>
                  <h5 class='card-title'>Title: $title </h5>
                  <h5 class='to'>To : $role"; 
        if($role=='student'){
            echo "s of  class $class";
        } 
        else{
            echo "s";
        }
        echo "</h5>
                  <p class='card-text'>Body: $body</p>";
        if ($row['file'] != "") {
            // Validate file path
            $file_path = '../noticeUploads/' . $row['file'];
            if (file_exists($file_path)) {
                echo "<a href='$file_path' download class='btn btn-primary'>Download</a>";
            } else {
                echo "<span class='text-danger'>File not found</span>";
            }
        }
        echo "<button type='button' class='btn btn-danger delete' data-id='".$row['s_no']."' id='delete'><img src='img/trash.svg' id='icon'></button>
                </div>
                <small class='text-muted' id='time'><b>".$row['timestamp']."</b></small>
              </div>";                               
    }
} else {
    echo "
    <div class='nothing'><img src='img/thumb.gif'></div>
    <center id='else'>No notices found</center>";
}
?>


    
  </body>
  <script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete').forEach(function(button) {
        button.addEventListener('click', function() {
            var result = window.confirm("Are you sure you want to delete this notice?");
            if (result) {
                var noticeId = button.getAttribute('data-id');
                fetch('fetch-data/notice-delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'noticeId=' + encodeURIComponent(noticeId)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log(data);
                    location.reload();
                    // Handle success response here if needed
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            } else {
                console.log("Not deleted");
            }
        });
    });
});

  </script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var classElement = document.getElementById('class');
        classElement.style.display = 'none';

        function handlePanelChange() {
            var panel = document.getElementById('select').value;
            if (panel === 'student') {
                classElement.style.display = 'block';
            } else {
                classElement.style.display = 'none';
            }
        }

        document.getElementById('select').addEventListener('change', handlePanelChange);

        document.getElementById('send').addEventListener('click', function() {
            var panel = document.getElementById('select').value;
            var cla = document.getElementById('class').value;
            var title = document.getElementById('title').value;
            var message = document.getElementById('message').value;

            fetch('fetch-data/send-notice.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'panel=' + encodeURIComponent(panel) +
                    '&cla=' + encodeURIComponent(cla) +
                    '&title=' + encodeURIComponent(title) +
                    '&message=' + encodeURIComponent(message),
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(function(data) {
                alert('notice send successfully');
                location.reload();
                // You can add more handling here, such as displaying a success message
            })
            .catch(function(error) {
                console.error('There was a problem with the fetch operation:', error);
                // You can add more error handling here
            });
        });
    });
</script>


  </html>