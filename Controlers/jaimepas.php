<?php
	session_start();
	require_once '../Config/dbconfig.php';
	
	$photo_id = htmlentities($_POST['photo_id']);
	$user = htmlentities($_SESSION['user']);
	$jaime = 0;
	try
	{
		$stmt = $DB_con->prepare("DELETE FROM jaime WHERE photo_id = '$photo_id' AND user_name = '$user'");
		$stmt->execute();
	}
	catch (PDOExeption $e)
	{
		echo $e->getMessage();
	}
?>