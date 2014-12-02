
<?php

class Scores{
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
			`tbl_scores` (`judges_id`, `competition_id`, `student_no`, `score`, `total_score`, `date_modified`) 
			VALUES (:judges_id, :competition_id, :student_no, :score, :total_score, now());");

		$stmt->execute(array(
			"judges_id" => $row["judges_id"],
			"competition_id" => $row["competition_id"],
			"student_no" => $row["student_no"],
			"score" => json_encode($row["score"]),
			"total_score" => $row["total_score"],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

	}

	public static function edit($row){
		//extend the row array to fetch
		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_scores 
			SET judges_id= :judges_id,
			 	competition_id= :competition_id,
			 	student_no= :student_no,
			 	score= :score,
			 	total_score= :total_score,
			 	date_modified = now()
			WHERE student_no = :student_no AND competition_id = :competition_id 
				AND judges_id = :judges_id");

		$stmt->execute(array(
			"judges_id" => $row["judges_id"],
			"competition_id" => $row["competition_id"],
			"student_no" => $row["student_no"],
			"score" => json_encode($row["score"]),
			"total_score" => $row["total_score"],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

	public static function delete($id){

		$conn = static::connect();

		$stmt = $conn->prepare("UPDATE tbl_scores 
			SET deleted_at = now()
			WHERE scores_id = :id");

		$stmt->execute(array(
			"id" => $id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		
	
	}

	public static function fetch(){	

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_scores WHERE deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM  `tbl_scores`");

		$stmt->execute(array(

		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}

	public static function findById($id){

		$conn = static::connect();

		// $stmt = $conn->prepare("SELECT * FROM tbl_scores WHERE student_no = :id AND deleted_at != NULL");
		$stmt = $conn->prepare("SELECT * FROM tbl_scores WHERE scores_id = :id");

		$stmt->execute(array(
			"id" => $id
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);			
	}


	public static function findByRows($row){

		$conn = static::connect();

		$stmt = $conn->prepare("SELECT * FROM tbl_scores WHERE student_no = :student_no AND competition_id = :competition_id 
					AND judges_id = :judges_id");

		$stmt->execute(array(
			"student_no" => $row['student_no'],
			"competition_id" => $row['competition_id'],
			"judges_id" => $row['judges_id'],
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);			
	}	


	public static function checkWinners($gender,$competition_id){

		$conn = static::connect();

		if(!$competition_id) $competition_id = 1;

		$stmt = $conn->prepare("SELECT contestant_no,b.student_no,lastname,firstname,year,section,course,AVG(a.total_score)
		 as total 
		 FROM tbl_scores a, tbl_contestant b 
		 WHERE b.gender = :gender AND a.student_no = b.student_no AND a.competition_id = :competition_id GROUP BY a.student_no ORDER BY total desc");

		$stmt->execute(array(
			"gender" => $gender,
			"competition_id" => $competition_id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);			
	}	

	public static function checkTally($gender,$competition_id){
		$conn = static::connect();

		if(!$competition_id) $competition_id = 1;

		$stmt = $conn->prepare("SELECT contestant_no,c.name,b.student_no,lastname,firstname,year,section,course,score,total_score 
		FROM tbl_scores a, tbl_contestant b, tbl_judges c 
		WHERE b.gender = :gender AND a.judges_id = c.judges_id AND a.student_no = b.student_no AND a.competition_id = :competition_id 
		ORDER BY contestant_no,c.judges_id ASC");

		$stmt->execute(array(
			"gender" => $gender,
			"competition_id" => $competition_id,
		));
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);		

		return json_encode($row);
	}


}
