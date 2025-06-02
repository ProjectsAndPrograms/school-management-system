<?php
session_start();
include('config.php');

$response = [];

if (isset($_SESSION['uid']) && $_SERVER["REQUEST_METHOD"] === "POST") {

    $busID = filter_var($_POST['busId'], FILTER_SANITIZE_SPECIAL_CHARS);

    $fetchBusRootQuery = "SELECT * FROM `bus_root` WHERE `bus_id` = ? ORDER BY `serial` ASC";
    $stmt = mysqli_prepare($conn, $fetchBusRootQuery);
    mysqli_stmt_bind_param($stmt, "s", $busID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $busStops = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $totalStops = count($busStops);

        $response['status'] = "success";
        $response['view-root'] = "";
        $response['edit-root'] = '<div class="bus-connect first">
            <div class="add-new-stop-container">
                <div class="add-new-stop" onclick="openAddBusStopDialog(0)"><i class="bx bx-plus"></i></div>
            </div>
        </div>';

        $left = true;

        foreach ($busStops as $index => $row) {
            $isLast = ($index === $totalStops - 1);
            $location = ucfirst(strtolower($row['location']));
            $arrival = strtoupper($row['arrival_time']);

            if ($isLast) {
                // View mode
                $response['view-root'] .= '
                <div class="bus-stop school">
                    <div class="bus-stand">
                        <div class="inner-circle"><i class="bx bx-book"></i></div>
                    </div>
                    <div class="bus-details bottom">
                        <div class="text-break">' . htmlspecialchars($location) . '</div>
                        <small>' . htmlspecialchars($arrival) . '</small>
                    </div>
                </div>';

                // Edit mode
                $response['edit-root'] .= '
                <div class="bus-stop school">
                    <div class="bus-stand">
                        <div class="inner-circle"><i class="bx bx-book"></i></div>
                    </div>
                    <div class="bus-details bottom">
                        <div class="text-break bus-location">' . htmlspecialchars($location) . '</div>
                        <small class="time-actions">
                            <span class="arrival-time">' . htmlspecialchars($arrival) . '</span>
                            <span class="cursor-pointer edit-span-btn mx-1" onclick="openEditBusStopDialog(' . ($index + 1) . ', `' . $row['serial'] . '`)">
                                <i class="bx bxs-edit text-success fs-5"></i>
                            </span>
                        </small>
                    </div>
                </div>';
            } else {
                // View mode
                $response['view-root'] .= '
                <div class="bus-stop">
                    <div class="bus-stand">
                        <div class="inner-circle"></div>
                    </div>
                    <div class="bus-details ' . ($left ? 'left' : 'right') . '">
                        <div class="text-break">' . htmlspecialchars($location) . '</div>
                        <small>' . htmlspecialchars($arrival) . '</small>
                    </div>
                </div>
                <div class="bus-connect"></div>';

                // Edit mode
                $response['edit-root'] .= '
                <div class="bus-stop">
                    <div class="bus-stand">
                        <div class="inner-circle"></div>
                    </div>
                    <div class="bus-details ' . ($left ? 'left' : 'right') . '">
                        <div class="text-break bus-location">' . htmlspecialchars($location) . '</div>
                        <small class="time-actions">
                            <span class="arrival-time">' . htmlspecialchars($arrival) . '</span>
                            <span class="cursor-pointer edit-span-btn mx-1" onclick="openEditBusStopDialog(' . ($index + 1) . ', `' . $row['serial'] . '`)">
                                <i class="bx bxs-edit text-success fs-5"></i>
                            </span>
                            <span class="cursor-pointer delete-span-btn" onclick="showDeleteBusStopConfirmationDialog(`' . $row['s_no'] . '`)">
                                <i class="bx bxs-trash-alt text-danger fs-5"></i>
                            </span>
                        </small>
                    </div>
                </div>
                <div class="bus-connect">
                    <div class="add-new-stop-container">
                        <div class="add-new-stop" onclick="openAddBusStopDialog(' . ($index + 1) . ')"><i class="bx bx-plus"></i></div>
                    </div>
                </div>';
            }

            $left = !$left;
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

header('Content-Type: application/json');
echo json_encode($response);
