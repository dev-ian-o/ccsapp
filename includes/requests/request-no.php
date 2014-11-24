<?php include('../classes/ScreeningRegistration.php');?>
<?php include('../classes/Scores.php');?>
<?php	
	//form name here ----------v
	if(isset($_POST['contestant_id'])){
		$reg = ScreeningRegistration::findById($_POST['contestant_id']);
		$reg = json_decode($reg);
		$_POST['student_no'] = $reg[0]->student_no;
		$scores = json_decode(Scores::findByRows($_POST));
		if(json_decode(Scores::findByRows($_POST))){	
			$final = (object) array_merge((array) $reg[0], (array) $scores[0]);
			print_r(json_encode($final));
		}else
		{
			print_r(json_encode($reg[0]));
		}
	}
	
?>