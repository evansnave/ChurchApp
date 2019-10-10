<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "INSERT INTO tithes (accountant_name, date_entered, member_id, amount) VALUES (:accountant_name, :date_entered, :member_id, :amount)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':date_entered'   =>    trim($_POST["date_entered"]),
                ':accountant_name' =>    trim($_POST["accountant_name"]),
                ':member_id'   =>    trim($_POST["member_id"]),
                ':amount'  =>    trim($_POST["amount"]),
                
            )
        );
        echo '<div class="alert alert-info text-center">' . $_POST["accountant_name"] . ' has  added tithe to our database</div>';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM tithes WHERE id = :id";
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
            $output['member_id']      = $row['member_id'];
            $output['amount']            = $row['amount'];
            
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE tithes SET 
                accountant_name    = '" . trim($_POST["accountant_name"]) . "',
                date_entered     = '" . trim($_POST["date_entered"]) . "',
                member_id     = '" . trim($_POST["member_id"]) . "',
                amount     = '" . trim($_POST["amount"]) . "'
			WHERE id = '" . $_POST["id"] . "'";
        
        $statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center">' . $_POST["accountant_name"] . ' has edited tithe successfully</div>';
    }
}
