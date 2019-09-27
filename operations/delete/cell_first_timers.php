<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $first_timer_id = intval($_POST['delete']);
    $first_timer_status = 'inactive';
    $query = "UPDATE cell_first_timers SET firstTimer_status = :first_timer_status WHERE id =:first_timer_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':first_timer_id'       => $first_timer_id,
            ':first_timer_status'   => $first_timer_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'First Timer Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
