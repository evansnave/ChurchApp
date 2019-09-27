<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $call_id = intval($_POST['delete']);
    $call_status = 'inactive';
    $query = "UPDATE calls SET status = :call_status WHERE id =:call_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':call_id' => $call_id,
            ':call_status' => $call_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Report Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
