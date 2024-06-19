<?php

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $json_data = file_get_contents("php://input");
    $dataObject = json_decode($json_data, true);
    
    $id = $dataObject["id"];
    $fname = $dataObject["fname"];
    $lname = $dataObject["lname"];
    $_class = $dataObject["class"];
    $_section = $dataObject["section"];

    $subject = $dataObject["subject"];
    $gender = $dataObject["gender"];

    $dobString = $dataObject["dob"];
    $timestamp = strtotime($dobString);
    $dob = date('d-m-Y', $timestamp);

    $phone = $dataObject["phone"];
    $email = $dataObject["email"];
    $address = $dataObject["address"];
    $city = $dataObject["city"];
    $zip = $dataObject["zip"];
    $state = $dataObject["state"];
    $guardian = $dataObject["guardian"];
    $gphone = $dataObject["gphone"];
    $gaddress = $dataObject["gaddress"];
    $gcity = $dataObject["gcity"];
    $gzip = $dataObject["gzip"];
    $relation = $dataObject["relation"];

    $sql = "SELECT * FROM teachers WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) > 0){
        $query = "UPDATE teachers SET fname=?, lname=?, class=?, section=?, subject=?, gender=?, dob=?, phone=?, email=?, address=?, city=?, zip=?, state=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $fname, $lname, $_class, $_section, $subject, $gender, $dob, $phone, $email, $address, $city, $zip, $state, $id);
      
        $query2 = "UPDATE teacher_guardian SET gname=?, gphone=?, gaddress=?, gcity=?, gzip=?, relation=? WHERE id=?";
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

    mysqli_close($conn);

} else {
    echo "something went wrong!";
}
?>
