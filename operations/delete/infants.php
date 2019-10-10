<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $member_id = intval($_POST['delete']);
    $member_status = 'inactive';
    $query = "UPDATE infants SET member_status = :member_status WHERE id = :member_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':member_id' => $member_id,
            ':member_status' => $member_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Member Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
