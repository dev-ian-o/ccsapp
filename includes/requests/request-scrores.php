<?php include('../classes/ScreeningRegistration.php');?>
<?php include('../classes/Scores.php');?>
<?php	
	//form name here ----------v
	if(isset($_POST['next']))
	{	
		if(!isset($_POST['filter']))
			$reg = ScreeningRegistration::findByNext($_POST);
		else
			$reg = ScreeningRegistration::findByNext($_POST,true);

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

		if(!isset($_POST['filter']))
			$reg = ScreeningRegistration::findByPrev($_POST);
		else
			$reg = ScreeningRegistration::findByPrev($_POST,true);
		
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
		if(!isset($_POST['filter']))
			$reg = ScreeningRegistration::findByNext($_POST);
		else
			$reg = ScreeningRegistration::findByNext($_POST,true);

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

		if(!isset($_POST['filter']))
			$reg = ScreeningRegistration::findByPrev($_POST);
		else
			$reg = ScreeningRegistration::findByPrev($_POST,true);
		
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

	
?>