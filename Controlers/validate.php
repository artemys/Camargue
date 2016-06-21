<?php
include '../Class/class.user.php';
session_start();
date_default_timezone_set('Europe/Paris');

if(isset($_GET['log']))
{
	$login = htmlentities($_GET['log']);
}
if (isset($_GET['cle']))
{
	$ucle = htmlentities($_GET['cle']);
}
$user = new User;

if (isset($_SESSION['cle']))
{
	$cle = htmlentities($_SESSION['cle']);
}
if ( isset($cle) && isset($ucle))
{
	if ($cle == $ucle)
	{
		echo "Votre compte a bien ete activer";
		$_SESSION['active'] = 1;
		$user->redirect('sign_up.php?activate');
	}
}
else
{
	echo "Erreur, votre compte ne peut etre activer ";
}
?>