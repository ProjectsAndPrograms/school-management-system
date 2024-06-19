<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
         .attendence{
           height: auto;
           width: 100%;
           margin-top: 5%;
           display: flex;
           justify-content: center;
           align-items: center;
           
         }
         #piechart{
             display: flex;
             flex-direction: column;
             height: 500px;
             width: 600px;
         }
         @media (max-width: 700px){
             #piechart{
                 width: 300px;
                 height: 250px;
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
    <?php
    $id=$_GET['id'];
    echo "<script>var id='{$id}';</script>";
?>
    <div class="attendence" id="val">
    <div id="piechart"></div>

    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

          fetch("fetch-data/fetch-attendence.php", {
              method: 'POST',
              body: JSON.stringify({id: id}),
          })
              .then(response => response.json())
              .then(data => {
                  console.log(data);
                  console.log(data['present']);
                   google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
                  var present=data['present'];
                  var absent=data['absent'];
                   function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Present',     present],
              ['Absent',      absent]
            ]);

            var options = {
              title: 'Student Attendence'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }

              })
              .catch(error => {

                  console.error("Error:", error);
              });
         

         
        </script>


</body>
</html>