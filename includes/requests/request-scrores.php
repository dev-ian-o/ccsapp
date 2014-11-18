<?php include('../classes/ScreeningRegistration.php');?>
<?php include('../classes/Scores.php');?>
<?php	
	//form name here ----------v
	if(isset($_POST['next']))
	{	
		$reg = ScreeningRegistration::findByNext($_POST);
		$reg = json_decode($reg);
		$_POST['student_no'] = $reg->student_no;
		$scores = json_decode(Scores::findByRows($_POST));
		if(json_decode(Scores::findByRows($_POST))){	
			$final = (object) array_merge((array) $reg, (array) $scores[0]);
			print_r(json_encode($final));
		}else
		{
			print_r(json_encode($reg));
		}

	}



	if(isset($_POST['prev']))
	{	
		$reg = ScreeningRegistration::findByPrev($_POST);
		$reg = json_decode($reg);
		$_POST['student_no'] = $reg->student_no;
		$scores = json_decode(Scores::findByRows($_POST));
		if(json_decode(Scores::findByRows($_POST))){	
			$final = (object) array_merge((array) $reg, (array) $scores[0]);
			print_r(json_encode($final));
		}else
		{
			print_r(json_encode($reg));
		}

	}

	
	if(isset($_POST['nextFemale']))
	{	
		$reg = ScreeningRegistration::findByNext($_POST);
		$reg = json_decode($reg);
		$_POST['student_no'] = $reg->student_no;
		$scores = json_decode(Scores::findByRows($_POST));
		if(json_decode(Scores::findByRows($_POST))){	
			$final = (object) array_merge((array) $reg, (array) $scores[0]);
			print_r(json_encode($final));
		}else
		{
			print_r(json_encode($reg));
		}

	}
	if(isset($_POST['prevFemale']))
	{	
		$reg = ScreeningRegistration::findByPrev($_POST);
		$reg = json_decode($reg);
		$_POST['student_no'] = $reg->student_no;
		$scores = json_decode(Scores::findByRows($_POST));
		if(json_decode(Scores::findByRows($_POST))){	
			$final = (object) array_merge((array) $reg, (array) $scores[0]);
			print_r(json_encode($final));
		}else
		{
			print_r(json_encode($reg));
		}

	}

	
	
	if(isset($_POST['form']))
		if($_POST['form'] === "male_form")
		{
			$_POST["score"] = $_POST["criteria_name"];
			if(json_decode(Scores::findByRows($_POST))){				
				Scores::edit($_POST);
				print_r(json_encode(array("status"=>"edit")));
			}else{
				Scores::add($_POST);
				print_r(json_encode(array("status"=>"add")));
			}

		}


	if(isset($_POST['form']))
		if($_POST['form'] === "female_form")
		{
			$_POST["score"] = $_POST["criteria_name"];
			if(json_decode(Scores::findByRows($_POST))){				
				Scores::edit($_POST);
				print_r(json_encode(array("status"=>"edit")));
			}else{
				Scores::add($_POST);
				print_r(json_encode(array("status"=>"add")));
			}
		}
?>