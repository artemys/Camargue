<?php
	require_once '../Config/dbconfig.php';
	session_start();

	$photo_id = htmlentities($_POST['photo_id']);
	$user = htmlentities($_SESSION['user']);
	$jaime = 1;
	try
	{
		$stmt = $DB_con->prepare("INSERT INTO jaime(photo_id, user_name, photo_jaime) VALUES('$photo_id', '$user', '$jaime')");
		$stmt->execute();
	}
	catch (PDOExeption $e)
	{
		echo $e->getMessage();
	}
?>