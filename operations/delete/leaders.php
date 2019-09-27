<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $cell_id = intval($_POST['delete']);
    $cell_status = 'inactive';
    $query = "UPDATE leaders SET status = :status WHERE id =:cell_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':cell_id' => $cell_id,
            ':status' => $cell_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Leader Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
