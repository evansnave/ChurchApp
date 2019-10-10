<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $query = "INSERT INTO fundraising (accountant_name, date_entered, amount, fundraising_type) VALUES (:accountant_name, :date_entered, :amount, :fundraising_type)";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':accountant_name' =>    trim($_POST["accountant_name"]),
                ':date_entered'   =>    trim($_POST["date_entered"]),
                ':amount'  =>    trim($_POST["amount"]),
                ':fundraising_type'  =>    trim($_POST["fundraising_type"]),
                
            )
        );
        echo '<div class="alert alert-info text-center">' . $_POST["accountant_name"] . ' has  added a fundraising to our database</div>';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM fundraising WHERE id = :id";
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
            $output['amount']            = $row['amount'];
            $output['fundraising_type']  = $row['fundraising_type'];
            
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE fundraising SET 
                accountant_name    = '" . trim($_POST["accountant_name"]) . "',
                date_entered     = '" . trim($_POST["date_entered"]) . "',
                amount     = '" . trim($_POST["amount"]) . "',
            fundraising_type     = '" . trim($_POST["fundraising_type"]) . "'
			WHERE id = '" . $_POST["id"] . "'";
        
        $statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center">' . $_POST["accountant_name"] . ' has edited the fundraising successfully</div>';
    }
}
