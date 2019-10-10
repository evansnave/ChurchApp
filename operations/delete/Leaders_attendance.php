<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {
    $column_name = intval($_POST['delete']);
    $service_date = date('Y-m-d', $column_name);

    $update_members = "ALTER TABLE `leaders_attendance` DROP `$column_name` ";
    $members = $db->prepare($update_members);
    $members->execute();

    if ($members) {
        $status = 'inactive';
        $query = "UPDATE attendance_leaders SET status = :status WHERE service_date =:service_date";
        $stmt = $db->prepare($query);
        $stmt->execute(
            array(
                ':service_date'  => $column_name,
                ':status'        => $status
            )
        );

        if ($stmt) {
            $response['status']  = 'success';
            $response['message'] = 'Records successfully deleted ...';
        } else {
            $response['status']  = 'error';
            $response['message'] = 'Unable to delete ...';
        }
        echo json_encode($response);
    }
}