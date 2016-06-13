<?php
	session_start();
	require_once '../Config/dbconfig.php';
    date_default_timezone_set('Europe/Paris');

    $img_owner = $_SESSION['user'];
    if (isset($_SESSION['file']))
    {
	   $file = $_SESSION['file'];
    }
    else if (isset($_SESSION['upload_file']))
    {
        $file = $_SESSION['upload_file'];
    }

    if (exif_imagetype($file) ==  2)
    {
        $img = imagecreatefromjpeg($file);
    }
    else if (exif_imagetype($file) == 3)
    {
	   $img = imagecreatefrompng($file);
    }
    $img_height = imagesx($img);
    $img_width = imagesy($img);
    $img_weight = filesize($file);

    $user->save_photo($img_owner, $file, $img_height, $img_width, $img_weight);
 
    include "../Views/publish_picture.php" 

?>