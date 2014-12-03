<?php if(isset($_GET['let-me-in'])):?>
	<?php if($_GET['let-me-in'] === "ianolinares"):?>
<?php include 'common/header.php';?>
<?php require_once '../includes/Classes/Scores.php';?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php require_once '../includes/Classes/ScreeningRegistration.php';?>
<?php 
	$row = "";
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

	$rowContestant = json_decode(ScreeningRegistration::findByEventIdWithGender(1,$gender));
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

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Winners
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
								<h3 class="header smaller lighter blue"></h3>
								Gender: <select class="form-control" name="sort_by">
									<option <?php if($gender === "male") echo "selected"?> value="male">Male</option>
									<option <?php if($gender === "female") echo "selected"?> value="female">Female</option>
								</select>

								Sort By: <select class="form-control" name="sort_by_competition">
									<?php foreach ($rowCompetition as $key => $value):?>
									<option <?php  if($competition_id == $value->competition_id) echo"selected"; ?> value="<?= $value->competition_id?>"><?= $value->competition_description?></option>									
									<?php endforeach;?>
								</select>
								<div class="table-header clearfix">
									Winners
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
											<?php foreach($rowCompetition as $key => $value):?>
												<?php if( ucwords($value->competition_description) != ucwords("top five")):?>
													<th><?= $value->competition_description;?></th>
												<?php endif;?>
											<?php endforeach;?>
											<th>
												grand-total
											</th>
										</tr>
									</thead>

									<tbody>
										<?php $a = 1;$grandTotal = 0; foreach ($rowContestant as $key => $value):?>
										<?php $grandTotal = 0;?>
										<tr>
											<td><?= $a++; ?></td>
											<td><?= $value->contestant_no; ?></td>
											<td><?= $value->lastname; ?></td>
											<td><?= $value->firstname; ?></td>
											<td><?= $gender; ?></td>
											<td><?= $value->year; ?></td>
											<td><?= $value->section; ?></td>
											
											<?php foreach($rowCompetition as $keyComp => $valueComp):?>
												<?php if( ucwords($valueComp->competition_description) != ucwords("top five")):?>
												<td>

												<?php $row = json_decode(Scores::checkWinnersPerCategory($gender,$valueComp->competition_id)); ?>
												<?php foreach($row as $keyRow => $valueRow):?>
													<?php if($valueRow->competition_id == $valueComp->competition_id && $value->student_no == $valueRow->student_no){ 

															echo $valueRow->total;
															$grandTotal += $valueRow->total;
														}

													?>
												<?php endforeach;?>
												</td>
												<?php endif;?>
											<?php endforeach;?>
											<td><?= $grandTotal;?></td>
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