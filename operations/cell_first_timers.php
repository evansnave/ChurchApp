<?php
include('connection.php');
include('../helpers/functions.php');

if (isset($_POST['btn_action']))
{
    if ($_POST['btn_action'] == 'Add') 
    {
        $phone_number = $_POST['phone_number'];
        $query = "SELECT * FROM `cell_first_timers` WHERE firstTimer_status ='active' AND phone_number = $phone_number";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        $date = date('Y-m-d');
        if ($count > 1) {
            echo '<div class="alert alert-danger text-center">' . $_POST['fullname'] . ' already exists in the database</div>';
        } else {
            $query = "INSERT INTO cell_first_timers (cell,fullname, phone_number, residence, gender, age, marital_status,occupation,invited_by, inviters_contact ,born_again,born_again_when,membership,if_no_why,visitation,if_yes_when,prayer_request,date_added) 
			VALUES (:cell,:fullname, :phone_number, :address,:gender, :age, :marital_status, :occupation, :invited_by, :inviters_contact, :born_again,:when_born_again,:membership,:if_no_why,:visitation,:if_yes_when,:prayer_request,:date_added)
			";
            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':cell'                 =>    $_POST['cell'],
                    ':fullname'             =>    $_POST['fullname'],
                    ':phone_number'         =>    $_POST['phone_number'],
                    ':address'              =>    $_POST['address'],
                    ':gender'               =>    $_POST['gender'],
                    ':age'                  =>    $_POST['age'],
                    ':marital_status'       =>    $_POST['marital_status'],
                    ':occupation'           =>    $_POST['occupation'],
                    ':invited_by'           =>    $_POST['invited_by'],
                    ':inviters_contact'     =>    $_POST['inviters_contact'],
                    ':born_again'           =>    $_POST['born_again'],
                    ':when_born_again'      =>    $_POST['when_born_again'],
                    ':membership'           =>    $_POST['membership'],
                    ':if_no_why'            =>    $_POST['if_no_why'],
                    ':visitation'           =>    $_POST['visitation'],
                    ':if_yes_when'          =>    $_POST['if_yes_when'],
                    ':prayer_request'       =>    $_POST['prayer_request'],
                    ':date_added'           =>    $date
                )
            );
            echo '<div class="alert alert-success text-center" >' . $_POST['fullname'] . ' has been added to the database</div>';
        }
    }
}
