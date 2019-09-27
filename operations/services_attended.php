<?php
include('../operations/connection.php');

if (isset($_POST['btn_action4'])) {
    if ($_POST['btn_action4'] == 'Add') {
        $query = "INSERT INTO service_attendance (first_timer, service_day) 
        VALUES (:first_timer, :service_day)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':first_timer'  =>    $_POST['first_timer'],
                ':service_day' =>    $_POST['service_day'],
            )
        );
        $first_timer_id = $_POST['first_timer'];
        $service_logger = "SELECT * FROM service_logger WHERE first_timer_id = $first_timer_id";
        $statement = $db->prepare($service_logger);
        $statement->execute();
        $counter = $statement->rowCount();

        if ($counter > 0) {
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
        } else {
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
        echo '<div class="alert alert-info text-center" > Report submitted successfully. </div>';
    }

    if ($_POST['btn_action4'] == 'fetch_single') {
        $query = "SELECT * FROM service_attendance WHERE id = :service_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':service_id'    =>    $_POST["service_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['service_day']  = $row['service_day'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action4'] == 'Edit') {
        $query = "UPDATE service_attendance SET 
                service_day = '" . trim($_POST["service_day"]) . "'
			WHERE id = '" . $_POST["service_id"] . "'";

        $statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center" >Report has been updated successfully</div>';
    }
}
