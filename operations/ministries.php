<?php
include('connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "INSERT INTO ministries (name_of_ministry,ministry_leader) VALUES (:name_of_ministry,:ministry_leader)";	
		$statement = $db->prepare($query);
		$statement->execute(
			array(
				':name_of_ministry'	=>	trim($_POST["name_of_ministry"]),
				':ministry_leader'	=>	trim($_POST["ministry_leader"]),
			)
        );
        echo '<div class="alert alert-info text-center" >' .$_POST["name_of_ministry"] .' has been added to our database</div>';
    }
    
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM ministries WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name_of_ministry'] = $row['name_of_ministry'];
			$output['ministry_leader'] = $row['ministry_leader'];
		}
		echo json_encode($output);
    }
    
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "UPDATE ministries SET name_of_ministry = '".trim($_POST["name_of_ministry"])."' , ministry_leader = '".$_POST['ministry_leader']."'
				WHERE id = '".$_POST["id"]."'";
		$statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center">' . $_POST["name_of_ministry"] . ' has been edited successfully</div>';
    }
}
