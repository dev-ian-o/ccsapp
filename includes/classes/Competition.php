
<?php

class Competition{
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

		$stmt = $conn->prepare("INSERT INTO `tbl_competition`(`competition_name`, `competition_description`, `created_at`) 
					VALUES(:competition_name,:competition_description, now())");

		$stmt->execute(array(
			"competition_name" => $row['competition_name'],
			"competition_description" => $row['competition_description'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_competition 
			SET competition_name =:competition_name,
				competition_description =:competition_description,
				updated_at = now()
			WHERE competition_id = :competition_id");

		$stmt->execute(array(
			"competition_name" => $row['competition_name'],
			"competition_description" => $row['competition_description'],
			"competition_id" => $row['competition_id'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_competition 
			SET deleted_at = now()
			WHERE competition_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_competition WHERE deleted_at IS NULL");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_competition WHERE competition_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

}
