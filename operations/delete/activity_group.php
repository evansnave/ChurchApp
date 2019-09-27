<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $group_id = intval($_POST['delete']);
    $group_status = 'inactive';
    $query = "UPDATE activity_groups SET group_status = :group_status WHERE id =:group_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':group_id' => $group_id,
            ':group_status' => $group_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Department Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
