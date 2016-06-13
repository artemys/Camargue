<?php
	
	require_once "../Config/dbconfig.php";
	date_default_timezone_set('Europe/Paris');
	// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements


	if (isset($_POST['comment']))
	{
		$comm = $_POST['comment'];
	}
	if (isset($_POST['photo_id']))
	{
		$photo_id = $_POST['photo_id'];
	}
	if (isset($_SESSION['user']))
	{
		$com_owner = $_SESSION['user'];
	}

	file_put_contents('./error1.txt', $_SESSION['user']);
	$user->comment($comm, $photo_id, $com_owner);

	$user->redirect('galerie.php');

?>