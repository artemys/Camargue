<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "dblogin";

try
{	
	$conn = new PDO("mysql:host=$DB_host", $DB_user, $DB_pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql_create_db = "CREATE DATABASE $DB_name";
	$conn->exec($sql_create_db);
	echo "Database created successfully" . "\n";
}
catch(PDOException $e)
{
	echo $e->getMessage() . "\n";
}

$conn = null;

try
{
	$conn = new PDO("mysql:host=$DB_host;dbname=$DB_name", $DB_user, $DB_pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql_create_utable = "CREATE TABLE `$DB_name`.`users` (
   `user_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
   `user_name` VARCHAR( 255 ) NOT NULL ,
   `user_email` VARCHAR( 60 ) NOT NULL ,
   `user_pass` VARCHAR( 255 ) NOT NULL ,
   `activate` SMALLINT,
   `restore_key` VARCHAR(255),
    UNIQUE (`user_name`),
    UNIQUE (`user_email`)
	) ENGINE = MYISAM ";
	$conn->exec($sql_create_utable);
	echo "Table users created successfully.\n";
}

catch(PDOException $e)
{
	echo $e->getMessage() . "\n";
}


try
{
	$sql_create_ptable = "CREATE TABLE `$DB_name`.`photo`(
	`photo_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`photo_auteur` VARCHAR( 255 ) NOT NULL,
	`photo_name` VARCHAR( 255 ) NOT NULL,
	`photo_height` INT( 11 ) NOT NULL,
	`photo_width` INT( 11 ) NOT NULL,
	`photo_weight_bytes` INT( 11 ) NOT NULL,
	`photo_like` INT( 11 ),
	`photo_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
	$conn->exec($sql_create_ptable);
	echo "Table photo created successfully.\n";
}
	catch(PDOException $e)
	{
		echo $e->getMessage() . "\n";
	}

try
{
	$sql_create_ctable = "CREATE TABLE `dblogin`.`commentaire`(
	`comm_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`photo_id` INT( 11 ) NOT NULL,
	`user_name` VARCHAR( 225 ) NOT NULL,
	`comm` TEXT(140) NOT NULL,
	`comm_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
	$conn->exec($sql_create_ctable);
	echo "Table com created successfully.\n";

}
catch(PDOException $e)
{
	echo $e->getMessage() . "\n";
}

try
{
	$sql_create_ltable = "CREATE TABLE `dblogin`.`jaime`(
	`photo_id` INT( 11 ) NOT NULL,
	`user_name` VARCHAR( 225 ) NOT NULL,
	`photo_jaime` INT( 11 ))";
	$conn->exec($sql_create_ltable);
	echo "Table jaime created successfully.\n";
}
catch(PDOException $e)
{
	echo $e->getMessage() . "\n";
}
?>
