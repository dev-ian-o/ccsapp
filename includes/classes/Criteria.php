
<?php

class Criteria{
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

		$stmt = $conn->prepare("INSERT INTO `tbl_criteria`(`competition_id`, `criteria_name`, `percentage`, `created_at`) 
					VALUES(:competition_id,:criteria_name, :percentage, now())");

		$stmt->execute(array(
			"competition_id" => $row['competition_id'],
			"criteria_name" => $row['criteria_name'],
			"percentage" => $row['percentage'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_criteria 
			SET competition_id =:competition_id,
				criteria_name =:criteria_name,
				percentage =:percentage,
				updated_at = now()
			WHERE criteria_id = :criteria_id");

		$stmt->execute(array(
			"competition_id" => $row['competition_id'],
			"criteria_name" => $row['criteria_name'],
			"percentage" => $row['percentage'],
			"criteria_id" => $row['criteria_id'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_criteria 
			SET deleted_at = now()
			WHERE criteria_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_criteria WHERE deleted_at IS NULL");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_criteria WHERE criteria_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

}
