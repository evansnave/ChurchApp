<?php
include('connection.php');
if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "INSERT INTO leaders (leadership_title, member_id) VALUES (:title, :leader)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':title' =>    trim($_POST["title"]),
                ':leader'   =>    trim($_POST["leader"]),
            )
        );
        echo '<div class="alert alert-info text-center">Leader has been added to our database</div>';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM leaders WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['title']     = $row['leadership_title'];
            $output['leader']      = $row['member_id'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE leaders SET 
                member_id            = '" . trim($_POST["leader"]) . "',
                leadership_title     = '" . trim($_POST["title"]) . "'
			WHERE id = '" . $_POST["id"] . "'";
        $statement = $db->prepare($query);
        $statement->execute();

        echo '<div class="alert alert-info text-center">Leader has been edited successfully</div>';
    }
}
