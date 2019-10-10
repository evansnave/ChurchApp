<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $id = intval($_POST['delete']);
    $fundraising_status = 'inactive';
    $query = "UPDATE fundraising SET fundraising_status = :fundraising_status WHERE id =:id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':id' => $id,
            ':fundraising_status' => $fundraising_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Fundraising Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
