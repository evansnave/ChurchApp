<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "INSERT INTO offerings (accountant_name, date_entered, offering_type, amount) VALUES (:accountant_name, :date_entered, :offering_type, :amount)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':accountant_name' =>    trim($_POST["accountant_name"]),
                ':date_entered'   =>    trim($_POST["date_entered"]),
                ':offering_type'   =>    trim($_POST["offering_type"]),
                ':amount'  =>    trim($_POST["amount"]),
                
            )
        );
        echo '<div class="alert alert-info text-center">' . $_POST["accountant_name"] . ' has  added offertory to our database</div>';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM offerings WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['accountant_name']   = $row['accountant_name'];
            $output['date_entered']      = $row['date_entered'];
            $output['offering_type']      = $row['offering_type'];
            $output['amount']            = $row['amount'];
            
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE offerings SET 
                accountant_name    = '" . trim($_POST["accountant_name"]) . "',
                date_entered     = '" . trim($_POST["date_entered"]) . "',
                offering_type     = '" . trim($_POST["offering_type"]) . "',
                amount     = '" . trim($_POST["amount"]) . "'
			WHERE id = '" . $_POST["id"] . "'";
        
        $statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center">' . $_POST["accountant_name"] . ' has edited offertory successfully</div>';
    }
}
