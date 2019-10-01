<?php
include('connection.php');

if (isset($_POST['btn_action'])) {
    if ($_POST['btn_action'] == 'Add') 
    {
        $name_of_program = strip_tags($_POST["name_of_program"]);
        $date_of_program = $_POST["date_of_program"];
        $attendance_target = $_POST["attendance_target"];

        $query = "INSERT INTO programs (name_of_program, date_of_program, attendance_target) 
            VALUES (:name_of_program,  :date_of_program, :attendance_target) ";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':name_of_program'      =>    $name_of_program,
                ':date_of_program'      =>    $date_of_program,
                ':attendance_target'    =>    $attendance_target,
            )
        );
        if ($statement) {
            $table_name = 'program_'. strtotime($_POST['date_of_program']);
            $create_table = "CREATE TABLE `$table_name` 
            (
                id INT (11) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
                name_of_invitee VARCHAR(30) NOT NULL,
                phone_number VARCHAR(20) UNIQUE NOT NULL,
                residence VARCHAR(255) NOT NULL,
                cell INT (6) NOT NULL,
                invitee_status ENUM ('active','inactive') NOT NULL,
                date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
            )";
            $db->exec($create_table);   
        }
        echo $_POST["name_of_program"] . ' has been created successfully';
    }

    if ($_POST['btn_action'] == 'fetch_single') {
        $query = "SELECT * FROM programs WHERE program_id = :program_id";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':program_id'    =>    $_POST["program_id"]
            )
        );
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output['name_of_program']      = $row['name_of_program'];
            $output['date_of_program']      = $row['date_of_program'];
            $output['attendance_target']    = $row['attendance_target'];
        }
        echo json_encode($output);
    }

    if ($_POST['btn_action'] == 'Edit') {
            $query = "UPDATE programs 
                SET	date_of_program     = '" . trim($_POST["date_of_program"]) . "', 
                    name_of_program     = '" . trim($_POST["name_of_program"]) . "',
                    attendance_target   = '" . $_POST['attendance_target'] . "'
				WHERE program_id = '" . $_POST["program_id"] . "'
			";
        $statement = $db->prepare($query);
        $statement->execute();
        echo  $_POST["name_of_program"] . ' has been updated';
    }
}
