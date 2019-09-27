<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {
    $column_name = intval($_POST['delete']);
    $service_date = date('Y-m-d', $column_name);

    $service_logger = "SELECT * FROM `first_timers_attendance` WHERE `$column_name` != 0 ";
    $result = $db->prepare($service_logger);
    $result->execute();
    $counter = $result->rowCount();
    if ($counter > 0) {
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $data) {
            $first_timer_id = $data['first_timer_id'];
            $service_logger = "SELECT * FROM service_logger WHERE first_timer_id = $first_timer_id";
            $statement = $db->prepare($service_logger);
            $statement->execute();
            $fetch = $statement->fetch();
            $service_count = $fetch['service_count'] - 1 ;

            $query = "UPDATE service_logger SET service_count = :service_count WHERE first_timer_id =:first_timer_id";
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ':first_timer_id'   => $first_timer_id,
                    ':service_count'       => $service_count
                )
            );
        }
    }

    $service_day = date('Y-m-d',$column_name);
    $delete_service = "DELETE FROM `service_attendance` WHERE service_day = :service_day ";
    $services = $db->prepare($delete_service);
    $services->execute(
        array(
            ':service_day' => $service_day
        )
    );

    $update_members = "ALTER TABLE `leaders_attendance` DROP `$column_name` ";
    $members = $db->prepare($update_members);
    $members->execute();

    $update_first_timers = "ALTER TABLE `first_timers_attendance` DROP `$column_name` ";
    $first_timers = $db->prepare($update_first_timers);
    $first_timers->execute();

    if ($first_timers == TRUE && $members == TRUE) {
 
        $status = 'inactive';
        $query = "UPDATE attendance_leaders SET status = :status WHERE service_date =:service_date";
        $stmt = $db->prepare($query);
        $stmt->execute(
            array(
                ':service_date' => $column_name,
                ':status' => $status
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