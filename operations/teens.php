<?php
session_start();
include('connection.php');

include('../helpers/functions.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `teens` WHERE member_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count >= 1) {
            echo '<div class="alert alert-danger text-center">' . $_POST['fullname'] . ' already exists in our database</div>';
        } else {
            $query = "INSERT INTO teens (title, fullname, guardian_name, phone_number, residence, gender, age, baptism, dob,year_joined) 
				VALUES (:title, :fullname, :guardian_name, :phone_number, :address,:gender, :age, :baptism, :dob,:year_joined)
				";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':title'                =>    $_POST['title'],
                    ':fullname'             =>    $_POST['fullname'],
                    ':guardian_name'        =>    $_POST['guardian_name'],
                    ':phone_number'         =>    $_POST['phone_number'],
                    ':address'              =>    $_POST['address'],
                    ':gender'               =>    $_POST['gender'],
                    ':age'                  =>    $_POST['age'],
                    ':baptism'              =>    $_POST['baptism'],
                    ':dob'                  =>    $_POST['dob'],
                    ':year_joined'          =>    $_POST['year_joined'],
                )
            );

            echo '<div class="alert alert-info text-center">' . $_POST['fullname'] . ' has been added to our database.</div>';
        }
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM teens WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['title']                = $row['title'];
            $output['fullname']             = $row['fullname'];
            $output['guardian_name']         = $row['guardian_name'];
            $output['phone_number']         = $row['phone_number'];
            $output["address"]              = $row["residence"];
            $output['gender']               = $row['gender'];
            $output['age']                  = $row['age'];
            $output['baptism']              = $row['baptism'];
            $output['dob']                  = $row['dob'];
            $output['year_joined']          = $row['year_joined'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
      
        $query = "UPDATE teens
                SET title               = :title,
                    fullname            = :fullname,
                    guardian_name       = :guardian_name,
                    phone_number        = :phone_number,
                    residence           = :residence,
                    gender              = :gender,
                    age                 = :age,
                    baptism             = :baptism,
                    dob                 = :dob,
                    year_joined         = :year_joined

                WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':title'                =>    $_POST['title'],
                ':fullname'             =>    $_POST['fullname'],
                ':guardian_name'        =>    $_POST['guardian_name'],
                ':phone_number'         =>    $_POST['phone_number'],
                ':residence'            =>    $_POST['address'],
                ':gender'               =>    $_POST['gender'],
                ':age'                  =>    $_POST['age'],
                ':baptism'              =>    $_POST['baptism'],
                ':dob'                  =>    $_POST['dob'],
                ':year_joined'          =>    $_POST['year_joined'],
                ':id'                   =>    $_POST['id']
            )
        );
        echo '<div class="alert alert-info text-center">'.$_POST["fullname"].' has been updated successfully</div>';
    }
}
