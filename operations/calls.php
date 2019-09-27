<?php
include 'connection.php';

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "INSERT INTO calls(first_timer, call_option, called_by, response, comment) 
        VALUES (:first_timer, :call_option, :called_by,:response,:comment)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':first_timer'      =>    $_POST['first_timer'],
                ':call_option'      =>    $_POST['call_option'],
                ':called_by'        =>    $_POST['called_by'],
                ':response'         =>    $_POST['response'],
                ':comment'          =>    $_POST['comment'],
            )
        );
        echo '<div class="alert alert-info text-center"> Report submitted successfully. </div>';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM calls WHERE id = :call_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':call_id'    =>    $_POST["call_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['call_option']  = $row['call_option'];
            $output['response']     = $row['response'];
            $output['called_by']    = $row['called_by'];
            $output['comment']      = $row['comment'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE calls
                SET call_option     = :call_option,
                    response        = :response,
                    called_by       = :called_by,
                    comment         = :comment
                WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':call_option'  =>    $_POST['call_option'],
                ':response'     =>    $_POST['response'],
                ':called_by'    =>    $_POST['called_by'],
                ':comment'      =>    $_POST['comment'],
                ':id'           =>    $_POST['call_id']
            )
        );
        echo '<div class="alert alert-info text-center" >Report has been updated successfully</div>';
    }
}
