<?php
session_start();
date_default_timezone_set('Europe/Paris');

require_once '../Config/dbconfig.php';

$login = $_GET['log'];
$ucle = $_GET['cle'];

if (isset($_SESSION['cle']))
	$cle = $_SESSION['cle'];
if (isset($login) && isset($cle) && isset($ucle))
{
	if ($cle == $ucle)
	{
		echo "Votre compte a bien ete activer";
		$_SESSION['active'] = 1;
		$user->redirect('sign_up.php?activate');
	// header("Location: http://localhost:8080/sign-up.php");
	}
}
else
{
	echo "Erreur, votre compte ne peut etre activer ";
	echo $cle;
	echo $ucle;
}

?>