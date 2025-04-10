<?php
    $server = "localhost";
    $port = 3306;
    $user = "root";
    $password = "";
    $db = "tangadb";
    
    $conn = mysqli_connect($server, $user, $password, $db, $port);

    if (!$conn) {
        header('Location: ../errors/error.html');
        exit();
    }


?>