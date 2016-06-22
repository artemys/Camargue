<?php
session_start(); 
include_once '../Config/dbconfig.php';

echo ' <div class="user_log" />Bienvenue ' . $_SESSION['user'] . ' ! </div>';
if (isset($_SESSION['file']))
{
	unset($_SESSION['file']);
}
// if (isset($_SESSION['upload_file']))
// {
// 	unset($_SESSION['upload_file']);
// }
if ($user->is_loggedin() == "")
{
	$user->redirect('../index.php');
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

include 'cute_galerie.php';
?>

