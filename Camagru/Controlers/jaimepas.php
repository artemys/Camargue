<?php
	
	require_once '../Config/dbconfig.php';
	session_start();
		// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements


	$photo_id = $_POST['photo_id'];
	$user = $_SESSION['user'];
	$jaime = 0;
	try
	{
		$stmt = $DB_con->prepare("DELETE FROM jaime WHERE photo_id = '$photo_id' AND user_name = '$user'");
		$stmt->execute();
	}
	catch (PDOExeption $e)
	{
		echo $e->getMessage();
	}

?>