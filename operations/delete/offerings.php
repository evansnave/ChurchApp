<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $id = intval($_POST['delete']);
    $offerings_status = 'inactive';
    $query = "UPDATE offerings SET offerings_status = :offerings_status WHERE id =:id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':id' => $id,
            ':offerings_status' => $offerings_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Offering Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
