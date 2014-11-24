<?php include('../classes/ScreeningRegistration.php');?>
<?php include('../classes/Scores.php');?>
<?php	
	
	if(isset($_POST['form']))
		if($_POST['form'] === "male_form")
		{
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
			if(json_decode(Scores::findByRows($_POST))){				
				Scores::edit($_POST);
				print_r(json_encode(array("status"=>"edit")));
			}else{
				Scores::add($_POST);
				print_r(json_encode(array("status"=>"add")));
			}
		}
?>