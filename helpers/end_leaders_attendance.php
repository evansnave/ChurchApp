<?php
include_once "operations/connection.php";
$today =date('Y-m-d');
$date = strtotime($today);
$query = "SELECT * FROM attendance_leaders WHERE service_date != $date AND session = 'ongoing' AND status = 'active' ";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();

if ($count > 0) {
    $session_state = 'ended';
    $update = "UPDATE attendance_leaders SET session = :session_state WHERE session ='ongoing'";
    $statement = $db->prepare($update);
    $statement->execute(
        array(
            ':session_state' => $session_state
        )
    );
}