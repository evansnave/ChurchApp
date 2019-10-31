<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "INSERT INTO families (family_head) VALUES (:family_head)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
               
                ':family_head'  =>    trim($_POST["family_head"]),
            )
        );

        if ($statement) {
            $user_id = $_POST['family_head'];
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

        echo '<div class="alert alert-info text-center">' . $_POST["family_head"] . ' has been added to our database</div>';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM families WHERE id = :cell_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':cell_id'    =>    $_POST["cell_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['family_head']      = $row['family_head'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE families SET 
                family_head     = '" . trim($_POST["family_head"]) . "'
			WHERE id = '" . $_POST["cell_id"] . "'";
        
        $statement = $db->prepare($query);
        $statement->execute();

        $user_id = $_POST['family_head'];
        $cell_id = $_POST['cell_id'];
        $update = "UPDATE members SET cell = $cell_id  WHERE id = $user_id";
        $statement = $db->prepare($update);
        $statement->execute();

        echo '<div class="alert alert-info text-center">' . $_POST["family_head"] . ' has been edited successfully</div>';
    }
}
