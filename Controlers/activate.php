<?php
session_start();
date_default_timezone_set('Europe/Paris');
include '../Views/activate.php';

if (isset($_SESSION['txt_umail']))
{
	$destinataire = htmlentities($_SESSION['txt_umail']);
}
if (isset($_SESSION['txt_uname']))
{
	$uname = htmlentities($_SESSION['txt_uname']);
}
$cle = md5(microtime(TRUE) * 100000);
$_SESSION['cle'] = $cle;
$headers = "Content-type: text/html; charset=UTF-8";

$sujet = "Activer votre compte Camagrue";
$message = 'Bienvenue sur Camagrue, </br>
 
 	Pour activer votre compte, veuillez cliquer sur le lien ci dessous. </br>
 
<a	href="http://localhost:8080/Controlers/validate.php?log='.urlencode($uname).'&cle='.urlencode($cle).'">Finalisez mon inscription</a> </br>
</br>
									--------------- </br>
</br>
	Ceci est un mail automatique, Merci de ne pas y répondre.';

mail($destinataire, $sujet, $message, $headers);

?>