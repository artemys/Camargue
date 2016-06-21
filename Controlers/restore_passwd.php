<?php
session_start();
date_default_timezone_set('Europe/Paris');
require_once('../Config/dbconfig.php');

if (isset($_POST['user']))
{
 
	$user = $_POST['user'];
}
if (isset($_POST['mail']))
	$mail = $_POST['mail'];
$cle = md5(microtime(TRUE) * 1000000);

$headers = "Content-type: text/html; charset=UTF-8";
$sujet = "Recuperation du Mot de passe de votre compte Camagrue";
$message = 'Bonjour, <br>
 	<br>
 	Pour recuperer votre mot de passe, veuillez cliquer sur le lien ci dessous. <br>
 	<br>
	<a  href="http://localhost:8080/Controlers/password.php?log='.urlencode($user).'&cle='.urlencode($cle).'">Recuperation du mot de passe</a><br>
 	<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------- <br>
	<br>
	Ceci est un mail automatique, Merci de ne pas y répondre.';

mail($mail, $sujet, $message, $headers);

USER::produce_passwd_key($cle, $user);

?>