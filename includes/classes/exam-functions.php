<?php $dir = $_SERVER['DOCUMENT_ROOT'] .'cai_project'; ?>

<?php require_once '../includes/database/database.php';?>



<?php

function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


function add_visitor($row,$conn){

	$stmt = $conn->prepare("INSERT INTO visitor(
		ip_address,
		server,data_visit) values(:ip_address,:server,now())
	");

	$stmt->execute(array(
		"ip_address" => $row['ip_address'],
		"server" => $row['server']
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function add_lesson($row,$conn){
	$stmt = $conn->prepare("INSERT INTO tbl_lessons_chapters(
		lesson_description,
		lesson_chapter) values(:lesson_description,:lesson_chapter)
	");

	$stmt->execute(array(
		"lesson_description" => $row['lesson_description'],
		"lesson_chapter" => $row['lesson_chapter']
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $row;
}

function add_sub_lesson($row,$conn){
	$stmt = $conn->prepare("INSERT INTO tbl_lessons_sub_chapters(
		lesson_id,
		lesson_chapter,
		lesson_sub_description) values(:lesson_id,:lesson_chapter,:lesson_sub_description)
	");

	$stmt->execute(array(
		"lesson_id" => $row["lesson_id"],
		"lesson_chapter" => $row["lesson_chapter"],
		"lesson_sub_description" => $row["lesson_sub_description"],

	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $row;
}
function add_user($row,$conn){
	$stmt = $conn->prepare("INSERT INTO tbl_user(
		username,
		password) values(:username,:password)
	");

	$stmt->execute(array(
		"username" => $row["username"],
		"password" => $row["password"],
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $row;
}

function update_user_name($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_user 
		SET username = :username
		WHERE user_id = :user_id
	");

	$stmt->execute(array(
		"username" => $row['username'],
		"user_id" => $row['user_id']
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function query_correct_id($conn,$row,$print = false)
{

	$stmt = $conn->prepare("SELECT * 
		FROM tbl_exam_items
		WHERE exam_item_id =:exam_item_id AND lesson_answer =:lesson_answer AND deleted_at =:deleted_at 
	");
	
	$stmt->execute(array(
		"exam_item_id" => $row["exam_item_id"], 
		"lesson_answer" => $row["lesson_answer"],
		"deleted_at" => "0000-00-00 00:00:00"
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function query_item($conn,$row,$print = false)
{

	$stmt = $conn->prepare("SELECT * 
		FROM tbl_exam_items
		WHERE exam_item_id =:exam_item_id AND deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		"exam_item_id" => $row,
		"deleted_at" => "0000-00-00 00:00:00"
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function update_hash($row,$conn){

	$stmt = $conn->prepare("UPDATE tbl_user 
		SET hash_key = :hash_key
		WHERE user_id = :user_id
	");

	$stmt->execute(array(
		"user_id" => $row["user_id"],
		"hash_key" => $row["hash_key"],
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $row;
}

function check_hash_user($row,$conn){

	$stmt = $conn->prepare("SELECT hash_key 
		FROM tbl_user 
		WHERE user_id = :user_id
	");

	$stmt->execute(array(
		"user_id" => $row["user_id"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $row;
}

function update_user_password($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_user 
		SET password = :password
		WHERE user_id = :user_id
	");

	$stmt->execute(array(
		"password" => $row['password'],
		"user_id" => $row['user_id']
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function update_lesson($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_lessons_chapters 
		SET lesson_chapter = :lesson_chapter, 
			lesson_description = :lesson_description
		WHERE lesson_id = :lesson_id
	");

	$stmt->execute(array(
		"lesson_description" => $row['lesson_description'],
		"lesson_chapter" => $row['lesson_chapter'],
		"lesson_id" => $row['lesson_id']
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function update_sub_lesson($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_lessons_sub_chapters 
		SET lesson_id =:lesson_id,
			lesson_chapter =:lesson_chapter,
			lesson_sub_description =:lesson_sub_description
		WHERE lesson_sub_id = :lesson_sub_id
	");

	$stmt->execute(array(		
		"lesson_sub_id" => $row["lesson_sub_id"],
		"lesson_id" => $row["lesson_id"],
		"lesson_chapter" => $row["lesson_chapter"],
		"lesson_sub_description" => $row["lesson_sub_description"],
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function update_sub_lesson_content($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_lessons_sub_chapters 
		SET content = :content
		WHERE lesson_sub_id = :lesson_sub_id
	");

	$stmt->execute(array(		
		"lesson_sub_id" => $row["lesson_sub_id"],
		"content" => $row["content"],
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}







// $arr = array(
// 		"lesson_sub_id" => $row["1"],
// 		"lesson_id" => $row["1"],
// 		"lesson_chapter" => $row["1"],
// 		"lesson_sub_description" => $row["sample"],
// );

// update_sub_lesson($arr,$conn);

function fetch_lessons($conn,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_lessons_chapters WHERE deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		"deleted_at" => "0000-00-00 00:00:00"

	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}


function fetch_users($conn,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_user WHERE deleted_at = :deleted_at
	");
	
	$stmt->execute(array(
		"deleted_at" => "0000-00-00 00:00:00"
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function fetch_exam_items_lesson_id($conn,$id,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_exam_items
		WHERE lesson_id =:lesson_id AND deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		"lesson_id" => $id,
		"deleted_at" => "0000-00-00 00:00:00"
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function fetch_sub_lesson_id($conn,$id,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_lessons_sub_chapters
		WHERE lesson_id =:lesson_id AND deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		"lesson_id" => $id,
		"deleted_at" => "0000-00-00 00:00:00"
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}


function fetch_exam_by_lesson($conn,$id,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_exam_items
		WHERE lesson_sub_id = :lesson_sub_id AND deleted_at =:deleted_at
		ORDER BY RAND() LIMIT 10
	");
	
	$stmt->execute(array(
		"lesson_sub_id" => $id,
		"deleted_at" => "0000-00-00 00:00:00"
	));

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function fetch_exam_by_chapter($conn,$id,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_exam_items
		WHERE lesson_id = :lesson_id AND deleted_at =:deleted_at
		ORDER BY RAND() LIMIT 30
	");
	
	$stmt->execute(array(
		"lesson_id" => $id,
		"deleted_at" => "0000-00-00 00:00:00"
	));

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}


// fetch_exam_by_lesson($conn,17,true);

function query_lessons($conn, $row, $print=true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_lessons_chapters
		WHERE lesson_chapter = :lesson_chapter OR
		lesson_description = :lesson_description AND deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		"lesson_description" => $row['lesson_description'],
		"lesson_chapter" => $row['lesson_chapter'],
		"deleted_at" => "0000-00-00 00:00:00"
	));

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function query_lessons_id($conn, $row, $print=true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_lessons_chapters
		WHERE lesson_id = :lesson_id AND deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		"lesson_id" => $row['lesson_id'],
		"deleted_at" => "0000-00-00 00:00:00",
	));

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// $row = json_encode($row);

	if ($print) print_r($row); else return $row;
}



function fetch_sub_lessons($conn,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_lessons_sub_chapters WHERE deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		"deleted_at" => "0000-00-00 00:00:00"
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function query_sub_lessons($conn,$id = 1,$print = true){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_lessons_sub_chapters
		WHERE lesson_sub_id = :id AND deleted_at =:deleted_at
	");
	
	$stmt->execute(array(
		'id' => $id,
		"deleted_at" => "0000-00-00 00:00:00"
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	if ($print) print_r($row); else return $row;
}

function add_tally($row,$conn){
	$stmt = $conn->prepare("INSERT INTO tbl_tally(
		lesson_id,lesson_sub_id,exam_item_id,correct,wrong,date_exam,examinee_id
		) 
		VALUES(:lesson_id,:lesson_sub_id,:exam_item_id,:correct,:wrong,now(),:examinee_id)
	");

	$stmt->execute(array(
		"lesson_id" => $row["lesson_id"],
		"lesson_sub_id" => $row["lesson_sub_id"],
		"exam_item_id" => $row["exam_item_id"],
		"correct" => $row["correct"],
		"wrong" => $row["wrong"],
		"examinee_id" => $row["examinee_id"]
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $row;
}


function fetch_tally($row,$conn){
	$stmt = $conn->prepare("SELECT * FROM tbl_tally
		WHERE lesson_id = :lesson_id
	");

	$stmt->execute(array(
		"lesson_id" => $row['lesson_id'],
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $row;
}

function add_results($row,$conn){

	$stmt = $conn->prepare("INSERT INTO tbl_results(
		lesson_id,
		result_date,
		result_score
		) 
		VALUES(:lesson_id,:result_date,:result_score)
	");

	$stmt->execute(array(
		"lesson_id" => $row["lesson_id"],
		"result_date" => $row["result_date"],
		"result_score" => $row["result_score"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);	
}


function add_exam($row,$conn){
	$stmt = $conn->prepare("INSERT INTO tbl_exams(
		exam_id,
		lesson_id,
		exam_description
		) 
		VALUES(:exam_id,:lesson_id,:exam_description)
	");

	$stmt->execute(array(
		"exam_id" => $row["exam_id"],
		"lesson_id" => $row["lesson_id"],
		"exam_description" => $row["exam_description"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);	

}


function add_exam_items($row,$conn){
	$stmt = $conn->prepare("INSERT INTO tbl_exam_items(
		lesson_id,
		lesson_sub_id,
		lesson_question,
		lesson_choice1,
		lesson_choice2,
		lesson_choice3,
		lesson_choice4,
		lesson_answer
		) 
		VALUES(:lesson_id,:lesson_sub_id,:lesson_question,:lesson_choice1,:lesson_choice2,:lesson_choice3,:lesson_choice4,:lesson_answer)
	");

	$stmt->execute(array(
		"lesson_id" => $row["lesson_id"],
		"lesson_sub_id" => $row["lesson_sub_id"],
		"lesson_question" => $row["lesson_question"],
		"lesson_choice1" => $row["lesson_choice1"],
		"lesson_choice2" => $row["lesson_choice2"],
		"lesson_choice3" => $row["lesson_choice3"],
		"lesson_choice4" => $row["lesson_choice4"],
		"lesson_answer" => $row["lesson_answer"]
	));

	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);	
}



function update_exam_items($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_exam_items 
		SET lesson_question = :lesson_question,
			lesson_choice1 = :lesson_choice1,
			lesson_choice2 = :lesson_choice2,
			lesson_choice3 = :lesson_choice3,
			lesson_choice4 = :lesson_choice4,
			lesson_answer = :lesson_answer
		WHERE exam_item_id = :exam_item_id
	");

	$stmt->execute(array(
		"lesson_question" => $row["lesson_question"],
		"lesson_choice1" => $row["lesson_choice1"],
		"lesson_choice2" => $row["lesson_choice2"],
		"lesson_choice3" => $row["lesson_choice3"],
		"lesson_choice4" => $row["lesson_choice4"],
		"lesson_answer" => $row["lesson_answer"],
		"exam_item_id" => $row["exam_item_id"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function validates_user($row,$conn){
	$stmt = $conn->prepare("SELECT * 
		FROM tbl_user
		WHERE username = :username AND password = :password AND deleted_at = :deleted_at
	");
	
	$stmt->execute(array(
		'username' => $row['username'],
		'password' => $row['password'],
		'deleted_at' => '0000-00-00 00:00:00'
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	return $row;
}

function count_correct($row,$conn){
	$stmt = $conn->prepare("SELECT *,
		count(*) AS total FROM tbl_tally
		WHERE correct = 1 and exam_item_id = :exam_item_id and
		date_exam LIKE :date_exam;
	");
	$date = '%';
	if($row['sort_by'] == "all") { $date = '%'; } else
	if($row['sort_by'] == "y") { $date = $row['year'].'-%'; } else
	if($row['sort_by'] == "my") { $date = $row['year'].'-'.$row['month'].'-%'; } else
	if($row['sort_by'] == "my") { $date = $row['year'].'-'.$row['month'].'-'.$row['day'].'%'; }
	$stmt->execute(array(
		'exam_item_id' => $row['exam_item_id'],
		'date_exam' => $date
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	return $row;
}

function count_wrong($row,$conn){
	$stmt = $conn->prepare("SELECT *,
		count(*) AS total FROM tbl_tally
		WHERE wrong = 1 and exam_item_id = :exam_item_id and
		date_exam LIKE :date_exam;
	");
	$date = '%';
	if($row['sort_by'] == "all") { $date = '%'; } else
	if($row['sort_by'] == "y") { $date = $row['year'].'-%'; } else
	if($row['sort_by'] == "my") { $date = $row['year'].'-'.$row['month'].'-%'; } else
	if($row['sort_by'] == "my") { $date = $row['year'].'-'.$row['month'].'-'.$row['day'].'%'; }
	$stmt->execute(array(
		'exam_item_id' => $row['exam_item_id'],
		'date_exam' => $date
	));
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$row = json_encode($row);

	return $row;

}

function show_limit($val,$limit = 20){
	$str = substr($val, 0, $limit);
	if(strlen($val) > $limit) $str .= "...";
	return $str;
}


function random_str(){
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); 
	    $length = 10;
	    $alphaLength = strlen($alphabet) - 1; 
	    for ($i = 0; $i < $length; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	
	}
/////
///delete functions
///

function remove_user($row,$conn){
	
	$stmt = $conn->prepare("UPDATE tbl_user 
		SET deleted_at = now()
		WHERE user_id = :user_id
	");	

	$stmt->execute(array(
		"user_id" => $row["user_id"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);	
}


function remove_lesson($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_lessons_chapters 
		SET deleted_at =now()
		WHERE lesson_id = :lesson_id
	");

	$stmt->execute(array(
		"lesson_id" => $row["lesson_id"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function remove_sub_lesson($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_lessons_sub_chapters 
		SET deleted_at =now()
		WHERE lesson_sub_id = :lesson_sub_id
	");

	$stmt->execute(array(
		"lesson_sub_id" => $row["lesson_sub_id"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function remove_exam_items($row,$conn){
	$stmt = $conn->prepare("UPDATE tbl_exam_items 
		SET deleted_at =now()
		WHERE exam_item_id = :exam_item_id
	");

	$stmt->execute(array(
		"exam_item_id" => $row["exam_item_id"]
	));
	
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

