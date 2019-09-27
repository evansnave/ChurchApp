<?php
include('../operations/connection.php');

if (isset($_POST['btn_action3'])) {
    if ($_POST['btn_action3'] == 'Add') {
        $query = "INSERT INTO activity_groups_joined(first_timer, group_joined) 
        VALUES (:first_timer, :group_joined)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':first_timer'  =>    $_POST['first_timer'],
                ':group_joined' =>    $_POST['group_joined'],
            )
        );
        echo '<div class="alert alert-success text-center" > Report submitted successfully. </div>';
    }

    if ($_POST['btn_action3'] == 'fetch_single') {
        $query = "SELECT * FROM activity_groups_joined WHERE id = :group_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':group_id'    =>    $_POST["group_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['group_joined']  = $row['group_joined'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action3'] == 'Edit') {
        $query = "UPDATE activity_groups_joined SET 
                group_joined = '" . trim($_POST["group_joined"]) . "'
			WHERE id = '" . $_POST["group_id"] . "'";

        $statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center" >Report has been updated successfully</div>';
    }
}
