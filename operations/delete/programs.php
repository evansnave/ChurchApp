<?php
include_once "../connection.php";
header('Content-type: application/json; charset=UTF-8');

$response = array();

if ($_POST['delete']) {
    $program_id = intval($_POST['delete']);

    $query = "SELECT * FROM programs WHERE program_id = $program_id";
    $members = $db->prepare($query);
    $members->execute();
    $fetch = $members->fetch();
    $date_of_program =$fetch['date_of_program'];

    $program_status = 'inactive';
    $query = "UPDATE programs SET program_status = :program_status WHERE program_id =:program_id";
    $stmt = $db->prepare($query);
    $stmt->execute(
        array(
            ':program_id' => $program_id,
            ':program_status' => $program_status
        )
    );
    
    if ($stmt) {
        $table_name = 'program_' . strtotime($fetch['date_of_program']);
        $delete_table = "DROP TABLE $table_name";
        $db->exec($delete_table);
        $response['program_status']  = 'success';
        $response['message'] = 'Records successfully deleted ...';
    } else {
        $response['program_status']  = 'error';
        $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}