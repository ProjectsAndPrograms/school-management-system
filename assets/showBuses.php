<?php
session_start();
include('config.php');
$response = array();
$selected = true;
if (isset($_SESSION['uid']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $fetchBusQuery = "SELECT * FROM `buses` ORDER BY `s_no` ASC";
    $stmt = mysqli_prepare($conn, $fetchBusQuery);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $response['status'] = "";
        $response['data'] = "";
        $response['buses'] = "";

        while ($busData = mysqli_fetch_assoc($result)) {

            $busID = filter_var($busData['bus_id'], FILTER_SANITIZE_SPECIAL_CHARS);
            $busTitle = filter_var($busData['bus_title'], FILTER_SANITIZE_SPECIAL_CHARS);
            $busNumber = filter_var($busData['bus_number'], FILTER_SANITIZE_SPECIAL_CHARS);;

            if($selected){
                $response['buses'] .= '<option value="'. $busID .'" selected>'. $busTitle .'</option>';
                $selected = false;
            }else{
                $response['buses'] .= '<option value="'. $busID .'">'. $busTitle .'</option>';
            }
            

            $fetchStaffQuery = "SELECT * FROM `bus_staff` WHERE `bus_id` = ? LIMIT 2;";
            $fetchStaffStmt = mysqli_prepare($conn, $fetchStaffQuery);
            mysqli_stmt_bind_param($fetchStaffStmt, "s", $busID);
            mysqli_stmt_execute($fetchStaffStmt);
            $staffResult = mysqli_stmt_get_result($fetchStaffStmt);

            if (mysqli_num_rows($staffResult) > 0) {

                $driverName = "";
                $driverContact = "";
                $helperName = "";
                $helperContact = "";
                while ($staffRow = mysqli_fetch_assoc($staffResult)) {
                    if ($staffRow['role'] == "driver") {
                        $driverName = ucfirst(strtolower($staffRow['name']));
                        $driverContact = $staffRow['contact'];
                    } elseif ($staffRow['role'] == "helper") {
                        $helperName = ucfirst(strtolower($staffRow['name']));
                        $helperContact = $staffRow['contact'];
                    }
                }

                if(isset($driverName, $driverContact, $helperName, $helperContact, $busTitle, $busNumber)){
                    $response['status'] = "success";
                    $response['data'] .= '<div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed d-flex " type="button" data-bs-toggle="collapse" data-bs-target="#flush-'. $busID .'" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="text-break me-2 text-justify">
                                '. $busTitle .'   
                            </span>
                        </button>
                    </h2>
                    <div id="flush-'. $busID .'" class="accordion-collapse collapse" data-bs-parent="#accordion-bus-list">
                        <div class="accordion-body">
                            <div class="mb-2">
                                <b>Bus number - </b> '. strtoupper($busNumber) .'
                            </div>
                            <div class="mb-2">
                                <b>DRIVER - </b> '. $driverName .' <br>
                                <span class="ms-2">contact - '. $driverContact .'</span>
                            </div>

                            <div class="mb-2">
                                <b>HELPER - </b> '. $helperName .' <br>
                                <span class="ms-2"> contact - '. $helperContact .'
                                </span>
                            </div>
                            <div>
                                <b>ACTION - </b>
                                <div class="d-flex g-2 mt-2 leave-actions">
                                    <span class="text-warning p-2 d-flex justify-content-center text-center icon-hover-circle cursor-pointer align-items-center" onclick="openBusRoot(`'. $busID .'`)" >
                                    <i class="bx bx-map-alt"></i>
                                    </span>
                                    <span class="text-success p-2 d-flex justify-content-center text-center icon-hover-circle cursor-pointer align-items-center" onclick="openEditBusDialog(`'. $busID .'`)">
                                        <i class="bx bxs-edit pt-1"></i>
                                    </span>
                                    <span class="text-danger p-2 d-flex justify-content-center text-center icon-hover-circle  cursor-pointer  align-items-center" onclick="openDeleteConfirmationDialog(`'. $busID .'`)">
                                        <i class="bx bxs-trash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

                }else{
                    $response['status'] = "ERROR";
                    $response['message'] = 'Something went wrong!';
                }

            } else {
                $response['status'] = "ERROR";
                $response['message'] = 'Something went wrong! Staff not available!';
            }
            mysqli_stmt_close($fetchStaffStmt);
        }
    }else{
        $response['status'] = "ERROR";
        $response['message'] = 'Data not available!';
    }
    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'ERROR';
    $response['message'] = 'Invalid Request!';
}
echo json_encode($response);
