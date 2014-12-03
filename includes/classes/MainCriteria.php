
<?php

class MainCriteria{
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

		$stmt = $conn->prepare("INSERT INTO `tbl_main_criteria`(`event_id`, `competition_id`, `main_criteria_name`, `percentage`, `created_at`) 
					VALUES(:event_id,:competition_id, :main_criteria_name, :percentage, now())");

		$stmt->execute(array(
			"event_id" => $row['event_id'],
			"competition_id" => $row['competition_id'],
			"main_criteria_name" => $row['main_criteria_name'],
			"percentage" => $row['percentage'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_main_criteria 
			SET event_id =:event_id,
				competition_id =:competition_id,
				main_criteria_name =:main_criteria_name,
				percentage =:percentage,
				updated_at = now()
			WHERE main_criteria_id = :main_criteria_id");

		$stmt->execute(array(
			"event_id" => $row['event_id'],
			"competition_id" => $row['competition_id'],
			"main_criteria_name" => $row['main_criteria_name'],
			"percentage" => $row['percentage'],
			"main_criteria_id" => $row['main_criteria_id'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_main_criteria 
			SET deleted_at = now()
			WHERE main_criteria_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_main_criteria WHERE deleted_at IS NULL");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_main_criteria WHERE main_criteria_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

}
