<?php
session_start();
date_default_timezone_set('Europe/Paris');

// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements


$fname = $_POST['filter'];
if (isset($_SESSION['file']))
{
	$file = $_SESSION['file'];
}
else if (isset($_SESSION['upload_file']))
{
	$file = $_SESSION['upload_file'];
}
$filter = "../Filters/".$fname;
$filter = $filter .".png";
// file_put_contents("./error.txt", $filter);

// file_get_contents("./error1.txt", $file);
// On charge d'abord les images
$source = imagecreatefrompng($filter); // Le logo est la source

   if (exif_imagetype($file) ==  2)
    {
        $destination = imagecreatefromjpeg($file);
    }
    else if (exif_imagetype($file) == 3)
    {
	   $destination = imagecreatefrompng($file);
    }
// $destination = imagecreatefrompng($file); // La photo est la destination
 // file_put_contents("./error.txt", $file);
// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);
 
// On veut placer le logo en bas à droite, on calcule les coordonnées où on doit placer le logo sur la photo
// echo $filter
if ($filter == "../Filters/filter1.png")
{
	$destination_x = 0;//$largeur_destination - $largeur_source;
	$destination_y =  60;//$hauteur_destination - $hauteur_source;
}
else if ($filter == "../Filters/filter2.png")
{
	$destination_x = 190;//$largeur_destination - $largeur_source;
	$destination_y =  0;
}
else if ($filter == "../Filters/filter3.png")
{
	$destination_x = 146;//$largeur_destination - $largeur_source;
	$destination_y =  99;
}
else
{
	$destination_x = 0;
	$destination_y = 0;
}
// On met le logo (source) dans l'image de destination (la photo)
imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
 
// On affiche l'image de destination qui a été fusionnée avec le logo
imagepng($destination, $file);
// echo $destination;
include("../Views/final.php");

// file_put_contents("./error1.txt", $destination);
?>