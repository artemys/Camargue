<?php
include '../Views/sign_in.php';
require_once '../Config/dbconfig.php';
if ($user->is_loggedin()!= "")
{
	$user->redirect('home.php');
}
if (isset($_POST['btn-login']))
{
	$uname = htmlentities($_POST['txt_uname_email']);
	$umail = htmlentities($_POST['txt_uname_email']);
	$upass = htmlentities($_POST['txt_password']);

	if ($user->login($uname, $umail, $upass))
	{
		$_SESSION['user'] = $uname; 
		$user->redirect('home.php');
	}
	else
	{
		$error = "Wrong details";
	}
	echo '<script type="text/javascript">alert("'.$error.'");</script>';
}
?>
