<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');
$program_name = 'program_'.$_GET['date'];
$response = array();

if ($_POST['delete']) {

    $invitee_id = intval($_POST['delete']);
    $invitee_status = 'inactive';
    $query = "UPDATE `$program_name` SET invitee_status = :invitee_status WHERE id =:invitee_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':invitee_id'       => $invitee_id,
            ':invitee_status'   => $invitee_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Invitee Successfully Deleted ...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
