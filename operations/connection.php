<?php 
    $DBhost = "localhost";
	$DBuser = "pcire_rehoboth";
	$DBpass = "4eYx6g3^";
	$DBname = "pcirehobothorg_rehobothtemple";
	
	try{
		
		$db = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $ex){
		
		die($ex->getMessage());
    };
?>