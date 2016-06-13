<?php
session_start();
require_once '../Config/dbconfig.php';
date_default_timezone_set('Europe/Paris');

ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');

$i = 0;
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
// if (isset($_SESSION['user']))
// {
	$user = $_SESSION['user'];

	try
	{
		$jreq = $DB_con->prepare("SELECT photo_id FROM jaime WHERE '$user' = user_name");
		$jreq->execute();
		$userJaime = $jreq->fetchAll();
	}
	catch (PDOException $e)
	{
		echo $e->getMessage();
	} 

	echo "<label><a href='home.php'>Recommencer</a></label>";
// }
// else
// {
	// echo "<label><a href='index.php'>Retourner a l'ecran de connection</a></label>";
// }
while ($userRow = $req->fetch())
{
 	echo "<div class='pohto'>";
 	echo '<h2><a title="'.$userRow['photo_auteur'].'>'.$userRow['photo_auteur'].'</a></h2>';
 	echo "<img src='".$userRow['photo_name']."'width=320 height=240/>";
 	$photo_id = $userRow['photo_id'];

 	if (isset($_SESSION['user']))
 	{
 		try 
		{
			$stmt = $DB_con->prepare("SELECT * FROM commentaire WHERE '$photo_id' = photo_id");
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		while ($res = $stmt->fetch())
		{
			echo '<div> '.$res["comm"].' </div>';
		}
		echo "<br> <br>";

		echo "<form method='post' action='../Controlers/delete_picture.php'>";
		echo "<input type='hidden' value='".$userRow['photo_id']."'name='todel'/>";
		echo "<input type='submit' value='deletepicture' />";
		echo "</form>";
		echo "</div>";


		echo "<form method='post' action='comment.php'>";
		echo "<textarea name='comment' rows='10' cols='50'>Saisir un texte ici.</textarea>";
		echo "<input type='hidden' value='".$userRow['photo_id']."'name='photo_id'/>";
		echo "<input type='submit' value='publish'/>";
		echo "</form>";
		foreach ($userJaime as $key => $value)
		{
			if ($value['photo_id'] == $userRow['photo_id'])
			{
				$i = 1;
			}
		}
		if($i != 1)
		{
		 	echo "<div id='".$userRow['photo_id']."'class='jaime'>J'aime</div>";
		}
		else
		{
		 	echo "<div id='".$userRow['photo_id']."'class='jaimepas'>J'aime plus</div>";
		}
		$i = 0;
	}
};

 	echo "<div class='spacer'></div>";
 	echo "</div>";
 	echo "<script src='../Js/jaime.js'></script>";
?>