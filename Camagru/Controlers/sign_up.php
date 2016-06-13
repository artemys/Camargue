<?php

include '../Views/sign_up.php';

require_once '../Config/dbconfig.php';
	date_default_timezone_set('Europe/Paris');


if ($user->is_loggedin()!= "")
{
	$user->redirect('home.php');
}

if (isset($_POST['btn-sign-up']))
{

	$_SESSION['txt_umail'] = $_POST['txt_umail'];
	$_SESSION['txt_uname'] = $_POST['txt_uname'];
	// $_SESSION['active'] = 0;

	$uname = trim($_POST['txt_uname']);
	$umail = trim($_POST['txt_umail']);
	$upass = trim($_POST['txt_upass']);
	 // echo $uname;

	if ($uname=="")
	{
		$error[] = "Please provide username !";

	}
	else if ($umail == "")
	{
		$error[] = "Please provide email !";

	}
	else if (!filter_var($umail, FILTER_VALIDATE_EMAIL))
	{
		$error[] = "Please enter a valid email address !";

	}
	else if ($upass == "")
	{
		$error[] = "Please provide password !";
	}
	else if (strlen($upass) < 6)
	{
		$error[] = "Password must be atleast 6 characters";

	}
	else if (empty($_SESSION['active']))
	{
		// file_put_contents("./error3.txt", $_SESSION['active'], FILE_APPEND );
		$user->redirect('activate.php');
	}
	else
	{
		unset($_SESSION['active']);

		try
		{
			$stmt = $DB_con->prepare("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if ($row['user_name'] == $uname)
			{
				$error[] = "Sorry username already taken... Please choose another one !";
			}
			else if ($row['user_email'] == $umail)
			{
				$error[] = "Sorry email already taken.. Please use another one !";
			}
			else
			{
				if ($user->register($fname, $lname, $uname, $umail, $upass, 1))
				{
					$user->redirect('sign_up.php?joined');
				}
			}
		}
		catch(PDOExeption $e)
		{
			echo $e->getMessage();
		}
	}
}

?>

