<?php
	require_once "../Config/dbconfig.php";
	date_default_timezone_set('Europe/Paris');
	if (isset($_POST['comment']))
	{
		$comm = htmlentities($_POST['comment']);
	}
	if (isset($_POST['photo_id']))
	{
		$photo_id = $_POST['photo_id'];
	}
	if (isset($_SESSION['user']))
	{
		$com_owner = htmlentities($_SESSION['user']);
	}
	$user->comment($comm, $photo_id, $com_owner);
	$user->redirect('galerie.php');

?>