<?php
session_start();
include('connection.php');

include('../helpers/functions.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        // if ($_SESSION['role'] == 'cell_leader') {
        //     $cell_id = $_SESSION['cell_id'];
        // }else {
        //     $cell_id = $_POST['cell'];
        // }
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `child_dedication` WHERE member_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count >= 1) {
            echo '<div class="alert alert-danger text-center">' . $_POST['child_name'] . ' already exists in our database</div>';
        } else {
            $query = "INSERT INTO child_dedication (child_name, dob, gender, age, pob, fathers_name, fathers_church, f_department, f_cell, fdba, f_address, f_nationality, phone_number,
                                                    mothers_name, mothers_church, m_department, m_cell, mdba, m_address, m_nationality, m_phone_number, marital_status) 
				VALUES (:child_name, :dob, :gender, :age,:pob, :fathers_name, :fathers_church, :f_department, :f_cell, :fdba, :f_address,:f_nationality,:phone_number,
                        :mothers_name,:mothers_church, :m_department, :m_cell, :mdba, :m_address, :m_nationality, :m_phone_number, :marital_status)
				";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':child_name'           =>    $_POST['child_name'],
                    ':dob'                  =>    $_POST['dob'],
                    ':gender'               =>    $_POST['gender'],
                    ':age'                  =>    $_POST['age'],
                    ':pob'                  =>    $_POST['pob'],
                    ':fathers_name'         =>    $_POST['fathers_name'],
                    ':fathers_church'       =>    $_POST['fathers_church'],
                    ':f_department'         =>    $_POST['f_department'],
                    ':f_cell'               =>     $_POST['f_cell'],
                    ':fdba'                 =>    $_POST['fdba'],
                    ':f_address'            =>    $_POST['f_address'],
                    ':f_nationality'        =>    $_POST['f_nationality'],
                    ':phone_number'         =>    $_POST['phone_number'],      
                    ':mothers_name'         =>    $_POST['mothers_name'],
                    ':mothers_church'       =>    $_POST['mothers_church'],
                    ':m_department'         =>    $_POST['m_department'],
                    ':m_cell'               =>    $_POST['m_cell'],
                    ':mdba'                 =>    $_POST['mdba'],
                    ':m_address'            =>    $_POST['m_address'],
                    ':m_nationality'        =>    $_POST['m_nationality'],
                    ':m_phone_number'       =>    $_POST['m_phone_number'],
                    ':marital_status'       =>    $_POST['marital_status'],
                )
            );

         

           

            echo '<div class="alert alert-info text-center">' . $_POST['child_name'] . ' has been added to our database.</div>';
        }
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM child_dedication WHERE member_id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['child_name']           = $row['child_name'];
            $output['dob']                  = $row['dob'];
            $output['gender']               = $row['gender'];
            $output['age']                  = $row['age'];
            $output["pob"]                  = $row["pob"];
            $output["fathers_name"]         = $row["fathers_name"];
            $output["fathers_church"]       = $row["fathers_church"];
            $output['f_department']         = $row['f_department'];
            $output['f_cell']               = $row['f_cell'];
            $output['fdba']                 = $row['fdba'];
            $output['f_address']            = $row['f_address'];
            $output['f_nationality']        = $row['f_nationality'];
            $output['phone_number']         = $row['phone_number'];
            $output['mothers_name']         = $row['mothers_name'];
            $output['mothers_church']       = $row['mothers_church'];
            $output['m_department']         = $row['m_department'];
            $output['m_cell']               = $row['m_cell'];
            $output['mdba']                 = $row['mdba'];
            $output['m_address']            = $row['m_address'];
            $output['m_nationality']        = $row['m_nationality'];
            $output['m_phone_number']       = $row['m_phone_number'];
            $output['marital_status']       = $row['marital_status'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        // if ($_SESSION['role'] == 'cell_leader') {
        //     $cell_id = $_SESSION['cell_id'];
        // } else {
        //     $cell_id = $_POST['cell'];
        // }
        $query = "UPDATE child_dedication 
                SET child_name          = :child_name,
                    dob                 = :dob,
                    gender              = :gender,
                    age                  = :age,
                    pob                  = :pob,
                    fathers_name         = :fathers_name,
                    fathers_church       = :fathers_church,
                    f_department        = :f_department,
                    f_cell               = :f_cell,
                    fdba                 = :fdba,
                    f_address            = :f_address,
                    f_nationality        = :f_nationality,
                    phone_number         = :phone_number,      
                    mothers_name         = :mothers_name,
                    mothers_church       = :mothers_church,
                    m_department         = :m_department,
                    m_cell               = :m_cell,
                    mdba                 = :mdba,
                    m_address            = :m_address,
                    m_nationality        = :m_nationality,
                    m_phone_number       = :m_phone_number,
                    marital_status       = :marital_status

                WHERE member_id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                    ':child_name'           =>    $_POST['child_name'],
                    ':dob'                  =>    $_POST['dob'],
                    ':gender'               =>    $_POST['gender'],
                    ':age'                  =>    $_POST['age'],
                    ':pob'                  =>    $_POST['pob'],
                    ':fathers_name'         =>    $_POST['fathers_name'],
                    ':fathers_church'       =>    $_POST['fathers_church'],
                    ':f_department'         =>    $_POST['f_department'],
                    ':f_cell'               =>     $_POST['f_cell'],
                    ':fdba'                 =>    $_POST['fdba'],
                    ':f_address'            =>    $_POST['f_address'],
                    ':f_nationality'        =>    $_POST['f_nationality'],
                    ':phone_number'         =>    $_POST['phone_number'],      
                    ':mothers_name'         =>    $_POST['mothers_name'],
                    ':mothers_church'       =>    $_POST['mothers_church'],
                    ':m_department'         =>    $_POST['m_department'],
                    ':m_cell'               =>    $_POST['m_cell'],
                    ':mdba'                 =>    $_POST['mdba'],
                    ':m_address'            =>    $_POST['m_address'],
                    ':m_nationality'        =>    $_POST['m_nationality'],
                    ':m_phone_number'       =>    $_POST['m_phone_number'],
                    ':marital_status'       =>    $_POST['marital_status'],
                    ':id'                   =>    $_POST['id']
            )
        );
        echo '<div class="alert alert-info text-center">'.$_POST["child_name"].' has been updated successfully</div>';
    }
}
