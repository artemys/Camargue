<?php
session_start();
//if ($_POST['login'] !== NULL && $_POST['passwd'] !== NULL && $_POST['submit'] !== NULL && $_POST['submit'] === "OK" && $_POST['passwd'] !== "" && $_POST['login'] === "")
if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']) && $_POST['submit'] === "OK" && $_POST['passwd'] !== "" && $_POST['login'] === "")

{
	$passwd = '../private/paswd';
	if (!file_exists('../private/passwd') || !file_exists('../private'))
		mkdir('../private', 0755);
	$tab = array();
	 if (file_exists('../private/passwd'))
      $tab = unserialize(file_get_contents("$file"));
  	$login = $_POST['login'];
  	foreach ($tab as $val) 
  	{
  		if ($val["login"] === $login)
  			return (header('Location : ./error.php'));
  	}
  	$pass = hash('whirlpool', $_POST['passwd']);
  	$tab[$login] = $array = array("login" => $login, "paswd" => $pass);
  	$str = serialize($tab);
  	file_put_contents($passwd, $str);
  	return(header('Location: ./login.php'));
}