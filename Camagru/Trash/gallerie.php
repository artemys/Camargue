<?php
session_start();
require_once '../Config/dbconfig.php';
date_default_timezone_set('Europe/Paris');
	// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
	// header ('Content-type: image/png'); 
if ($user->is_loggedin() == "")
{
	$user->redirect('index.php');
}
$dir = "../Image/";
$sql = "SELECT * FROM photo ";
try
{
	$req = $DB_con->prepare($sql);
	$req->execute();
	$userRow = $req->fetch();
}
catch (PDOException $e)
{
	echo $e->getMessage();
} 

echo "<label><a href='home.php'>Recommencer</a></label>";

while ($userRow = $req->fetch())
{
 	echo "<div class='pohto'>";
 	echo '<h2><a title="'.$userRow['photo_auteur'].'" href="gallerie.php?id='.$userRow['photo_id'].'">'.$userRow['photo_auteur'].'</a></h2>';
 	echo "<img src='".$userRow['photo_name']."'width=320 height=240/>";
 	$photo_id = $userRow['photo_id'];

 	try 
	{
		$stmt = $DB_con->prepare("SELECT * FROM commentaire WHERE '$photo_id' = photo_id");
		$stmt->execute();
		// $res = $stmt->fetch();
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
 	while ($res = $stmt->fetch())
 		echo '<div> '.$res["comm"].' </div>';
 	echo "<br> <br>";

 	echo "<form method='post' action='delete_picture.php'>";
 	echo "<input type='hidden' value='".$userRow['photo_id']."'name='todel'/>";
 	echo "<input type='submit' value='deletepicture' />";
 	echo "</form>";
 	echo "</div>";

 	echo "<label><a href='home.php'>Recommencer</a></label>";

 	echo "<form method='post' action='comment.php'>";
 	echo "<textarea name='comment' rows='10' cols='50'>Saisir un texte ici.</textarea>";
 	echo "<input type='hidden' value='".$userRow['photo_id']."'name='photo_id'/>";
 	echo "<input type='submit' value='publish'/>";
 	echo "</form>";

} ;

 	echo "<div class='spacer'></div>";
 	echo "</div>";
?>