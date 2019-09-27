<?php
include('connection.php');

if (isset($_POST['btn_action5'])) {
    if ($_POST['btn_action5'] == 'Add') {
        $query = "INSERT INTO ministry_materials(first_timer, title, format, feedback,date_received) 
        VALUES (:first_timer, :title, :format,:feedback,:date_received)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':first_timer'      =>    $_POST['first_timer'],
                ':title'            =>    $_POST['title'],
                ':format'           =>    $_POST['format'],
                ':feedback'         =>    $_POST['feedback'],
                ':date_received'    =>    $_POST['date_received'],
            )
        );
        echo '<div class="alert alert-info text-center"> Report submitted successfully. </div>';
    }

    if ($_POST['btn_action5'] == 'fetch_single') {
        $query = "SELECT * FROM ministry_materials WHERE id = :material_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':material_id'    =>    $_POST["material_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['title']          = $row['title'];
            $output['format']         = $row['format'];
            $output['feedback1']      = $row['feedback'];
            $output['date_received']  = $row['date_received'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action5'] == 'Edit') {
        $query = "UPDATE ministry_materials 
          SET   title           = :title,
                format          = :format,
                feedback        = :feedback,
                date_received   = :date_received
            WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':title'         =>    $_POST['title'],
                ':format'        =>    $_POST['format'],
                ':feedback'      =>    $_POST['feedback'],
                ':date_received' =>    $_POST['date_received'],
                ':id'            =>    $_POST['material_id']
            )
        ); 
        echo '<div class="alert alert-info text-center">Report has been updated successfully</div>';
    }
}
