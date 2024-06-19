
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
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>ERP</title>
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
            <li><a class="dropdown-item" href="make-payment.php">PAYROLL</a></li>
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
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-student">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    </div>
    <div class="select">
      <select class="form-select" aria-label="Default select example" id="form-select">
  <option value="" selected>Select Class</option>
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
    </div>
    <div class="teacher-list">
      <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Sr_NO</th>
      <th scope="col">NAME</th>
      <th scope="col">Class & Section</th>
      <th scope="col">MORE DETAILS</th>
    </tr>
  </thead>
  <tbody id="tb">
    
  </tbody>
</table>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        function load_table(){$.ajax({
          url: "fetch-data/fetch-student.php",
          method: "POST",
          success: function(data){
             $("#tb").html(data);
          }
        });
      }
      load_table();

        $("#form-select").change(function(){
          var select=$(this).val();
          $.ajax({
              url: "fetch-data/select-students.php",
              type: "POST",
              data: {select: select},
              success: function(data){
                  $("#tb").html(data);
              }
        });
        });

        $("#search-student").on("keyup",function(){
          var search=$(this).val();
          $.ajax({
              url: "fetch-data/search-student.php",
              type: "POST",
              data: {search: search},
              success: function(data){
                  $("#tb").html(data);
              }
        });
        });
        
      
      });

     


    </script>
  </body>
  </html>