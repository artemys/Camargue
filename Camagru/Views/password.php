<!DOCTYPE html>
<html>
<head>
	<title>Password</title>
</head>
<body>
<?php
if (isset($_GET['donotmatch']))
{
	echo 'Password do not match, retry'; 
}
?>
<form method="post" href="password.php">
<input type="password" name="newpass" placeholder="Your new password" required></input>
<input type="password" name="confirm" placeholder="Confirme" required></input>
<button type="submit" name="btn"></button>
</form>
</body>
</html>