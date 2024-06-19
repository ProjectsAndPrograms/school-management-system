<?php
include("config.php");

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $query = "";
    $resultOutput = array();

    if ($name == "") {
        $query = "SELECT * FROM teachers;";
        $stmt = mysqli_prepare($conn, $query);
    } else {
        if (stripos($name, " ") !== false) {
            $array = explode(' ', $name, 2);

            $query = "SELECT *
            FROM (
                SELECT *
                FROM teachers
            ) AS temp_table
            WHERE (fname LIKE ? AND lname LIKE ?)
                OR (fname LIKE ? AND lname LIKE ?)
            ORDER BY fname, lname ASC;";

            $stmt = mysqli_prepare($conn, $query);
            $param1 = $array[0] . '%';
            $param2 = '%' . $array[1] . "%";
            $param3 = $array[1] . '%';
            $param4 = '%' . $array[0] . "%";
            mysqli_stmt_bind_param($stmt, "ssss", $param1, $param2, $param3, $param4);
        } else {
            $query = "SELECT *
            FROM teachers
                WHERE (fname LIKE ? OR lname LIKE ?)
            ORDER BY fname, lname ASC;";

            $stmt = mysqli_prepare($conn, $query);
            $param = '%' . $name . '%';
            mysqli_stmt_bind_param($stmt, "ss", $param, $param);
        }
    }

    if (isset($stmt)) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $fname = $row["fname"];
                $lname = $row["lname"];
                $tid = $row['id'];
                $image = '../teacherUploads/'. $row['image'];
                $image = file_exists($image) ? $image : "../images/user.png";

                $resultOutput[$count - 1] = "<tr>
                   <td>&nbsp;&nbsp;" . $count . ".&nbsp;&nbsp;</td>
                <td>" . $tid . "</td>
                <td class='user'>
                    <img src='" . $image . "'>
                    <p>". ucfirst(strtolower($fname)) ." ". strtolower($lname)."</p>
                </td>
                <td class='flex-center'>
                    <div class='edit-delete'>
                        <a onclick='editTeacher(`" . $tid . "`)'   class='edit' >
                            <i class='bx bxs-edit'></i>
                            <span>&nbsp;Edit</span>
                        </a>
                        <a onclick='deleteTeacherWithId(`" . $tid . "`)'  class='delete'>
                            &nbsp;&nbsp;<i class='bx bxs-trash'></i>
                            <span>&nbsp;Delete</span>
                            &nbsp;&nbsp;
                        </a>
                    </div>
                </td>
            </tr>";

                $count = $count + 1;
            }

            echo json_encode($resultOutput);
        } else {
            $arr = array("No_Record");
            echo json_encode($arr);
        }

        mysqli_stmt_close($stmt);
    }
} else {
    echo "No name";
}
?>
