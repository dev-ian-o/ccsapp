
<?php

class Judges{
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
			`tbl_judges` (`name`, `competition_id`, `created_at`) 
			VALUES (:name, :competition_id, now());");

		$stmt->execute(array(
			"name" => $row['name'],
			"competition_id" => $row['competition_id'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($id,$row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_judges 
			SET name = :name,
				competition_id = :competition_id,
				updated_at = now()
			WHERE judges_id = :id");

		$stmt->execute(array(
			"name" => $row['name'],
			"competition_id" => $row['competition_id'],
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_judges 
			SET deleted_at = now()
			WHERE judges_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_judges WHERE deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_judges WHERE deleted_at IS NULL");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_judges WHERE student_no = :id AND deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_judges WHERE judges_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}


	public static function findByName($name){

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_judges WHERE student_no = :id AND deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_judges WHERE name = :name AND deleted_at IS NULL");

		$stmt->execute(array(
			"name" => $name
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}

	public static function findByCompetitionId($competition_id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_judges WHERE competition_id = :competition_id AND deleted_at IS NULL");

		$stmt->execute(array(
			"competition_id" => $competition_id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}
}


