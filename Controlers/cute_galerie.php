<?php
require_once '../Config/dbconfig.php';
$vanilla = 0;
date_default_timezone_set('Europe/Paris');

if (isset($_SESSION['user']))
{
	$user = htmlentities($_SESSION['user']);
}
$dir = "../Image/";
$sql = "SELECT * FROM photo WHERE photo_auteur = '$user'";
try
{
	$req = $DB_con->prepare($sql);
	$req->execute();
}
catch (PDOException $e)
{
	echo $e->getMessage();
} 
echo '<div class="overall"/>';
while ($userRow = $req->fetch())
{
	echo '<div class="block"/>';

 		$photo_id = $userRow['photo_id'];
 		echo '<div id="photo_id" class="photo" >';
 		echo '<h2 id="name">'.$userRow['photo_auteur'].'</h2>';
 		echo '<img class="img" src="'.$userRow['photo_name'].'" width=320 height=240 />';
		echo '</div>'; 

		echo '<form method="post" action="../Controlers/delete_picture.php" >';
		echo '<input type="hidden" value="'.$userRow['photo_id'].'" name="todel" />';
		echo '<input class=del type="submit" value="deletepicture" />';
		echo '</form>';
		echo '</div>';
};
	echo '</div>';
?>