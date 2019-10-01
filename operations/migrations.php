<?php
session_start();
include('connection.php');

include('../helpers/functions.php');


if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') {
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `first_timers` WHERE firstTimer_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        $date = date('Y-m-d');
        if ($count > 1) {
            echo '<div class="alert alert-danger text-center" style="color:#fff">' . $_POST['fullname'] . ' already exists in the database</div>';
        } else {
            $query = "INSERT INTO first_timers (fullname, phone_number, residence, gender, age, marital_status,occupation,invited_by, inviters_contact ,born_again,born_again_when,membership,if_no_why,visitation,if_yes_when,prayer_request,date_added,senior_cell) 
				VALUES (:fullname, :phone_number, :address,:gender, :age, :marital_status, :occupation, :invited_by, :inviters_contact, :born_again,:when_born_again,:membership,:if_no_why,:visitation,:if_yes_when,:prayer_request,:date_added,:senior_cell)
				";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':fullname'         =>    $_POST['fullname'],
                    ':phone_number'     =>    $_POST['phone_number'],
                    ':address'          =>    $_POST['address'],
                    ':gender'           =>    $_POST['gender'],
                    ':age'              =>    $_POST['age'],
                    ':marital_status'   =>    $_POST['marital_status'],
                    ':occupation'       =>    $_POST['occupation'],
                    ':invited_by'       =>    $_POST['invited_by'],
                    ':inviters_contact' =>    $_POST['inviters_contact'],
                    ':born_again'       =>    $_POST['born_again'],
                    ':when_born_again'  =>    $_POST['when_born_again'],
                    ':membership'       =>    $_POST['membership'],
                    ':if_no_why'        =>    $_POST['if_no_why'],
                    ':visitation'       =>    $_POST['visitation'],
                    ':if_yes_when'      =>    $_POST['if_yes_when'],
                    ':prayer_request'   =>    $_POST['prayer_request'],
                    ':senior_cell'      =>    $_POST['senior_cell'],
                    ':date_added'       =>    $date
                )
            );

            $first_timer_id = $db->lastInsertId();
            $insert_member = "INSERT INTO `first_timers_attendance` (`first_timer_id`) VALUES (:first_timer_id)";
            $statement = $db->prepare($insert_member);
            $statement->execute(
                array(
                    ':first_timer_id' => $first_timer_id
                )
            );

            echo '<div class="alert alert-info text-center">' . $_POST['fullname'] . ' has been added to our database. We would send an SMS soon </div>';

        }
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM first_timers WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':id'    =>    $_POST["id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['fullname']             = $row['fullname'];
            $output['phone_number']         = $row['phone_number'];
            $output["address"]              = $row["residence"];
            $output['gender']               = $row['gender'];
            $output['age']                  = $row['age'];
            $output['marital_status']       = $row['marital_status'];
            $output['occupation']           = $row['occupation'];
            $output['invited_by']           = $row['invited_by'];
            $output['inviters_contact']     = $row['inviters_contact'];
            $output['born_again']           = $row['born_again'];
            $output['born_again_when']      = $row['born_again_when'];
            $output['membership']           = $row['membership'];
            $output['if_no_why']            = $row['if_no_why'];
            $output['visitation']           = $row['visitation'];
            $output['if_yes_when']          = $row['if_yes_when'];
            $output['prayer_request']       = $row['prayer_request'];
            $output['year_joined']          = date('Y', strtotime($row['date_added']) );
            $output['cell']                 = $row['senior_cell'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `members` WHERE member_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        $date = date('Y-m-d');
        if ($count > 1) {
            echo '<div class="alert alert-danger text-center">' . $_POST['fullname'] . ' already exists in the members database</div>';
        } else {
            $query = "INSERT INTO members (title, fullname, phone_number, residence, gender, age, marital_status,occupation,foundation_school, baptism ,dob,year_joined,cell) 
				VALUES (:title, :fullname, :phone_number, :address,:gender, :age, :marital_status, :occupation, :foundation_school, :baptism, :dob,:year_joined,:cell)
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
                    ':cell'                 =>    $_POST['cell'],
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

            $first_timer_id = $_POST['id'];
            $logger_stats = 'migrated';
            $query = "UPDATE service_logger SET logger_stats = :logger_stats WHERE first_timer_id =:first_timer_id";
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ':first_timer_id'   => $first_timer_id,
                    ':logger_stats'       => $logger_stats
                )
            );

            $delete_first_timer = "DELETE FROM  `first_timers_attendance` WHERE first_timer_id = :first_timer_id";
            $statement = $db->prepare($delete_first_timer);
            $statement->execute(
                array(
                    ':first_timer_id' => $first_timer_id
                )
            );

        echo '<div class="alert alert-info text-center" >'.$_POST['fullname'].' has been migrated successfully</div>';
        }
    }
}    
