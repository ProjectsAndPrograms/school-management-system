<?php

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $father = $_POST["father"];

    $class = $_POST["class"];
    $section = $_POST["section"];

    $gender = $_POST["gender"];

    $dobString = $_POST["dob"];
    $timestamp = strtotime($dobString);
    $dob = date('d-m-Y', $timestamp) . "";

    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $state = $_POST["state"];
    $guardian = $_POST["guardian"];
    $gphone = $_POST["gphone"];
    $gaddress = $_POST["gaddress"];
    $gcity = $_POST["gcity"];
    $gzip = $_POST["gzip"];
    $relation = $_POST["relation"];


    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $query = "UPDATE `students` SET `fname`=?, `lname`=?, `father`=?, `class`=?, `section`=?, `gender`=?, `dob`=?, `phone`=?, `email`=?, `address`=?, `city`=?, `zip`=?, `state`=? WHERE `id`=?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $fname, $lname, $father, $class, $section, $gender, $dob, $phone, $email, $address, $city, $zip, $state, $id);
     
        
        
        $query2 = "UPDATE student_guardian SET gname=?, gphone=?, gaddress=?, gcity=?, gzip=?, relation=? WHERE id=?";

        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "sssssss", $guardian, $gphone, $gaddress, $gcity, $gzip, $relation, $id);
        
        
        $query3 = "UPDATE users SET email=? WHERE id=?";
        
        $stmt3 = mysqli_prepare($conn, $query3);
        mysqli_stmt_bind_param($stmt3, "ss", $email, $id);
        
        
        if (mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt3)) {
            echo 'success';
        } else {
            echo "something went wrong! database";
        }
        
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt3);

    } else {
        echo 'something went wrong!';
    }

} else {
    echo "something went wrong!";
}


?>