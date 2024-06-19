<?php
include('config.php');
$response = array();

if (isset($_POST['class'])) {
    $class = $_POST['class'];

    $sql = "SELECT * FROM subjects WHERE class=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $class);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $response[$count - 1] = " <tr>
                <td class='num'>".$count.".</td>
                <td>".  ucfirst(strtolower($row['subject_name']))  ."</td>
                <td class='flex-center'>
                    <div class='edit-delete'>
                        <a class='edit' onclick='openEditDialog(`".$row['subject_id']."`)'>
                            <i class='bx bxs-edit'></i>
                            <span>&nbsp;Edit</span>
                        </a>

                        <a class='delete' onclick='openDeleteDialog(`".$row['subject_id']."`)'>
                            &nbsp;&nbsp;<i class='bx bxs-trash'></i>
                            <span>&nbsp;Delete</span>
                            &nbsp;&nbsp;
                        </a>
                    </div>
                </td>
            </tr>";
            $count++;
        }
    } else {
        $response[0] = "No_Record";
    }

    mysqli_stmt_close($stmt);
} else {
    $response[0] = 'something went wrong!';
}

$jsonData = json_encode($response);
echo $jsonData;
?>
