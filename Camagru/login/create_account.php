<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="login.css" />
	<title>Creation de compte</title>
</head>
<body>
  <from class="sqr" methode ="post" action="create.php">
	<label for="login">Identifiant: </label>
	<input type="text" name="login" id="login" /></br></br>
    <label for="passwd">Password: </label>
    <input type="password" name="passwd" id="passwd" /></br></br>
    <input type="submit" name="submit" value="OK" />
</body>
</html>