
<?php

class Student{
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
			`tbl_student` (`student_no`, `lastname`, `firstname`, `birthdate`, `year`, `section`, `course`, `image`, `created_at`) 
			VALUES (:student_no, :lastname, :firstname, :birthdate, :year, :section, :course, :image, now());");

		$stmt->execute(array(
			"student_no" => $row['student_no'],
			"lastname" => $row['lastname'],
			"firstname" => $row['firstname'],
			"birthdate" => $row['birthdate'],
			"year" => $row['year'],
			"section" => $row['section'],
			"course" => $row['course'],
			"image" => $row['image'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($id,$row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_student 
			SET student_no = :student_no,
				lastname = :lastname,
				firstname = :firstname,
				birthdate = :birthdate,
				year = :year,
				section = :section,
				course = :course,
				image = :image,
				updated_at = now()
			WHERE student_no = :id");

		$stmt->execute(array(
			"student_no" => $row['student_no'],
			"lastname" => $row['lastname'],
			"firstname" => $row['firstname'],
			"birthdate" => $row['birthdate'],
			"year" => $row['year'],
			"section" => $row['section'],
			"course" => $row['course'],
			"image" => $row['image'],
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_student 
			SET deleted_at = now()
			WHERE student_no = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_student WHERE deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_student");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_student WHERE student_no = :id AND deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_student WHERE student_no = :id");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
			
	}
}

// $arr = array(
// 			"student_no" =>'asdas',
// 			"lastname" =>'lastnaasde',
// 			"firstname" =>'firstnaasde',
// 			"birthdate" =>'birthdate',
// 			"year" =>'yeardasd',
// 			"section" =>'sectidason',
// 			"course" =>'coursdase',
// 			"image" =>'imagedas',
// 		);
// $id = "asdas";
$x = new Student;
// print_r($x->findById($id));

