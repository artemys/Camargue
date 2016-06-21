<?php

    session_start();
    require_once '../Config/dbconfig.php';
    define("UPLOAD_DIR", "../Image/");
    if (isset($_POST['img']))
    {
         $data = htmlentities($_POST['img']);   
    }
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $img = base64_decode($data);
    $file = UPLOAD_DIR . uniqid() . ".png";

    $_SESSION['file'] = $file;
    file_put_contents($file, $img);
?>
