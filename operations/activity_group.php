<?php
include('connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "INSERT INTO activity_groups (name) VALUES (:name)";	
		$statement = $db->prepare($query);
		$statement->execute(
			array(
				':name'	=>	trim($_POST["activity_group"]),
			)
        );
        echo '<div class="alert alert-info text-center" style="color:#000">' .$_POST["activity_group"] .' has been added to our database</div>';
    }
    
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM activity_groups WHERE id = :group_id";
		$statement = $db->prepare($query);
		$statement->execute(
			array(
				':group_id'	=>	$_POST["group_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['name'] = $row['name'];
		}
		echo json_encode($output);
    }
    
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "UPDATE activity_groups SET name = '".trim($_POST["activity_group"])."'
				WHERE id = '".$_POST["group_id"]."'";
		$statement = $db->prepare($query);
        $statement->execute();
        echo '<div class="alert alert-info text-center" style="color:#000">' . $_POST["activity_group"] . ' has been edited successfully</div>';
    }
}
