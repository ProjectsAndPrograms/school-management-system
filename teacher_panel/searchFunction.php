
<?php
$searches = array( 'dashboard','student',"attendence",'noticeboard','timetable',  'syllabus',  'notes', 'marks','leaves', 'settings');

$pages = array( 'dashboard.php','student.php',"attendence.php", 'noticeboard.php',  'timetable.php','syllabus.php','notes.php', 'marks.php','leaves.php',  'settings.php');

$response = "";
if (isset($_POST['searchValue'])) {
    $searchValue = $_POST['searchValue'];
    $i = 0;
    foreach ($searches as $search) {
        if ($searchValue !== '' && str_contains($search, $searchValue)) {
         
            echo $pages[$i];
            exit();
        }else{
            $response = "NOTFOUND";
        }
        $i++;
    }
}
echo $response;
?>