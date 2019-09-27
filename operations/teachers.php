<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `foundation_school_teachers` WHERE phone_number = '$phone_number' AND teacher_status ='active'";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count >= 1) {
            echo '<div class="alert alert-danger text-center">' . $phone_number . ' has already been used </div>';
        } else {
            $query = "INSERT INTO foundation_school_teachers (fullname, phone_number) 
				VALUES (:fullname, :phone_number) ";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':fullname'            =>    trim($_POST["fullname"]),
                    ':phone_number'        =>    $phone_number
                )
            );
            echo '<div class="alert alert-info text-center"> ' . $_POST["fullname"] . ' added successfully </div>';
        }
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM foundation_school_teachers WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['fullname']         = $row['fullname'];
            $output['phone_number']     = $row['phone_number'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $phone_number =  $_POST['phone_number'];
        $query = "UPDATE foundation_school_teachers 
                SET	phone_number    = '" . trim($_POST["phone_number"]) . "', 
                    fullname        = '" . trim($_POST["fullname"]) . "'
                WHERE id = '" . $_POST["id"] . "'
        ";
        $statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center"> ' . $_POST["fullname"] . ' updated successfully </div>';
    }
}
