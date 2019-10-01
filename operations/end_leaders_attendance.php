<?php
include_once "connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['end']) {

    $service_id = intval($_POST['end']);
    $status = 'ended';
    $query = "UPDATE attendance_leaders SET session = :status WHERE id =:service_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':service_id'   => $service_id,
            ':status'       => $status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Registration successfully ended ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to end registration ...';
    }
    echo json_encode($response);
}
