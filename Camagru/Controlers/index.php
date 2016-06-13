<?php

// session_start();
include '../Views/index.php';
// define('__CONF__', dirname(dirname("dbconfig.php")));
date_default_timezone_set('Europe/Paris');
// include 'restore_passwd.html';
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
require_once '../Config/dbconfig.php';
if ($user->is_loggedin()!= "")
{
	$user->redirect('../Controlers/home.php');
}

if (isset($_POST['btn-login']))
{
	$uname = htmlentities($_POST['txt_uname_email']);
	$umail = $_POST['txt_uname_email'];
	$upass = $_POST['txt_password'];
	if ($user->login($uname, $umail, $upass))
	{
		$_SESSION['user'] = $uname; 
		$user->redirect('home.php');
	}
	else
	{
		$error = "Wrong details";
	}
	echo $error;
}
?>
