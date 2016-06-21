<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Password</title>
	<link rel="stylesheet" href="../Css/index.css"/>
</head>
<body>
<?php
if (isset($_GET['donotmatch']))
{
	echo 'Password do not match, retry'; 
}
?>
<div class="content"/>
<h2>Mot de passe</h2></br>
<form method="post" href="password.php">
<input class="input" type="password" name="newpass" placeholder="Your new password" required></input></br>
<input class="input" type="password" name="confirm" placeholder="Confirme" required></input></br></br>
<button class="btn" type="submit" name="btn">Envoyé</button>
</form>
</div>
</body>
</html>