<?php
date_default_timezone_set('Europe/Paris');
session_start();
require_once('../Config/dbconfig.php');
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements
if (isset($_POST['todel']))
{
	$todel = $_POST['todel'];
// file_put_contents('./error2.txt', $_POST, FILE_APPEND);
}

$user->delete_picture($todel);
$user->redirect('galerie.php');


?>