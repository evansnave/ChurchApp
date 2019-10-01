<?php 
    $DBhost = "localhost";
	$DBuser = "root";
	$DBpass = "";
	$DBname = "pci_rehoboth";
	
	try{
		
		$db = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $ex){
		
		die($ex->getMessage());
    };
?>