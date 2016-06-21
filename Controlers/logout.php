<?php
session_start();
require_once '../Class/class.user.php';
$user = new USER();

if(!$user->is_loggedin())
{
 $user->redirect('../index.php');
}

if($user->is_loggedin()!="")
{
 $user->logout(); 
 $user->redirect('../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<h1><a href="../index.php">vous etes déconnecté</a></h1>
</body>
</html>