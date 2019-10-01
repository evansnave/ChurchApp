<?php
include('connection.php');

if (isset($_POST['btn_action101'])) {
    if ($_POST['btn_action101'] == 'Add') {
        $query = "INSERT INTO foundation_school_report(first_timer, date_attended, class, teacher) 
            VALUES (:first_timer, :date_attended, :class,:teacher)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':first_timer'      =>    $_POST['first_timer'],
                ':date_attended'    =>    $_POST['date_attended'],
                ':class'            =>    $_POST['class'],
                ':teacher'          =>    $_POST['teacher'],
            )
        );
        echo '<div class="alert alert-info text-center"> Report submitted successfully. </div>';
    }

    if ($_POST['btn_action101'] == 'fetch_single') {
        $query = "SELECT * FROM foundation_school_report WHERE id = :fs_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':fs_id'    =>    $_POST["fs_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['date_attended']     = $row['date_attended'];
            $output['class']             = $row['class'];
            $output['teacher']           = $row['teacher'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action101'] == 'Edit') {
        $query = "UPDATE foundation_school_report
            SET date_attended   = :date_attended,
                class           = :class,
                teacher         = :teacher
            WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':date_attended'    =>    $_POST['date_attended'],
                ':class'            =>    $_POST['class'],
                ':teacher'          =>    $_POST['teacher'],
                ':id'               =>    $_POST['fs_id']
            )
        );
        echo '<div class="alert alert-info text-center">Report has been updated successfully</div>';
    }
}
