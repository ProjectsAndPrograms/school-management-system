<?php
session_start();
include('config.php');
$response = array();
if (isset($_SESSION['uid']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $busID = filter_var($_POST['busId'], FILTER_SANITIZE_SPECIAL_CHARS);

    $fetchBusRootQuery = "SELECT * FROM `bus_root` WHERE `bus_id` = ? ORDER BY `serial` ASC";
    $stmt = mysqli_prepare($conn, $fetchBusRootQuery);
    mysqli_stmt_bind_param($stmt, "s", $busID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $response['status'] = "success";
        $response['view-root'] = "";
        $response['edit-root'] = '<div class="bus-connect first">
        <div class="add-new-stop-container">
            <div class="add-new-stop" onclick="openAddBusStopDialog(0)"><i class="bx bx-plus"></i></div>
        </div>
    </div>';

        $rowCount = 0;
        $left = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $rowCount++;

            if ($rowCount == mysqli_num_rows($result)) {

                $response['view-root'] .= ' <div class="bus-stop school">
                <div class="bus-stand">
                    <div class="inner-circle"> <i class="bx bx-book"></i> </div>
                </div>
                <div class="bus-details bottom">
                    <div class="text-break ">' . ucfirst($row['location']) . '</div>
                    <small>' . strtoupper($row['arrival_time']) . '</small>
                </div>
            </div>';

                $response['edit-root'] .= '<div class="bus-stop school">
                    <div class="bus-stand">
                        <div class="inner-circle"> <i class="bx bx-book"></i> </div>
                    </div>
                    <div class="bus-details bottom">
                        <div class="text-break bus-location">' . ucfirst($row['location']) . '</div>
                        <small class="time-actions">
                        <span class="arrival-time">' . strtoupper($row['arrival_time']) . '</span>
                            <span class="cursor-pointer edit-span-btn mx-1"  onclick="openEditBusStopDialog('. $rowCount .' , `'. $row['serial'] .'`)"><i class="bx bxs-edit text-success fs-5"></i></span>
                        </small>
                    </div>
                </div>';
            } else {

                $busStop = '<div class="bus-stop">
                <div class="bus-stand">
                    <div class="inner-circle"></div>
                </div>
                <div class="bus-details ' . ($left == true ? "left" : "right") . '">
                    <div class="text-break">' . ucfirst(strtolower($row['location'])) . '</div>
                    <small>' . strtoupper($row['arrival_time']) . '</small>
                </div>
            </div>';
                $toNextStopRoot = '<div class="bus-connect"></div>';

                $editBusStop = ' <div class="bus-stop">
                <div class="bus-stand">
                    <div class="inner-circle"></div>
                </div>
                <div class="bus-details ' . ($left == true ? "left" : "right") . '"">
                    <div class="text-break bus-location">' . ucfirst(strtolower($row['location'])) . '</div>
                    <small class="time-actions">
                    <span class="arrival-time">' . strtoupper($row['arrival_time']) . '</span>
                        <span class="cursor-pointer edit-span-btn mx-1" onclick="openEditBusStopDialog('.$rowCount.', `'. $row['serial'] .'`)"><i class="bx bxs-edit text-success fs-5"></i></span>
                        <span class="cursor-pointer delete-span-btn" onclick="showDeleteBusStopConfirmationDialog(`'. $row['s_no'] .'`)"><i class="bx bxs-trash-alt text-danger fs-5"></i></span>
                    </small>
                </div>
            </div>';

            $editToNextBusStopRoot = ' <div class="bus-connect">
            <div class="add-new-stop-container">
                <div class="add-new-stop" onclick="openAddBusStopDialog('. $rowCount .')"><i class="bx bx-plus"></i></div>
            </div>
        </div>';

                $response['view-root'] .= $busStop . $toNextStopRoot;
                $response['edit-root'] .= $editBusStop . $editToNextBusStopRoot;
                $left = !$left;
            }
        }
    } else {
        $response['status'] = "ERROR";
        $response['message'] = 'Data Not Available!';
    }

    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'ERROR';
    $response['message'] = 'Invalid Request!';
}
echo json_encode($response);
