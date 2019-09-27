<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    $program_name = 'program_'.$_GET['date'];
    if ($_POST['btn_action'] == 'Add') {
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `$program_name` WHERE invitee_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count >= 1) {
            echo '<div class="alert alert-danger text-center">' . $_POST['name_of_invitee'] . ' already exists in our database</div>';
        } else {
        $query = "INSERT INTO `$program_name` (name_of_invitee, phone_number, residence, cell) 
            VALUES (:name_of_invitee, :phone_number, :residence, :cell) ";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':name_of_invitee'      =>    trim($_POST["name_of_invitee"]),
                ':phone_number'         =>    trim($_POST["phone_number"]),
                ':residence'            =>    trim($_POST["residence"]),
                ':cell'                 =>    $_POST["cell"]
            )
        );

        
        echo '<div class="alert alert-info text-center">Thank you for inviting '.$_POST["name_of_invitee"].'</div>';
        }
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM `$program_name` WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['name_of_invitee']  = $row['name_of_invitee'];
            $output['residence']        = $row['residence'];
            $output['phone_number']     = $row['phone_number'];
            $output['cell']             = $row['cell'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $query = "UPDATE `$program_name` 
            SET residence          = '" . trim($_POST["residence"]) . "', 
                name_of_invitee    = '" . trim($_POST["name_of_invitee"]) . "',
                phone_number       = '" . trim($_POST["phone_number"]) . "', 
                cell               = '" . $_POST['cell'] . "' 
            WHERE id = '" . $_POST["id"] . "' ";
        $statement = $db->prepare($query);
        $statement->execute();
        echo  $_POST["name_of_invitee"] . ' has been updated';
    }
}
