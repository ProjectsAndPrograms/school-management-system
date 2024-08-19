<?php
 include("../../assets/config.php");

// Assuming you've already sanitized the search term
$search = $_POST['search'];

// Using prepared statement to prevent SQL injection
$sql = "SELECT * FROM students WHERE fname LIKE ? OR lname LIKE ? OR class LIKE ? OR section LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern);
$searchPattern = "%{$search}%";
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <th scope='row'>" . $row['s_no'] . "</th>
            <td>" . $row['fname'] . " " . $row['lname'] . "</td>
            <td>" . $row['class'] . "" . $row['section'] . "</td>
            <td><a href='modal-student.php?id=". $row['id'] ."'><button id='view-more' data-id='".$row['id']."' style='height: 35px; width: 100px; background-color: skyblue; color: white; border: none; border-radius: 8px; text-decoration: none;'>View More</button>

          </a></td>
        </tr>";
    }
}
?>
