<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements

class USER
{
	private $db;

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	public function register($fname, $lname, $uname, $umail, $upass, $activated)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);

			$stmt = $this->db->prepare("INSERT INTO users(user_name, user_email, user_pass, activate) VALUES(:uname, :umail, :upass, :activated)");

			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":activated", $activated);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function login($uname, $umail, $upass)
	{
		try
		{
			$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
			$stmt->execute(array('uname'=>$uname, ':umail'=>$umail));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($stmt->rowCount() > 0)
			{
				if (password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
		return false;
	}

   public function is_loggedin()
   {
      if(isset($_SESSION['user']))
      {
         return true;
      }
   }

	public function redirect($url)
	{
		header("Location: $url");
	}
	public function logout()
	{
		// session_destroy();
		// // unset($_SESSION['user_session']);
		// return true;
		if (ini_get("session.use_cookies")) 
		{
    		$params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
        	$params["path"], $params["domain"],
        	$params["secure"], $params["httponly"]);
		}
		session_destroy();
	}

	public function save_photo($img_owner, $file, $img_height, $img_width, $img_weight)
	{

    	try
    	{
    		$stmt = $this->db->prepare("INSERT INTO photo(photo_auteur, photo_name, photo_height, photo_width, photo_weight_bytes) VALUES (:img_owner, :file, :img_height, :img_width, :img_weight)");
    		$stmt->execute(array(':img_owner'=>$img_owner, ':file'=>$file, ':img_height'=>$img_height, ':img_width'=>$img_width, ':img_weight'=>$img_weight));
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function produce_passwd_key($cle, $user)
	{
		$DB_host = "localhost";
		$DB_user = "root";
		$DB_pass = "";
		$DB_name = "dblogin";
		try
		{
			$conn = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user, $DB_pass);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("UPDATE users SET restore_key = '$cle' WHERE user_name = '$user' ");
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function update_passwd($newpass, $user, $cle)
	{
		$DB_host = "localhost";
		$DB_user = "root";
		$DB_pass = "";
		$DB_name = "dblogin";
		try
		{
			$conn = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user, $DB_pass);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$newpass = password_hash($newpass, PASSWORD_DEFAULT);

			$stmt = $conn->prepare("UPDATE users SET user_pass = '$newpass' WHERE user_name = '$user'");
			$stmt->execute();
			
		
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
	}

	public function delete_picture($picture_id_to_del)
	{
		try
		{
			$stmt = $this->db->prepare("DELETE FROM `photo` WHERE  photo_id = '$picture_id_to_del'");
			$stmt->execute();
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}
	}
	public function comment($comment, $photo_id, $com_owner)
	{
		try
		{
			$stmt = $this->db->prepare("SELECT * FROM photo WHERE '$photo_id' = photo_id LIMIT 1");
			$stmt->execute();
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			$photo_owner = $userRow['photo_auteur'];

			$stmt = $this->db->prepare("SELECT * FROM users WHERE '$photo_owner' = user_name");
			$stmt->execute();
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			$mail = $userRow['user_email'];
		
			// file_put_contents("gallerie.php" , $comment, FILE_APPEND);


			$sujet = "Commentaire sur Camagrue";
			$message = 'Bonjour,
 
 				Une de vos photo sur Camagrue a été commentée.
 
									---------------

				Ceci est un mail automatique, Merci de ne pas y répondre. (Bisou)';

			mail($mail, $sujet, $message);
			$stmt = $this->db->prepare("INSERT INTO commentaire(photo_id, user_name, comm) VALUES('$photo_id', '$com_owner', '$comment')");
			$stmt->execute();
		}
		catch (PDOException $e)
		{
			$e->getMessage();
		}

	}
}
?>

























