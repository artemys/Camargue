<?php
	session_start();
	require_once '../Config/dbconfig.php';
    date_default_timezone_set('Europe/Paris');

    if (isset($_SESSION['user']))
    {
        $img_owner = htmlentities($_SESSION['user']);
    }
    if (isset($_SESSION['file']))
    {
	   $file = htmlentities($_SESSION['file']);
    }
    else if (isset($_SESSION['upload_file']))
    {
        $file = htmlentities($_SESSION['upload_file']);
    }
    if (isset($img) OR isset($file))
    {
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
    }
   
    include "../Views/publish_picture.php";
?>