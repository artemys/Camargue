<?php
session_start();
date_default_timezone_set('Europe/Paris');
require_once 'config/dbconfig.php';

if (isset($_POST['user']))
	$user = $_POST['user'];
if (isset($_POST['mail']))
	$mail = $_POST['mail'];
$cle = md5(microtime(TRUE) * 1000000);




$sujet = "Recuperation du Mot de passe de votre compte Camagrue";
$message = 'Bonjour,
 
 	Pour recuperer votre mot de passe, veuillez cliquer sur le lien ci dessous
	ou copier/coller dans votre navigateur internet.
 
	 http://localhost:8080/password.php?log='.urlencode($user).'&cle='.urlencode($cle).'

									---------------

	Ceci est un mail automatique, Merci de ne pas y répondre.';

mail($mail, $sujet, $message);



USER::produce_passwd_key($cle, $user);


?>