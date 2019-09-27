<?php
include_once "connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

$date = date('Y-m-d');
$column_name = strtotime($date);

$update_members = "ALTER TABLE members_attendance ADD `$column_name` TIME NULL DEFAULT '0'";
$members = $db->prepare($update_members);
$members->execute();

$update_first_timers = "ALTER TABLE first_timers_attendance ADD `$column_name` TIME NULL DEFAULT '0'";
$first_timers = $db->prepare($update_first_timers);
$first_timers->execute();

if ($first_timers == TRUE && $members == TRUE) {
    $query = "INSERT INTO attendance (service_date) VALUES (:service_date)";
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






