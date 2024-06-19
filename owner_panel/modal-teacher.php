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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>ERP</title>
    <style type="text/css">
         .card{
                
                position: absolute;
                margin-top: 5%;
         }
         .detail{
         	height: auto;
         	width: 100%;
         	display: flex;
         	justify-content: center;
         	flex-direction: row;

         }
         .card{
         	width: 40%;
         }
         @media (max-width: 700px){
         	.card{
         		width: 80%;
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
          <a class="nav-link" href="notices.php">Notice</a>
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
	<div class="detail" id="details">
    
<?php
  
  $data = "";

  $sql="SELECT * FROM teachers where id = '{$_GET['id']}'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $data .= "<div class='card'>
                    <img src='../teacherUploads/".$row['image']."' class='card-img-top' alt='profile image of teacher'/>
                    <div class='card-body'>
                        <h5 class='card-title'></h5>
                        <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class='list-group list-group-light list-group-small'>
                        <li class='list-group-item px-4'>Name: ".$row['fname']." ".$row['lname']."</li>
                        <li class='list-group-item px-4'>Email : ".$row['email']."</li>
                        <li class='list-group-item px-4'>Phone: ".$row['phone']."</li>
                        <li class='list-group-item px-4'>D-O-B: ".$row['dob']."</li>
                        <li class='list-group-item px-4'>Address: ".$row['address']."</li>
                        <li class='list-group-item px-4'>city: ".$row['city']."</li>
                        <li class='list-group-item px-4'>state: ".$row['gender']."</li>
                        <li class='list-group-item px-4'>Father Name: ".$row['father']."</li>
                    </ul>
                    <div class='card-body'>
                        <a href='teacher-list.php' class='card-link' style='text-decoration: none; background-color: black; padding: 10px; border-radius: 8px; color: white;'>Back</a>
                        <a href='index.php' class='card-link' style='text-decoration: none; background-color: brown; padding: 10px; border-radius: 8px; color: white; margin-left: 2%;'>Main Page</a>
                    </div>
                </div>";
    }
    echo $data;
  }
?>

</div>
<br><br>
</body>
</html>