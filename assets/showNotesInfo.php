<?php

include("config.php");

if (isset($_POST['noteId'])) {
    $query = "SELECT * FROM notes Where s_no = ?";

    $noteId = (int) $_POST['noteId'];
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $noteId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    $data = array(
        'noteId' => $noteId
    );

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data["title"] = $row["title"];
        $data["comment"] = $row["comment"];
        $data["class"] = $row["class"];
        $data["subject"] = $row["subject"];

        $editor_id = $row["editor_id"];

        $sql = "SELECT fname, lname FROM teachers
            WHERE id = ? 
            UNION
            SELECT fname, lname FROM admins
            WHERE id = ?;";
        $stmt2 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt2, "ss", $editor_id, $editor_id);

        mysqli_stmt_execute($stmt2);

        $result2 = mysqli_stmt_get_result($stmt2);

        $fetchRow = mysqli_fetch_assoc($result2);

        $editorName = $fetchRow['fname'] . " " . $fetchRow['lname'];

        $data['editor'] =  ucfirst($editorName);
        $path = ".." . DIRECTORY_SEPARATOR . "notesUploads" . DIRECTORY_SEPARATOR . $row["file"];

        $data['file'] = $path;

        mysqli_stmt_close($stmt2);
    }
    
    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonData;

}

?>