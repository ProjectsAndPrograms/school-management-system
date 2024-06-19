<?php include("../assets/noSessionRedirect.php"); ?>

<?php include("./verifyRoleRedirect.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>Fee Recipt</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <style type="text/css">
      .see-payment{
  height: auto;
  width: 80%;
  display: flex;
  position: absolute;
  border: .2px solid lightgray;
  flex-direction: column;
  margin-left: 10%;
  margin-top: 3%;
  border-radius: 5px;
  padding: 10px;
  background-color: ghostwhite;

}
#paid{
   height: 50px;
   width: 150px;
   background-color: lightgreen;
   color: black;
   border: none;
   border-radius: 5px;
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
          <a class="nav-link active" aria-current="page" href="fee-payment.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="check-fee-recipt.php">Fee-Recipt</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="index.php">Back to Main Page</a>
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
    <div class="see-payment">
      <div class="notice-body">
        <h2>Title:  </h2>
        <h5>Teacher's Name : XYZ</h5>
        <h5>Amount: 5000</h5>
        <p>Date of Payment: 22/oct/2012</p>
        <button id="paid">Paid Successfully</button>
      </div>
    </div>
  </body>
  </html>