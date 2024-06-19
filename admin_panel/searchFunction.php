<?php
$searches = array('dashboard', 'teacher', 'student', 'subjects', "attendence", 'noticeboard', 'timetable', 'syllabus', 'notes', 'marks','bus service', 'settings');

$pages = array('dashboard.php', 'teacher.php', 'student.php', 'subjects.php', "attendence.php", 'noticeboard.php', 'timetable.php', 'syllabus.php', 'notes.php', 'marks.php','buses.php', 'settings.php');

$response = "";
if (isset($_POST['searchValue'])) {
    $searchValue = $_POST['searchValue'];
    $i = 0;
    foreach ($searches as $search) {
        if ($searchValue !== '' && str_contains($search, $searchValue)) {

            echo $pages[$i];
            exit();
        } else {
            $response = "NOTFOUND";
        }
        $i++;
    }
}
echo $response;
?>