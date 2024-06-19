<?php include("../assets/noSessionRedirect.php"); ?>

<?php include("./verifyRoleRedirect.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="shortcut icon" href="./images/logo.png">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>Fee Payment</title>
    <style type="text/css">
      .payment{
        margin-bottom: 10%;
      }
      #money{
        margin-top: 5%;
      }
      #instalment{
        padding: 8px;
        width: 200px;
        margin-top: 6%;
        border-radius: 8px;
      }
      @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
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

    <div class="payment">
      <section class="h-100 h-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Payment Info</h3>

            <form class="px-md-2">
                <div class="row">
                <!-- <div class="col-md-6 mb-4">

                  <div class="form-outline datepicker">
                    <input type="text" class="form-control" id="exampleDatepicker1" />
                    <label for="exampleDatepicker1" class="form-label">Select a date</label>
                  </div>

                </div> -->
                <div class="col-md-6 mb-4">
                  
                  <select class="form-select" aria-label="Default select example" id="select">
  <option selected>Open this select menu</option>
  <option value="nu-ukg">Nur-UKG</option>
  <option value="1">Class 1</option>
  <option value="2">Class 2</option>
  <option value="3">Class 3</option>
  <option value="4">Class 4</option>
  <option value="5">Class 5</option>
  <option value="6">Class 6</option>
  <option value="7">Class 7</option>
  <option value="8">Class 8</option>
  <option value="9">Class 9</option>
  <option value="10">Class 10</option>
  <option value="11s">Class 11 (Science)</option>
  <option value="12s">Class 12 (Science)</option>
  <option value="11c">Class 11 (Commerce)</option>
  <option value="12c">Class 12 (Commerce)</option>

