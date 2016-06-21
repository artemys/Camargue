<?php
date_default_timezone_set('Europe/Paris');
session_start();
require_once('../Config/dbconfig.php');

if (isset($_POST['todel']))
{
	$todel = htmlentities($_POST['todel']);
}
$user->delete_picture($todel);
$user->redirect('home.php');
?>