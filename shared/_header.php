
<?php
// CSP (CL)
header("Access-Control-Allow-Origin: *");
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://kit.fontawesome.com; style-src 'self' 'unsafe-inline' https://unpkg.com https://cdnjs.cloudflare.com https://fonts.googleapis.com;  font-src 'self' https://fonts.gstatic.com https://kit.fontawesome.com https://unpkg.com; img-src 'self' data:;  object-src 'none'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ERP - School Management</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="shared/style.css" />
  <link rel="icon" type="image/x-icon" href="images/1.png">
</head>

<body>
