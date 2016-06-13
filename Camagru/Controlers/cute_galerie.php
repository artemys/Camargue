<?php


	if (isset($_SESSION['user']))
	{
		$user = $_SESSION['user'];
	
	$dir = "image/";
	$sql = "SELECT * FROM photo WHERE ";
	try
	{
		$req = $DB_con->prepare($sql);
		$req->execute();

	}
	catch (PDOException $e)
	{
		echo $e->getMessage();
	} 

	echo "<label><a href='home.php'>Recommencer</a></label>";
	while($userRow = $req->fetch())
 	{
 // on affiche les informations de l'enregistrement en cours
 		echo "<div class='pohto'>";
 		echo '<h2><a title="'.$userRow['photo_auteur'].'>'.$userRow['photo_auteur'].'</a></h2>';
 		echo "<img src='".$userRow['photo_name']."'width=200 height=170/>";
 		echo "<br> <br>";
 		echo "</div>";
 	// file_put_contents("./error.txt", $)
 
 	} ;
 		echo "<div class='spacer'></div>";
 		echo "</div>";
 	}
 	// mysql_close($link);
?>
 