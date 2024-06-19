<?php 
    session_start();

    unset($_SESSION);
    session_destroy();

    $response = array('status' => 'success',
                     'message' => 'Logout successful');
    echo json_encode($response);

?>
