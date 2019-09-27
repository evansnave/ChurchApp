<?php
include('connection.php');

if (isset($_POST['btn_action2'])) {
    if ($_POST['btn_action2'] == 'Add') {
        $query = "INSERT INTO visitation(first_timer, date_of_visitation, duration, feedback,visited_by) 
        VALUES (:first_timer, :date_of_visitation, :duration,:feedback,:visited_by)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':first_timer'              =>    $_POST['first_timer'],
                ':date_of_visitation'       =>    $_POST['date_of_visitation'],
                ':duration'                 =>    $_POST['duration'],
                ':feedback'                 =>    $_POST['feedback'],
                ':visited_by'               =>    $_POST['visited_by'],
            )
        );
        echo '<div class="alert alert-info text-center"> Report submitted successfully. </div>';
    }

    if ($_POST['btn_action2'] == 'fetch_single') {
        $query = "SELECT * FROM visitation WHERE id = :visitation_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':visitation_id'    =>    $_POST["visitation_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['date_of_visitation']   = $row['date_of_visitation'];
            $output['duration']             = $row['duration'];
            $output['feedback']             = $row['feedback'];
            $output['visited_by']           = $row['visited_by'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action2'] == 'Edit') {
        $query = "UPDATE visitation
            SET date_of_visitation  = :date_of_visitation,
                duration            = :duration,
                feedback            = :feedback,
                visited_by          = :visited_by
            WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':date_of_visitation'    =>    $_POST['date_of_visitation'],
                ':duration'              =>    $_POST['duration'],
                ':feedback'              =>    $_POST['feedback'],
                ':visited_by'            =>    $_POST['visited_by'],
                ':id'                    =>    $_POST['visitation_id']
            )
        );    
        echo '<div class="alert alert-info text-center" style="color:#000">Report has been updated successfully</div>';
    }
}
