<?php
session_start();
include('connection.php');

include('../helpers/functions.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        
        if ($_SESSION['role'] == 'cell_leader') {
            $cell_id = $_SESSION['cell_id'];
        }else {
            $cell_id = '0';
        }

        if ($_POST['family_head'] === 'yes') {
            $query = "INSERT INTO families (family_head) VALUES (:family_head)";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':family_head'  =>    trim($_POST["fullname"]),
                )
            );
        }
        $family_id = $db->lastInsertId();
        
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `members` WHERE member_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count >= 1) {
            echo '<div class="alert alert-danger text-center">' . $_POST['fullname'] . ' already exists in our database</div>';
        } else {
            $query = "INSERT INTO members (title, fullname, phone_number, residence, gender, age, marital_status,occupation,foundation_school, baptism ,dob,year_joined,cell,department,ministries,families) 
				VALUES (:title, :fullname, :phone_number, :address,:gender, :age, :marital_status, :occupation, :foundation_school, :baptism, :dob,:year_joined,:cell,:department,:ministries,:families)
				";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':title'                =>    $_POST['title'],
                    ':fullname'             =>    $_POST['fullname'],
                    ':phone_number'         =>    $_POST['phone_number'],
                    ':address'              =>    $_POST['address'],
                    ':gender'               =>    $_POST['gender'],
                    ':age'                  =>    $_POST['age'],
                    ':marital_status'       =>    $_POST['marital_status'],
                    ':occupation'           =>    $_POST['occupation'],
                    ':foundation_school'    =>    $_POST['foundation_school'],
                    ':baptism'              =>    $_POST['baptism'],
                    ':dob'                  =>    $_POST['dob'],
                    ':year_joined'          =>    $_POST['year_joined'],
                    ':cell'                 =>    $cell_id,
                    ':department'           =>    $_POST['department'],
                    ':ministries'           =>    $_POST['ministries'],
                    ':families'           =>    $family_id,
                )
            );

            $member_id = $db->lastInsertId();
            $insert_member = "INSERT INTO `members_attendance` (`member_id`) VALUES (:member_id)";
            $statement = $db->prepare($insert_member);
            $statement->execute(
                array(
                    ':member_id' => $member_id 
                )
            );

            if ($_SESSION['role'] == 'official') {
                $date = strtotime(date('Y-m-d'));
                $present = date('H:i:s');
                $query = "UPDATE members_attendance SET `$date` = :present WHERE member_id =:member_id";
                $stmt = $db->prepare($query);
                $stmt->execute(
                    array(
                        ':member_id'   => $member_id,
                        ':present'       => $present
                    )
                );
            }

            echo '<div class="alert alert-info text-center">' . $_POST['fullname'] . ' has been added to our database.</div>';
        }
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM members WHERE id = :id";
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
            $output['phone_number']         = $row['phone_number'];
            $output["address"]              = $row["residence"];
            $output['gender']               = $row['gender'];
            $output['age']                  = $row['age'];
            $output['marital_status']       = $row['marital_status'];
            $output['occupation']           = $row['occupation'];
            $output['foundation_school']    = $row['foundation_school'];
            $output['baptism']              = $row['baptism'];
            $output['dob']                  = $row['dob'];
            $output['year_joined']          = $row['year_joined'];
            $output['cell']                 = $row['cell'];
            $output['department']           = $row['department'];
            $output['ministries']           = $row['ministries'];
            // $output['families']             = $row['families'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        if ($_SESSION['role'] == 'cell_leader') {
            $cell_id = $_SESSION['cell_id'];
        } else {
            $cell_id = '';
        }
        $query = "UPDATE members 
                SET title               = :title,
                    fullname            = :fullname,
                    phone_number        = :phone_number,
                    residence           = :residence,
                    gender              = :gender,
                    age                 = :age,
                    marital_status      = :marital_status,
                    occupation          = :occupation,
                    foundation_school   = :foundation_school,
                    baptism             = :baptism,
                    dob                 = :dob,
                    year_joined         = :year_joined,
                    cell                = :cell,
                    department          = :department,
                    ministries          = :ministries
                WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':title'                =>    $_POST['title'],
                ':fullname'             =>    $_POST['fullname'],
                ':phone_number'         =>    $_POST['phone_number'],
                ':residence'            =>    $_POST['address'],
                ':gender'               =>    $_POST['gender'],
                ':age'                  =>    $_POST['age'],
                ':marital_status'       =>    $_POST['marital_status'],
                ':occupation'           =>    $_POST['occupation'],
                ':foundation_school'    =>    $_POST['foundation_school'],
                ':baptism'              =>    $_POST['baptism'],
                ':dob'                  =>    $_POST['dob'],
                ':year_joined'          =>    $_POST['year_joined'],
                ':cell'                 =>    $cell_id,
                ':department'           =>    $_POST['department'],
                ':ministries'           =>    $_POST['ministries'],
                ':id'                   =>    $_POST['id']
            )
        );
        echo '<div class="alert alert-info text-center">'.$_POST["fullname"].' has been updated successfully</div>';
    }
}
