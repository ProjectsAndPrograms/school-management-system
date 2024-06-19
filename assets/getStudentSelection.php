<?php
include("config.php");

$response = array();
$response["status"] = "";
$response['content'] = '<option selected disabled value="">--select--</option>';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (isset($data["section"]) && isset($data["class"])) {

        $query = "SELECT * FROM `students` WHERE `class`=? AND `section`=? ORDER BY `fname` ASC , `lname` ASC";

        $class = $data["class"];
        $section = $data["section"];

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $class, $section);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $response["status"] = "success";


            while ($row = mysqli_fetch_assoc($result)) {

                $response['content'] .= "<option value='" . $row['id'] . "'>" . ucfirst(strtolower($row['fname'])) . " " . strtolower($row['lname']) . "</option>";
            }
        } else {
            $response['status'] = "NO_DATA";
        }
    } else {
        $response['status'] = "Invalid request";
    }
} else {
    $response['status'] = "Invalid request";
}
echo json_encode($response);
?>