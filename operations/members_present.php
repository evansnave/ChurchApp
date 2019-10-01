a<?php
include_once "connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();
$today = date('Y-m-d');
$date = strtotime($today);
$present = date('H:i:s');

if ($_POST['id']) {

    $member_id = intval($_POST['id']);
    $query = "UPDATE members_attendance SET `$date` = :present WHERE member_id =:member_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':member_id'   => $member_id,
            ':present'       => $present
        )
    );

    echo "present";

}
