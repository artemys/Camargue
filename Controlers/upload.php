<?php
date_default_timezone_set('Europe/Paris');
include "../Class/class.user.php";

$target_dir = "../Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if (isset($_POST["submit"]) && isset($fileToUpload)) 
{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false)
    {
        echo '<script type="text/javascript">alert("File is an image - ' . $check["mime"] . '.");</script>';
        $uploadOk = 1;
    } 
    else
    {
        echo '<script type="text/javascript">alert("Le fichier n\'est pas une image.");</script>';
        $uploadOk = 0;
    }
}
if ($_FILES["fileToUpload"]["size"] > 500000)
{
    echo '<script type="text/javascript">alert("Sorry, your file is too large.");</script>';
    $uploadOk = 0;
}
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
{
    echo '<script type="text/javascript">alert("Desole, seulement  les fichiers JPG, JPEG, PNG & GIF sont accepter.");</script>';
    $uploadOk = 0;
}
if ($uploadOk == 0)
{
    echo '<script type="text/javascript">alert("Ton fichier n\'a pas ete charger. Vous allez etre rediriger vers la page d\'acceuil"); document.location.href = "home.php";</script>';
}
else
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
    {
    	require 'home.php';
        echo '<script type="text/javascript">alert("Le fichier'. basename( $_FILES['fileToUpload']['name']). ' as ete telecharcher.");</script>';
        $_SESSION['upload_file'] = $target_file;
        echo '<img class="upload_file" src="'.$target_file.'"></br>';
    }
    else
    {
        echo '<script type="text/javascript">alert("Desoler, il y a eu un probleme en chargeant.");</script>';
	}
}
?>