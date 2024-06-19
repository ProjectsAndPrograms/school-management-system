<?php
  include('../database.php');

  // Get the raw POST data
  $input = file_get_contents("php://input");
  
  // Decode the JSON data into an associative array
  $data = json_decode($input, true);

  // Check if 'id' exists in the decoded data
  if (isset($data['id'])) {
    $id = $data['id'];

    $sql = "UPDATE students SET request='pending', request_date=CURRENT_DATE, request_time=CURRENT_TIME WHERE id = '{$id}'";

    
    $result = mysqli_query($conn,$sql);

    if ($result) {
      echo json_encode(["status" => "success", "message" => "Request updated successfully"]);
    } else {
      echo json_encode(["status" => "error", "message" => "Error updating request"]);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  } else {
    // 'id' is not set in the data
    echo json_encode(["status" => "error", "message" => "ID not found"]);
  }
?>
