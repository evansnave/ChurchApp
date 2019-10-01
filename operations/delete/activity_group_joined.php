<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $group_id = intval($_POST['delete']);
    $status = 'inactive';
    $query = "UPDATE activity_groups_joined SET status = :status WHERE id =:group_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':group_id' => $group_id,
            ':status' => $status
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
