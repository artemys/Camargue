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
	$jaime = 1;
	try
	{
		$stmt = $DB_con->prepare("INSERT INTO jaime(photo_id, user_name, photo_jaime) VALUES('$photo_id', '$user', '$jaime')");
		$stmt->execute();
	}
	catch (PDOExeption $e)
	{
		echo $e->getMessage();
	}

?>