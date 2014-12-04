<?php
class Helpers{
	
	public static function random_str(){
	    $alphabet = "0123456789";
	    $pass = array(); 
	    $length = 4;
	    $alphaLength = strlen($alphabet) - 1; 
	    for ($i = 0; $i < $length; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return floatval(implode($pass)); //turn the array into a string
	
	}

	public static function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
		    $sort_col[$key] = $row[$col];
		}

		array_multisort($sort_col, $dir, $arr);
	}
}

	function generate_top_five(){
		$rowTopFive = array();
		$arr = array("male","female");
		$a = 1;
		$grandTotal = 0;
		Filter::truncate();
		foreach ($arr as $keyArr => $valueArr):
			$a = 1;
			$grandTotal = 0; 

			$rowContestant = json_decode(ScreeningRegistration::findByEventIdWithGender(1,$valueArr));
			foreach ($rowContestant as $key => $value):
				$grandTotal = 0;
				$a++; 

				foreach($rowCompetition as $keyComp => $valueComp):
				 if( ucwords($valueComp->competition_description) != ucwords("top five")):

					 $row = json_decode(Scores::checkWinnersPerCategory($valueArr,$valueComp->competition_id)); 
						// echo "<pre>";
						// print_r($row);
						// echo "</pre>";

					 foreach($row as $keyRow => $valueRow):
						 if($valueRow->competition_id == $valueComp->competition_id && $value->student_no == $valueRow->student_no){ 

								$grandTotal += $valueRow->total;
								$rowTopFive[$a-2] = array(
									"competition_id" => 9,
									"event_id" => $value->event_id,
									"contestant_id" => $value->contestant_id,
									"gender" => $value->gender,
									"grandTotal" => floatval($grandTotal),
									"contestant_no" => intval(Helpers::random_str()),
									"already" => $value->already,
								);  
							}

						
					 endforeach;
				 endif;
				endforeach;

			endforeach;

			Helpers::array_sort_by_column($rowTopFive, 'grandTotal');
			Helpers::array_sort_by_column($rowTopFive, 'already');
			$x = 0;
			while (5 > $x) {
				Filter::add($rowTopFive[$x++]);
			}
			// print_r($rowTopFive);
			// $rowTopFive = array();
		endforeach;
	}