
<?php

class Images{
	public static function connect(){
		$config = array(
			'host' => 'localhost',
			'dbname' => 'ccsdb',
			'username' => 'root',
			'password' => ''
		);
		$conn = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'],$config['username'],$config['password']);

		return $conn;

	}

	public static function add($row){

		$conn = static::connect();

		$stmt = $conn->prepare("INSERT INTO 
			`tbl_images` (`image_name`, `created_at`) 
			VALUES (:image_name, now());");

		$stmt->execute(array(
			"image_name" => $row['image_name'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_images 
			SET image_name = :image_name,
				updated_at = now()
			WHERE image_id = :image_id");


		$stmt->execute(array(
			"image_name" => $row['image_name'],
			"image_id" => $row['image_id'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_images 
			SET deleted_at = now()
			WHERE image_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_images WHERE deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_images WHERE deleted_at IS NULL");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_images WHERE student_no = :id AND deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_images WHERE image_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}


	public static function findByName($name){

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_images WHERE student_no = :id AND deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_images WHERE image_name = :name AND deleted_at IS NULL");

		$stmt->execute(array(
			"name" => $name
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}
}


