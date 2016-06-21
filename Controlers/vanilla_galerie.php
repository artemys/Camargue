<?php
require_once "../Config/dbconfig.php";
$vanilla= 1;
echo' <link rel="stylesheet" href="../Css/vanilla_galerie.css"/>';
include "../Views/galerie.php";

$dir = "../Image/";
$cnt = "SELECT * FROM photo";
$nb_photo_page = 5;

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
$offset = ($page - 1) * 5;
file_put_contents("error1.txt", $offset);
$sql = "SELECT * FROM photo ORDER BY photo_id LIMIT :offset, 5";
try
{
	$req = $DB_con->prepare($sql);
	$req->bindParam(':offset', $offset, PDO::PARAM_INT);
	$req->execute();
	$nb_page = $req->rowCount();
}
catch (PDOException $e)
{
	echo $e->getMessage();
} 

if ($prev > 0)
{
	echo '<div class="prev" /> <a  href="./vanilla_galerie.php?&page='. $prev .'"/> prev </a></div>';
}
if ($next <= $maxpage)
{
	echo '<div class="next" /> <a href="./vanilla_galerie.php?&page='. $next .'"/> next </a></div>';
}
echo '<div class="overall" style=" width: 0; 
     margin: 0; 
     height: 0; 
}"/>';
while ($userRow = $req->fetch())
{
 		$photo_id = $userRow['photo_id'];
		echo '<div id="photo_id" class="photo_vanilla" >';
 		echo '<h2 id="name">'.$userRow['photo_auteur'].'</h2>';
 		echo '<img class="img" src="'.$userRow['photo_name'].'" width=320 height=240 />';
		echo '</div>'; 
		echo '</div>';
};
echo '</div>';
?>