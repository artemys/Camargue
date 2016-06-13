<?php

date_default_timezone_set('Europe/Paris');
// include 'restore_passwd.html';
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements
require '../Class/class.user.php';
// include 'password.html';
include '../Views/password.php';
if (isset($_POST['btn']))
{
if (isset($_POST['newpass']))
{
	$newpass = $_POST['newpass'];
}
if (isset($_POST['confirm']))
{
	$confirm = $_POST['confirm'];
}
$user = $_GET['log'];
$cle = $_GET['cle'];

if ($newpass == $confirm)
{
	USER::update_passwd($newpass, $user, $cle);
	echo "<a href='index.php'> Return to log page </a>";
}
else
{
	header("Location : password.php?donotmatch");
}
}

?>
