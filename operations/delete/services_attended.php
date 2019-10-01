<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $service_id = intval($_POST['delete']);
    $service_logger = "SELECT * FROM service_attendance WHERE id = $service_id";
    $statement = $db->prepare($service_logger);
    $statement->execute();
    $result = $statement->fetch();
    $first_timer_id = $result['id'];
    $status = 'inactive';
    $query = "UPDATE service_attendance SET status = :status WHERE id =:service_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':service_id' => $service_id,
            ':status' => $status
        )
    );
    
    $service_logger = "SELECT * FROM service_logger WHERE first_timer_id = $first_timer_id";
    $statement = $db->prepare($service_logger);
    $statement->execute();
    $counter = $statement->rowCount();

    if ($counter > 0) {
        $fetch = $statement->fetch();
        $service_count = $fetch['service_count'] - 1;

        $query = "UPDATE service_logger SET service_count = :service_count WHERE first_timer_id =:first_timer_id";
        $stmt = $db->prepare($query);
        $stmt->execute(
            array(
                ':first_timer_id'   => $first_timer_id,
                ':service_count'       => $service_count
            )
        );
    }

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Report Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
