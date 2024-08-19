<?php
include('../../assets/config.php');

$input = file_get_contents("php://input");

$data = json_decode($input, true);

if (isset($data['id'])) {
    $id = $data['id'];

    $stmt = $conn->prepare("UPDATE students SET request='pending', request_date=CURRENT_DATE, request_time=CURRENT_TIME WHERE id = ?");
    
    $stmt->bind_param('s', $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Request updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating request"]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["status" => "error", "message" => "ID not found"]);
}
?>
