<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

	<title>Sign up</title>
	<link rel="stylesheet" href="sign-up.css"/>
</head>
<body>
<form method="post" action="sign_up.php">
	<h2>Sign up.</h2><hr />
	<?php
	if (isset($error))
	{
		foreach($error as $error)
		{
			echo $error;
		}
	}
	else if (isset($_GET['activate']))
	{
		echo "Please enter you're informations again to terminate you're inscription";
	}
	else if (isset($_GET['joined']))
	{
		
		?>
		Successfully registered <a href='index.php'>login</a>here
	<?php
	}
		?>
	<input type="text" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>"/>
	<input type="text" name="txt_umail" placeholder="Enter E-Mail" value="<?php if (isset($error)){echo $umail;}?>" />
	<input type="password" name="txt_upass" placeholder="Enter Password" />
	<!-- <button type=></button> -->
	<button type="submit" name="btn-sign-up"></button>
	<br />
	<!-- <label>Verifie you're e-mail !<a href="index.php">Send me a</a></label> -->
	<label>have an account !<a href="index.php">Sign In</a></label>

</form>
</body>
</html>