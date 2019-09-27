<?php
session_start();
include('connection.php');
include('../helpers/sms.php');
include('../helpers/functions.php');

if (isset($_POST['btn_action1'])) {
    if ($_POST['btn_action1'] == 'Add') {
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `first_timers` WHERE firstTimer_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        $date = date('Y-m-d');
        if ($count > 1) {
            echo '<div class="alert alert-danger text-center" style="color:#fff">' . $_POST['fullname'] . ' already exists in our database</div>';
        } else {
            $name = $_POST['fullname'];
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
            if ($_SESSION['role'] == 'official') {
                $present = date('H:i:s');
                $today = date('Y-m-d');
                $date = strtotime($today);
                $query = "UPDATE first_timers_attendance SET `$date` = :present WHERE first_timer_id =:first_timer_id";
                $stmt = $db->prepare($query);
                $stmt->execute(
                    array(
                        ':first_timer_id'   => $first_timer_id,
                        ':present'       => $present
                    )
                );

                if ($stmt) {
                    $query = "INSERT INTO service_attendance (first_timer, service_day) 
                        VALUES (:first_timer, :service_day)";
                    $statement = $db->prepare($query);
                    $statement->execute(
                        array(
                            ':first_timer'  =>    $first_timer_id,
                            ':service_day'  =>    $today,
                        )
                    );
                }
                $service_logger = "SELECT * FROM service_logger WHERE first_timer_id = $first_timer_id";
                $statement = $db->prepare($service_logger);
                $statement->execute();
                $counter = $statement->rowCount();

                if ($counter > 0) {
                    $fetch = $statement->fetch();
                    $service_count = $fetch['service_count'] + 1;

                    $query = "UPDATE service_logger SET service_count = :service_count WHERE first_timer_id =:first_timer_id";
                    $stmt = $db->prepare($query);
                    $stmt->execute(
                        array(
                            ':first_timer_id'   => $first_timer_id,
                            ':service_count'       => $service_count
                        )
                    );
                } else {
                    $query = "INSERT INTO service_logger (first_timer_id, service_count) 
                    VALUES (:first_timer_id, :service_count)";
                    $statement = $db->prepare($query);
                    $statement->execute(
                        array(
                            ':first_timer_id'  =>    $first_timer_id,
                            ':service_count'  =>    1,
                        )
                    );
                }
            }

            echo '<div class="alert alert-info text-center">' . $name . ' has been added to our database. We would send an SMS soon </div>';
            $message = "Dear $name thank you for worshipping with us. We tust you enjoyed the service";
            sendSms($phone_number,$message);
        }
    }

    if ($_POST['btn_action1'] == 'fetch_single') {
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
            $output["residence"]            = $row["residence"];
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
            $output['cell']                 = $row['cell'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action1'] == 'Edit') {
        $query = "UPDATE first_timers set senior_cell = :senior_cell WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':senior_cell'    =>    $_POST['senior_cell'],
                ':id'            =>    $_GET['id'],
            )
        );
        echo '<div class="alert alert-info text-center" >Senior Cell has been assigned</div>';
    }
}