</select>
                  <!-- <label for="exampleDatepicker1" class="form-label">Student Name</label> -->
                  <select class="instal" aria-label="Default select example" id="instalment">
                      <option selected>Select Instalment</option>
                      <option value="i1">Installment 1 (April)</option>
                      <option value="i2">Installment 2 (July)</option>
                      <option value="i3">Installment 3 (October)</option>
                      <option value="i4">Installment 4 (January)</option>
                      <option value="bus">Bus Fee</option>
                      <option value="total">Total</option>
                  </select>
                  <br>
                  <input type="text" name="" value="Amount" id="money" disabled>
                </div>
              </div>
               
              <img src="images/qr.jpg" id="qr" style="height: 100%; width: 100%;">
              
              <button type="submit" class="btn btn-success btn-lg mb-1"
              style="margin-top: 8%;">Scan To Pay</button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>

  </body>
  <script type="text/javascript">
   $(document).ready(function(){
    $("#instalment").hide();
   $("#select,#instalment").change(function(){
       $("#instalment").show(1000);
  
       var id = $("#select").val();
       var inst = $("#instalment").val();
      


       if(id == 1 && inst == 'i1' || id == 2 && inst == 'i1' || id == 3 && inst == 'i1' || id == 4 && inst == 'i1' || id == 5 && inst == 'i1'){
           $("#money").val(6000);
       }
       else if(id == 1 && inst == 'i2' || id == 2 && inst == 'i2' || id == 3 && inst == 'i2' || id == 4 && inst == 'i2' || id == 5 && inst == 'i2'){
           $("#money").val(5000);
       }
       else if(id == 1 && inst == 'i3' || id == 2 && inst == 'i3' || id == 3 && inst == 'i3' || id == 4 && inst == 'i3' || id == 5 && inst == 'i3'){
           $("#money").val(6000);
       }
       else if(id == 1 && inst == 'i4' || id == 2 && inst == 'i4' || id == 3 && inst == 'i4' || id == 4 && inst == 'i4' || id == 5 && inst == 'i4'){
           $("#money").val(5000);
       }
       else if(id == 1 && inst == 'bus' || id == 2 && inst == 'bus' || id == 3 && inst == 'bus' || id == 4 && inst == 'bus' || id == 5 && inst == 'bus'){
           $("#money").val(2450);
       }
       else if(id == 1 && inst == 'total' || id == 2 && inst == 'total' || id == 3 && inst == 'total' || id == 4 && inst == 'total' || id == 5 && inst == 'total'){
           $("#money").val(22000);
       }




       else if(id == 6 && inst == 'i1' || id == 7 && inst == 'i1' || id == 8 && inst == 'i1'){
           $("#money").val(6900);
       }
       else if(id == 6 && inst == 'i2' || id == 7 && inst == 'i2' || id == 8 && inst == 'i2'){
           $("#money").val(6000);
       }
       else if(id == 6 && inst == 'i3' || id == 7 && inst == 'i3' || id == 8 && inst == 'i3'){
           $("#money").val(6900);
       }
       else if(id == 6 && inst == 'i4' || id == 7 && inst == 'i4' || id == 8 && inst == 'i4'){
           $("#money").val(6000);
       }
       else if(id == 6 && inst == 'bus' || id == 7 && inst == 'bus' || id == 8 && inst == 'bus'){
           $("#money").val(2450);
       }
       else if(id == 6 && inst == 'total' || id == 7 && inst == 'total' || id == 8 && inst == 'total'){
           $("#money").val(25800);
       }


       else if(id == 9 && inst == 'i1'|| id == 10 && inst == 'i1'){
           $("#money").val(8000);
       }
       else if(id == 9 && inst == 'i2'|| id == 10 && inst == 'i2'){
           $("#money").val(6800);
       }
       else if(id == 9 && inst == 'i3'|| id == 10 && inst == 'i3'){
           $("#money").val(8000);
       }
       else if(id == 9 && inst == 'i4'|| id == 10 && inst == 'i4'){
           $("#money").val(6800);
       }
       else if(id == 9 && inst == 'bus'|| id == 10 && inst == 'bus'){
           $("#money").val(2450);
       }
       else if(id == 9 && inst == 'total'|| id == 10 && inst == 'total'){
           $("#money").val(29600);
       }


       else if(id == '11s' && inst == 'i1' || id == '12s' && inst == 'i1'){
           $("#money").val(12000);
       }
       else if(id == '11s' && inst == 'i2' || id == '12s' && inst == 'i2'){
           $("#money").val(9800);
       }
       else if(id == '11s' && inst == 'i3' || id == '12s' && inst == 'i3'){
           $("#money").val(12000);
       }
       else if(id == '11s' && inst == 'i4' || id == '12s' && inst == 'i4'){
           $("#money").val(9800);
       }
        else if(id == '11s' && inst == 'bus' || id == '12s' && inst == 'bus'){
           $("#money").val(2450);
       }
       else if(id == '11s' && inst == 'total' || id == '12s' && inst == 'total'){
           $("#money").val(43600);
       }


       else if(id == '11c' && inst == 'i1' || id == '12c' && inst == 'i1'){
           $("#money").val(11100);
       }
       else if(id == '11c' && inst == 'i2' || id == '12c' && inst == 'i2'){
           $("#money").val(8900);
       }
       else if(id == '11c' && inst == 'i3' || id == '12c' && inst == 'i3'){
           $("#money").val(11100);
       }
       else if(id == '11c' && inst == 'i4' || id == '12c' && inst == 'i4'){
           $("#money").val(8900);
       }
       else if(id == '11c' && inst == 'bus' || id == '12c' && inst == 'bus'){
           $("#money").val(2450);
       }
       else if(id == '11c' && inst == 'total' || id == '12c' && inst == 'total'){
           $("#money").val(40000);
       }


       else if(id == 'nu-ukg' && inst == 'i1'){
           $("#money").val(4500);
       }
       else if(id == 'nu-ukg' && inst == 'i2'){
           $("#money").val(3500);
       }
       else if(id == 'nu-ukg' && inst == 'i3'){
           $("#money").val(4500);
       }
       else if(id == 'nu-ukg' && inst == 'i4'){
           $("#money").val(3500);
       }
       else if(id == 'nu-ukg' && inst == 'bus'){
           $("#money").val(2450);
       }
       else if(id == 'nu-ukg' && inst == 'total'){
           $("#money").val(16000);
       }
       
       else{
        $("#money").val("amount");
       }


   });
});

  </script>
  </html>