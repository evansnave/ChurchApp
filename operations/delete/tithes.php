<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $id = intval($_POST['delete']);
    $tithe_status = 'inactive';
    $query = "UPDATE tithes SET tithe_status = :tithe_status WHERE id =:id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':id' => $id,
            ':tithe_status' => $tithe_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Tithe Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
