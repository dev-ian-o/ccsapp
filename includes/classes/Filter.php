
<?php

class Filter{
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

	public static function truncate(){

		$conn = static::connect();

		$stmt = $conn->prepare("TRUNCATE tbl_filter");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function add($row){

		$conn = static::connect();

		$stmt = $conn->prepare("INSERT INTO `tbl_filter`(`event_id`, `competition_id`, `contestant_id`, `gender`, `contestant_no`, `created_at`) 
					VALUES(:event_id,:competition_id,:contestant_id, :gender, :contestant_no, now())");

		$stmt->execute(array(
			"event_id" => $row['event_id'],
			"competition_id" => $row['competition_id'],
			"contestant_id" => $row['contestant_id'],
			"gender" => $row['gender'],
			"contestant_no" => $row['contestant_no'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_filter 
			SET event_id =:event_id,
				competition_id =:competition_id,
				contestant_id =:contestant_id,
				updated_at = now()
			WHERE filter_id = :filter_id");

		$stmt->execute(array(
			"event_id" => $row['event_id'],
			"competition_id" => $row['competition_id'],
			"contestant_id" => $row['contestant_id'],
			"gender" => $row['gender'],
			"filter_id" => $row['filter_id'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_filter 
			SET deleted_at = now()
			WHERE filter_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_filter WHERE deleted_at IS NULL");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_filter WHERE filter_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findByEventId($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_filter WHERE event_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}


	public static function count($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT *,count(*) as total FROM tbl_filter WHERE event_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function countGender($id,$gender){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT *,count(*) as total FROM tbl_filter WHERE event_id  =:id AND gender=:gender AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id,
			"gender" => $gender
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

}
