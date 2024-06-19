
<?php include("../assets/noSessionRedirect.php"); ?>
<?php include("./verifyRoleRedirect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>School Management</title>
    <link rel="icon" type="image/x-icon" href="../images/1.png">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->


    <link rel="stylesheet" href="css/bootstrap.css">
   
    

    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/date-picker.css" />
    <link rel="stylesheet" href="css/date-picker.css">
   
</head>
<?php 
 
    
    $theme = "light";
   
    $uid = $_SESSION['uid'];
    $query = "SELECT theme FROM users WHERE id='$uid'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
   
      $theme = $row['theme'];
    }
?>
<body class='<?php echo $theme; ?>'>


 
<div class='toast-container position-fixed text-success bottom-0 end-0 p-3' style="z-index: 9000;">
    <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style="color:black;">
    <div class='d-flex'>
      <div class='toast-body' id="toast-alert-message">
        
      </div>
      <button type='button' class='btn-close me-2 m-auto text-danger' data-bs-dismiss='toast' aria-label='Close'></button>
    </div>
    </div>
  </div>




