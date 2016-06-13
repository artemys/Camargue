<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements
    session_start();
    require_once '../Config/dbconfig.php';

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__file__) . '/log_error_php.txt');

    // $img_owner = $_SESSION['user'];
    define("UPLOAD_DIR", "../Image/");
    
    $data = $_POST['img'];   
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $img = base64_decode($data);
    $file = UPLOAD_DIR . uniqid() . ".png";

    $_SESSION['file'] = $file;
    file_put_contents($file, $img);
?>


<!-- // decode vers png
// save folder
// prend filtre
// prend l'mage
// je merge
// j'enleve l'originale -->
