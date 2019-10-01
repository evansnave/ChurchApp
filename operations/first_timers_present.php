<?php
    include_once "connection.php";
    header('Content-type: application/json; charset=UTF-8');

    $response = array();
    $today = date('Y-m-d');
    $date = strtotime($today);
    $present = date('H:i:s');

    if ($_POST['id']) {

        $first_timer_id = intval($_POST['id']);
        $query = "UPDATE first_timers_attendance SET `$date` = :present WHERE first_timer_id =:first_timer_id";
        $stmt = $db->prepare($query);
        $stmt->execute(
            array(
                ':first_timer_id'   => $first_timer_id,
                ':present'       => $present
            )
        );

        if ($stmt) {
            $query = "INSERT INTO service_attendance (first_timer, service_day) 
                VALUES (:first_timer, :service_day)";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':first_timer'  =>    $first_timer_id,
                    ':service_day'  =>    $today,
                )
            );
        }

        $service_logger = "SELECT * FROM service_logger WHERE first_timer_id = $first_timer_id";
        $statement = $db->prepare($service_logger);
        $statement->execute();
        $counter = $statement->rowCount();

        if ($counter > 0 ) {
            $fetch = $statement->fetch();
            $service_count = $fetch['service_count'] + 1;
            
            $query = "UPDATE service_logger SET service_count = :service_count WHERE first_timer_id =:first_timer_id";
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ':first_timer_id'   => $first_timer_id,
                    ':service_count'       => $service_count
                )
            );

        }else {
            $query = "INSERT INTO service_logger (first_timer_id, service_count) 
                    VALUES (:first_timer_id, :service_count)";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':first_timer_id'  =>    $first_timer_id,
                    ':service_count'  =>    1,
                )
            );
        }
        
    }
