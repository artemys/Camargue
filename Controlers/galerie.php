<?php
session_start();
include "../Views/galerie.php";
require_once '../Config/dbconfig.php';
date_default_timezone_set('Europe/Paris');
$vanilla = 0;
$i = 0;
$dir = "../Image/";
if (isset($_SESSION['user']))
{
	$user = htmlentities($_SESSION['user']);
}
$nb_photo_page = 6;

$cnt = "SELECT * FROM photo";
try
{
	$request = $DB_con->prepare($cnt);
	$request->execute();
}
catch (PDOException $e)
{
	echo $e->getMessage();
}
$total = $request->rowCount();

$maxpage = ceil($total / $nb_photo_page);
$reste = ceil($total % $nb_photo_page);
$maxpage + $reste;


if (isset($_GET['page']))
{
	$page = htmlentities($_GET['page']);
}
else
{
	$page = 1;
}
$next = $page + 1;
$prev = $page - 1;
if ($page > 0)
	$offset = ($page - 1) * 5;
else
	$offset = 1;
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
$sql = "SELECT * FROM photo ORDER BY photo_id LIMIT :offset, 6";

try
{
	$req = $DB_con->prepare($sql);
	$req->bindParam(':offset', $offset, PDO::PARAM_INT);
	$req->execute();
	$nb_page = $req->rowCount();
	$userRow = $req->fetch();

}
catch (PDOException $e)
{
	echo $e->getMessage();
} 

if ($prev > 0)
{
	echo '<div class="prev" /> <a  href="./galerie.php?&page='. $prev .'"/> prev </a></div>';
}
if ($next <= $maxpage)
{
	echo '<div class="next" /> <a href="./galerie.php?&page='. $next .'"/> next </a></div>';
}
echo '<div class="overall"/>';
while ($nb_page >= 1)
{
	echo '<div class="block"/>';
	echo '<div id="photo_id" class="photo" >';
 		echo '<h2 id="name">'.$userRow['photo_auteur'].'</h2>';
 		echo '<img class="img" src="'.$userRow['photo_name'].'" width=320 height=240 />';
		echo '</div>'; 
	$userRow = $req->fetch();

 		$photo_id = $userRow['photo_id'];
 		try 
		{
			$stmt = $DB_con->prepare("SELECT * FROM commentaire WHERE '$photo_id' = photo_id");
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}

 		
		echo '<form method="post" action="comment.php" class="comment" >';
		echo '<textarea class="add_com" name="comment" placeholder="Saisir un texte ici ..."></textarea>';
		echo '<input type="hidden" value="'.$userRow['photo_id'].'" name="photo_id" />';
		echo '<input type="submit" class="button" value="publish"/>';
		echo '</form>';

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

		echo '<div id="past_comment"/>';
		while ($res = $stmt->fetch())
		{
			echo '<div style="font-style:italic">'.'&nbsp;'.$res["user_name"].' a dit:'.'</div>';
			echo '<div class="text"> '.$res["comm"]. '&nbsp;' .'</div>'; 
		}
		echo '</div>';


		echo '</div>'; 
		$i = 0;
		$nb_page--;

};
	echo '</div>';
 	echo "<script src='../Js/jaime.js'></script>";
?>