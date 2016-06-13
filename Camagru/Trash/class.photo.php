<?php

class PHOTO
{
	private $db;

	function __construct($DB_pic)
	{
		$this->db = $DB_pic;
	}
	
	public function save_photo($img_owner, $file, $img_height, $img_width, $img_weight)
	{

    try
    {
    	$stmt = $this->db->prepare("INSERT INTO photo(photo_auteur, photo_name, photo_height, photo_width, photo_weight_bytes) VALUES(:img_owner, :file, :img_height, :img_width, :img_weight)");
        // $conn = new PDO("mysql:host=$DB_host;dbname=$DB_name", $DB_user, $DB_pass);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $req = $conn->prepare($sql);
        $req->bindparam(":img_owner", $img_owner);
        $req->bindparam(":file", $file);
        $req->bindparam(":img_height", $img_height);
        $req->bindparam(":img_width", $img_width);
        $req->bindparam(":img_weight", $img_weight);

        $req->execute();
        return $stmt;
        // $req->setFetchMode(PDO::FETCH_ASSOC);
	}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}