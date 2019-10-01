<?php
include_once "connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

$date = date('Y-m-d');
$column_name = strtotime($date);

$update_leaders_attendance = "ALTER TABLE leaders_attendance ADD `$column_name` TIME NULL DEFAULT '0'";
$members = $db->prepare($update_leaders_attendance);
$members->execute();

if ($members == TRUE) {
    $query = "INSERT INTO attendance_leaders (service_date) VALUES (:service_date)";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':service_date' => $column_name,
        )
    );

    if ($statement) {
        $response['status']  = 'success';
        $response['message'] = 'Attendance Registration has started...';
    } else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to start attendance resgistration...';
    }
    echo json_encode($response); 
}






