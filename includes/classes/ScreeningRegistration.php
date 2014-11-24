
<?php

class ScreeningRegistration{
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

		$stmt = $conn->prepare("INSERT INTO `tbl_contestant`(`student_no`, `competition_id`, `lastname`, `firstname`, `gender`, `year`, `section`, `course`, `image`, `created_at`, `contestant_no`) 
					VALUES(:student_no, :competition_id, :lastname, :firstname, :gender, :year, :section, :course, :image, now(), :contestant_no)");

		$stmt->execute(array(
			"student_no" => $row['student_no'],
			"competition_id" => $row['competition_id'],
			"lastname" => $row['lastname'],
			"firstname" => $row['firstname'],
			"gender" => $row['gender'],
			"year" => $row['year'],
			"section" => $row['section'],
			"course" => $row['course'],
			"image" => $row['image'],
			"contestant_no" => $row['contestant_no'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_contestant 
			SET student_no = :student_no,
				competition_id = :competition_id,
				lastname = :lastname,
				firstname = :firstname,
				gender = :gender,
				year = :year,
				section = :section,
				course = :course,
				image = :image,
				contestant_no = :contestant_no,
				updated_at = now()
			WHERE contestant_id = :contestant_id");

		$stmt->execute(array(
			"student_no" => $row['student_no'],
			"competition_id" => $row['competition_id'],
			"contestant_id" => $row['contestant_id'],
			"contestant_no" => $row['contestant_no'],
			"lastname" => $row['lastname'],
			"firstname" => $row['firstname'],
			"gender" => $row['gender'],
			"year" => $row['year'],
			"section" => $row['section'],
			"course" => $row['course'],
			"image" => $row['image'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_contestant 
			SET deleted_at = now()
			WHERE contestant_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_contestant WHERE deleted_at IS NULL ORDER BY contestant_no ASC");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_contestant WHERE contestant_id = :id AND deleted_at IS NULL");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}

	public static function findByCompetitionId($id){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_contestant WHERE competition_id = :id AND deleted_at IS NULL ORDER BY contestant_no ASC");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}

	public static function findByCompetitionIdWithGender($id,$gender){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_contestant WHERE competition_id = :id AND gender LIKE :gender AND deleted_at IS NULL ORDER BY contestant_no ASC");

		$stmt->execute(array(
			"id" => $id,
			"gender" => $gender,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}

	public static function findByNext($row){
		$val = $row;
		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_contestant WHERE gender = :gender AND competition_id =:competition_id AND deleted_at IS NULL ORDER BY contestant_no ASC");

		$stmt->execute(array(
			"competition_id" => $row['competition_id'],
			"gender" => $row['gender'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		foreach ($row as $key => $value) {
			foreach ($value as $key_val => $value_val) {
				
				if($key_val === "contestant_id"){
					if($value_val === $val['contestant_id']){
						if(array_key_exists(++$key, $row)) return json_encode($row[$key]);
						break;
					}
				}
			}
		}
			
	}


	public static function findByPrev($row){
		$val = $row;
		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_contestant WHERE gender = :gender AND competition_id =:competition_id AND deleted_at IS NULL ORDER BY contestant_no ASC");

		$stmt->execute(array(
			"competition_id" => $row['competition_id'],
			"gender" => $row['gender'],
		));
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		foreach ($row as $key => $value) {
			foreach ($value as $key_val => $value_val) {
				
				if($key_val === "contestant_id"){
					if($value_val === $val['contestant_id']){
						if(array_key_exists(--$key, $row)) return json_encode($row[$key]);
						break;
					}
				}
			}
		}
			
	}

	public static function countByGender($row){
		$val = $row;
		$conn = static::connect();

		$stmt = $conn->prepare('SELECT count(*) as number FROM `tbl_contestant` WHERE competition_id=:competition_id AND gender =:gender AND deleted_at IS NULL ORDER BY contestant_no ASC');

		$stmt->execute(array(
			"competition_id" => $row['competition_id'],
			"gender" => $row['gender'],
		));

		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return $row;
	}






}