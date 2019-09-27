<?php
include('connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$account_name = trim(str_replace(" ", "", $_POST['account_name']));
		$query = "SELECT * FROM `accounts` WHERE account_name = '$account_name' ";
		$statement = $db->prepare($query);
		$statement->execute();
		$count = $statement->rowCount();
		if ($count >= 1) {
			echo '<div class="alert alert-danger text-center">The username ' . $account_name . ' has already been used </div>';
		} else {
			$query = "INSERT INTO accounts (username, account_password, account_name, account_role, cell) 
				VALUES (:username, :account_password, :account_name, :account_role, :cell) ";	
			$statement = $db->prepare($query);
			$statement->execute(
				array(
					':username'			=>	trim($_POST["username"]),
					':account_password'	=>	password_hash($_POST["account_password"], PASSWORD_BCRYPT),
					':account_name'		=>	$account_name,
					':account_role'		=>	$_POST["account_role"],
					':cell'				=>	$_POST["cell"],
				)
			);
			echo '<div class="alert alert-info text-center">New user ' . $account_name . ' was created successfully </div>';
		}
	}
    
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM accounts WHERE account_id = :account_id";
		$statement = $db->prepare($query);
		$statement->execute(
			array(
				':account_id'	=>	$_POST["account_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['username']         = $row['username'];
			$output['account_name']     = $row['account_name'];
			$output['account_role']     = $row['account_role'];
			$output['cell']    			= $row['cell'];
		}
		echo json_encode($output);
    }
    
	if($_POST['btn_action'] == 'Edit')
	{
		$account_name = trim(str_replace(" ", "", $_POST['account_name']));
		if($_POST['account_password'] != ' ')
		{
			$query = "UPDATE accounts 
                SET account_name        = '".trim($_POST["account_name"])."', 
                    username            = '".trim($_POST["username"])."',
                    account_password    = '".password_hash($_POST["account_password"], PASSWORD_BCRYPT)."', 
                    account_role        = '".$_POST['account_role']."',
                    cell       			= '".$_POST['cell']."' 
                WHERE account_id = '".$_POST["account_id"]."'
			";
		}
		else
		{
			$query = "UPDATE accounts 
                SET	account_name    = '".trim($_POST["account_name"])."', 
                    username        = '".trim($_POST["username"])."',
                    account_role    = '".$_POST['account_role']."',
                    cell		    = '".$_POST['cell']."'
				WHERE account_id = '".$_POST["account_id"]."'
			";
		}
		$statement = $db->prepare($query);
		$statement->execute();
		echo '<div class="alert alert-info text-center"> ' . $account_name . ' updated successfully </div>';
    }
}
