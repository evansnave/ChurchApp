<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "INSERT INTO cells (name_of_cell, cell_venue, cell_leader, email_address) VALUES (:name_of_cell, :cell_venue, :cell_leader, :email_address)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':name_of_cell' =>    trim($_POST["name_of_cell"]),
                ':cell_venue'   =>    trim($_POST["cell_venue"]),
                ':cell_leader'  =>    trim($_POST["cell_leader"]),
                ':email_address'=>    trim($_POST["email_address"]),
            )
        );

        if ($statement) {
            $user_id = $_POST['cell_leader'];
            $cell_id = $db->lastInsertId();
            $update = "UPDATE members SET cell = $cell_id  WHERE id = $user_id";
            $statement = $db->prepare($update);
            $statement->execute();

            // $query = "INSERT INTO accounts (username, account_password, account_name, account_role) 
            // VALUES (:username, :account_password, :account_name, :account_role) ";
            // $statement = $db->prepare($query);
            // $statement->execute(
            //     array(
            //         ':username'            =>    trim($_POST["username"]),
            //         ':account_password'    =>    password_hash($_POST["account_password"], PASSWORD_BCRYPT),
            //         ':account_name'        =>    trim($_POST["account_name"]),
            //         ':account_role'        =>    $_POST["account_role"]
            //     )
            // );
        }

        echo '<div class="alert alert-info text-center">' . $_POST["name_of_cell"] . ' has been added to our database</div>';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM cells WHERE id = :cell_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':cell_id'    =>    $_POST["cell_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['name_of_cell']     = $row['name_of_cell'];
            $output['cell_leader']      = $row['cell_leader'];
            $output['cell_venue']       = $row['cell_venue'];
            $output['email_address']    = $row['email_address'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE cells SET 
                name_of_cell    = '" . trim($_POST["name_of_cell"]) . "',
                cell_leader     = '" . trim($_POST["cell_leader"]) . "',
                cell_venue      = '" . trim($_POST["cell_venue"]) . "',
                email_address   = '" . trim($_POST["email_address"]) . "'
			WHERE id = '" . $_POST["cell_id"] . "'";
        
        $statement = $db->prepare($query);
        $statement->execute();

        $user_id = $_POST['cell_leader'];
        $cell_id = $_POST['cell_id'];
        $update = "UPDATE members SET cell = $cell_id  WHERE id = $user_id";
        $statement = $db->prepare($update);
        $statement->execute();

        echo '<div class="alert alert-info text-center" style="color:#000">' . $_POST["name_of_cell"] . ' has been edited successfully</div>';
    }
}
