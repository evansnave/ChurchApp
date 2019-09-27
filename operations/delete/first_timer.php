<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $first_timer_id = intval($_POST['delete']);
    $first_timer_status = 'inactive';
    $query = "UPDATE first_timers SET firstTimer_status = :first_timer_status WHERE id =:first_timer_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':first_timer_id'       => $first_timer_id,
            ':first_timer_status'   => $first_timer_status
        )
    );
    
    $delete_first_timer = "DELETE FROM  `first_timers_attendance` WHERE first_timer_id = :first_timer_id";
    $statement = $db->prepare($delete_first_timer);
    $statement->execute(
        array(
            ':first_timer_id' => $first_timer_id
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
