<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

	<title>Sign up</title>
	<link rel="stylesheet" href="../Css/index.css"/>
</head>
<body>
	<div  class="content"/>

<form method="post" action="sign_up.php">
	<h2>Sign up.</h2>
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
		echo "S'il vous plaît entrez vos informations à nouveau pour finaliser l'inscription";
	}
	else if (isset($_GET['joined']))
	{
		
		?>
		Vous etes inscrit sur Camagrue  !<a class="link" href='../index.php'> Login</a></br>
	<?php
	}
		?>
	<input class="input" type="text" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>"/>
	<input class="input" type="text" name="txt_umail" placeholder="Enter E-Mail" value="<?php if (isset($error)){echo $umail;}?>" /></br></br>
	<input class="input" type="password" name="txt_upass" placeholder="Enter Password" /></br></br>
	<button class=btn type="submit" name="btn-sign-up">Validate</button>
	<br />
	<label><a class="link" href="../index.php">Sign In</a></label>
</div>
</form>
</body>
</html>