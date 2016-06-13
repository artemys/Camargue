<?php
session_start();
date_default_timezone_set('Europe/Paris');
include '../Views/activate.php';
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements

// $destinataire = trim($_POST['txt_umail']);
if (isset($_SESSION['txt_umail']))
	$destinataire = $_SESSION['txt_umail'];
if (isset($_SESSION['txt_uname']))
	$uname = $_SESSION['txt_uname'];

$cle = md5(microtime(TRUE) * 100000);
$_SESSION['cle'] = $cle;
$headers = "Content-type: text/html; charset=UTF-8";

$sujet = "Activer votre compte Camagrue";
$message = 'Bienvenue sur Camagrue, </br>
 
 	Pour activer votre compte, veuillez cliquer sur le lien ci dessous </br>
	ou copier/coller dans votre navigateur internet.</br>
 
<a	href="http://localhost:8080/Controlers/validate.php?log='.urlencode($uname).'&cle='.urlencode($cle).'">Finalisez mon inscription</a> </br>
</br>
									--------------- </br>
</br>
	Ceci est un mail automatique, Merci de ne pas y répondre.';

mail($destinataire, $sujet, $message, $headers);

?>