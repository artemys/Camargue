<?php
session_start();
date_default_timezone_set('Europe/Paris');

$fname = $_POST['filter'];

if (isset($_SESSION['file']))
{
	$file = htmlentities($_SESSION['file']);
}
else if (isset($_SESSION['upload_file']))
{
	$file = htmlentities($_SESSION['upload_file']);
}
if (!isset($file))
{
    echo '<script type="text/javascript">alert("Désolé, vous devez prendre une photo ou télécharger un fichier. Vous allez etre redirigez a la page d\'accueil"); document.location.href = "home.php";</script>';
}
$filter = "../Filters/".$fname;
$filter = $filter .".png";
$source = imagecreatefrompng($filter);
if (exif_imagetype($file) ==  2)
{
	$destination = imagecreatefromjpeg($file);
}
else if (exif_imagetype($file) == 3)
{
	$destination = imagecreatefrompng($file);
}
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);
if ($filter == "../Filters/filter1.png")
{
	$destination_x = 0;
	$destination_y =  60;
}
else if ($filter == "../Filters/filter2.png")
{
	$destination_x = 190;
	$destination_y =  0;
}
else if ($filter == "../Filters/filter3.png")
{
	$destination_x = 146;
	$destination_y =  99;
}
else
{
	$destination_x = 0;
	$destination_y = 0;
}
imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
imagepng($destination, $file);
$size = getimagesize($file);
if (empty($size))
{
	echo '<script type="text/javascript">alert("Désolé, l\'image choisie est vide. Vous allez etre redirigez a la page d\'accueil"); document.location.href = "home.php";</script>';
}
include("../Views/final.php");
?>