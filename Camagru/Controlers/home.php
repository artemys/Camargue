<?php
session_start(); 
date_default_timezone_set('Europe/Paris');
include_once '../Config/dbconfig.php';


echo ' Bienvenue ' . $_SESSION['user'] . ' !';
// if ($_SESSION['user'] != null)
// {
// 	header('Location: index.php');
// 	exit();
// }
if ($user->is_loggedin() == "")
{
	$user->redirect('index.php');
}
include '../Views/home.php';

$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['uploaded']))
{
	echo "<img src='". $_SESSION['upload_file'] . "'id='photo'>";
}
?>

