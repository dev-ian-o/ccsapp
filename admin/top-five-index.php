<?php if(isset($_GET['let-me-in'])):?>
	<?php if($_GET['let-me-in'] === "ianolinares"):?>
<?php include 'common/header.php';?>
<?php require_once '../includes/Classes/Scores.php';?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php require_once '../includes/Classes/ScreeningRegistration.php';?>
<?php require_once '../includes/Classes/Filter.php';?>
<?php require_once '../includes/Classes/Helper.php';?>
<?php 
	$row = "";

	$rowTopFive = array();

	$rowCompetition = json_decode(Competition::fetch());
	$rowEventCompetition = json_decode(Competition::count(1));
	if (isset($_GET['id'])) 
		$gender = $_GET['id'];
	else
		$gender = "male";

	if (isset($_GET['id_competition'])) 
		$competition_id = $_GET['id_competition'];
	else
		$competition_id = "1";

	// $rowContestant = json_decode(ScreeningRegistration::findByEventIdWithGender(1,$gender));

 $contestantsMale = json_decode(ScreeningRegistration::findByEventIdWithGender(1,"male",true));
 $contestantsFemale = json_decode(ScreeningRegistration::findByEventIdWithGender(1,"female",true));
	// echo "<pre>";
	// print_r($rowEventCompetition[0]);
	// echo "</pre>";
?>
	<body>
		<?php include 'common/nav.php';?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php include 'common/sidebar.php';?>

			<div class="main-content">
			<br>
					<div class="text-center">
						<form method="post">

							<input type="submit" class="btn-large btn-primary btn" name="submit" value="GENERATE TOP FIVE">
						</form>
					</div>
				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Top Five
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
								<h3 class="header smaller lighter blue"></h3>
								

								<div class="table-header clearfix">
									TOP FIVE male
								</div>

								<table id="table-competition" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Contestant No.</th>
											<th>Last Name</th>
											<th>First Name</th>
											<th>Gender</th>
											<th>Year</th>
											<th>Section</th>
										</tr>
									</thead>

									<tbody>
										<?php $a = 1;$grandTotal = 0; foreach ($contestantsMale as $key => $value):?>
										<?php $grandTotal = 0;?>
										<tr>
											<td><?= $a++; ?></td>
											<td><?= $value->contestant_no; ?></td>
											<td><?= $value->lastname; ?></td>
											<td><?= $value->firstname; ?></td>
											<td><?= $gender; ?></td>
											<td><?= $value->year; ?></td>
											<td><?= $value->section; ?></td>
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
								<div class="table-header clearfix">
									TOP FIVE female
								</div>

								<table id="table-competition" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Contestant No.</th>
											<th>Last Name</th>
											<th>First Name</th>
											<th>Gender</th>
											<th>Year</th>
											<th>Section</th>
										</tr>
									</thead>

									<tbody>
										<?php $a = 1;$grandTotal = 0; foreach ($contestantsFemale as $key => $value):?>
										<?php $grandTotal = 0;?>
										<tr>
											<td><?= $a++; ?></td>
											<td><?= $value->contestant_no; ?></td>
											<td><?= $value->lastname; ?></td>
											<td><?= $value->firstname; ?></td>
											<td><?= $gender; ?></td>
											<td><?= $value->year; ?></td>
											<td><?= $value->section; ?></td>
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
				</div><!--/.page-content-->

				<?php include 'common/settings.php';?>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

<?php include 'common/footer.php'; ?>
<script>
	$(function() {
		$('#table-competition').dataTable();
	});
</script>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
<script type="text/javascript">
  $(function() {
    $('[name=sort_by]').on('input', function(){
    	console.log(this);       
        location.href = "<?= $_SERVER['PHP_SELF'] ?>" + "?id=" +  $('[name=sort_by]').val()+"&let-me-in=ianolinares";
    });
  });
</script>

<script type="text/javascript">
  $(function() {
    $('[name=sort_by_competition]').on('input', function(){
    	console.log(this);       
        location.href = "<?= $_SERVER['PHP_SELF'] ?>" + "?id_competition=" +  $('[name=sort_by_competition]').val()+"&let-me-in=ianolinares";
    });
  });
</script>
	<?php endif;?>
<?php endif;?>


<?php
		if(isset($_POST['submit'])){
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

			echo "<script>location.href='{$_SERVER['PHP_SELF']}?let-me-in=ianolinares';</script>";
		}

?>





 <!-- $a = 1;$grandTotal = 0; foreach ($rowContestant as $key => $value):
 $grandTotal = 0;
	$a++; 
	
	 foreach($rowCompetition as $keyComp => $valueComp):
		 if( ucwords($valueComp->competition_description) != ucwords("top five")):
		

		 $row = json_decode(Scores::checkWinnersPerCategory($gender,$valueComp->competition_id)); 
		 foreach($row as $keyRow => $valueRow):
			 if($valueRow->competition_id == $valueComp->competition_id && $value->student_no == $valueRow->student_no){ 

					echo $valueRow->total;
					$grandTotal += $valueRow->total;
					$rowTopFive[$a-2] = array(
						"competition_id" => 9,
						"event_id" => $value->event_id,
						"contestant_id" => $value->contestant_id,
						"gender" => $value->gender,
						"grandTotal" => floatval($grandTotal),
					);  
				}

			
		 endforeach;
		 endif;
	 endforeach;
	$grandTotal;

 endforeach; -->