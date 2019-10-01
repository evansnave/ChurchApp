<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {

    $account_id = intval($_POST['delete']);
    $account_status = 'inactive';
    $query = "UPDATE accounts SET account_status = :account_status WHERE account_id =:account_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':account_id'       => $account_id,
            ':account_status'   => $account_status
        )
    );

    if ($stmt) {
        $response['status']  = 'success';
        $response['message'] = 'Account successfully deleted';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}
