<?php include 'common/header.php';?>
<?php require_once '../includes/Classes/ScreeningRegistration.php';?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php 
	$row = json_decode(ScreeningRegistration::fetch());
	$rowCompetition = json_decode(Competition::fetch());
	if (isset($_GET['id'])) 
		$competition_id = $_GET['id'];
	else
		$competition_id = "all";
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
							Contestant
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
								<h3 class="header smaller lighter blue"></h3>
								Sort By: <select class="form-control" name="sort_by">
									<option value="all" <?php  if($competition_id === "all") echo"selected"; ?>>All Competition</option>

									<?php foreach ($rowCompetition as $key => $value):?>
									<option <?php  if($competition_id == $value->competition_id) echo"selected"; ?> value="<?= $value->competition_id?>"><?= $value->competition_description?></option>									
									
									<?php endforeach;?>
								</select>

								<div class="table-header clearfix">
									Contestants
									<div class="pull-right">
										<button class="btn btn-success" data-toggle="modal" data-target=".modal-add">ADD <i class="fa fa-plus"></i></button>
									</div>
								</div>

								<table id="table-competition" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Student No</th>
											<th>Last Name</th>
											<th>First Name</th>
											<th>Gender</th>
											<th>Year</th>
											<th>Section</th>
											<th>Course</th>
											<th>Contestant no</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										<?php $a = 1; foreach ($row as $key => $value):?>
										<?php if($competition_id == $value->competition_id || $competition_id === "all"):?>
										<tr>
											<td><?= $a++; ?></td>
											<td><?= $value->student_no; ?></td>
											<td><?= $value->lastname; ?></td>
											<td><?= $value->firstname; ?></td>
											<td><?= $value->gender; ?></td>
											<td><?= $value->year; ?></td>
											<td><?= $value->section; ?></td>
											<td><?= $value->course; ?></td>
											<td><?= $value->contestant_no; ?></td>
											<td class="td-actions">
												<div class="action-buttons">
													<input type="hidden" name="student_no" value="<?= $value->student_no; ?>">
													<input type="hidden" name="competition_id" value="<?= $value->competition_id; ?>">
													<input type="hidden" name="lastname" value="<?= $value->lastname; ?>">
													<input type="hidden" name="firstname" value="<?= $value->firstname; ?>">
													<input type="hidden" name="gender" value="<?= $value->gender; ?>">
													<input type="hidden" name="year" value="<?= $value->year; ?>">
													<input type="hidden" name="section" value="<?= $value->section; ?>">
													<input type="hidden" name="course" value="<?= $value->course; ?>">
													<input type="hidden" name="image" value="<?= $value->image; ?>">
													<input type="hidden" name="contestant_no" value="<?= $value->contestant_no; ?>">
													<input type="hidden" name="contestant_id" value="<?= $value->contestant_id; ?>">
													<a class="green" href="#">
														<i class="icon-pencil bigger-130 edit" data-toggle="modal" data-target=".modal-edit"></i>
													</a>
													<a class="red" href="#">
														<i class="icon-trash bigger-130 delete" data-toggle="modal" data-target=".modal-delete"></i>
													</a>
												</div>

											</td>
										</tr>
										<?php endif;?>
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
<?php include 'modal-contestant/add.php'; ?>
<?php include 'modal-contestant/edit.php'; ?>
<?php include 'modal-contestant/delete.php'; ?>

<script type="text/javascript">
  $(function() {
    $('[name=sort_by]').on('input', function(){
    	console.log(this);       
        location.href = "<?= $_SERVER['PHP_SELF'] ?>" + "?id=" +  $('[name=sort_by]').val();
    });
  });
</script>
