<?php

require '../Class/class.user.php';

include '../Views/password.php';
if (isset($_POST['btn']))
{
	if (isset($_POST['newpass']))
	{
		$newpass = htmlentities($_POST['newpass']);
	}
	if (isset($_POST['confirm']))
	{
		$confirm = htmlentities($_POST['confirm']);
	}

	$user = htmlentities($_GET['log']);
	$cle = htmlentities($_GET['cle']);

	if ($newpass == $confirm)
	{
		if (strlen($newpass) < 6)
		{
			echo '<script type="text/javascript">alert("Ton mot de passe doit contenir au moins 6 caracteres.");</script>';
		}
		else if (USER::checkpass($newpass) != 1 || USER::checkpass($confirm) != 1)
		{
			echo " ";
		}
		else
		{
			USER::update_passwd($newpass, $user, $cle);
			echo "<a href='../index.php'> Return to log page </a>";
		}
	}
	else
	{
		header("Location : password.php?donotmatch");
	}
}

?>
