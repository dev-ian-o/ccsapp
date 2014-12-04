<?php include 'common/header.php';?>
<?php require_once '../includes/Classes/MainCriteria.php';?>
<?php require_once '../includes/Classes/Events.php';?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php 
	$row = json_decode(MainCriteria::fetch());
	$rowEvent = json_decode(Events::fetch());
	$rowCompetition = json_decode(Competition::fetch());

	if (isset($_GET['id_competition'])) 
		$competition_id = $_GET['id_competition'];
	else
		$competition_id = "1";

	if (isset($_GET['id_event'])) 
		$event_id = $_GET['id_event'];
	else
		$event_id = "1";
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
							Main Criteria
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
								<h3 class="header smaller lighter blue"></h3>

								Sort By: <select class="form-control" name="sort_by_event">
									<?php foreach ($rowEvent as $key => $value):?>
									<option <?php  if($event_id == $value->event_id) echo"selected"; ?> value="<?= $value->event_id?>"><?= $value->event_name?></option>
									<?php endforeach;?>
								</select>
								Sort By: <select class="form-control" name="sort_by_competition">
									<?php foreach ($rowCompetition as $key => $value):?>
									<option <?php  if($competition_id == $value->competition_id) echo"selected"; ?> value="<?= $value->competition_id?>"><?= $value->competition_description?></option>
									<?php endforeach;?>
								</select>

								<div class="table-header clearfix">
									Main Criteria
									<div class="pull-right">
										<button class="btn btn-success" data-toggle="modal" data-target=".modal-add">ADD <i class="fa fa-plus"></i></button>
									</div>
								</div>

								<table id="table-competition" class="table table-striped table-responsive table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Criteria Name</th>
											<th>Percentage</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										<?php $a = 1; foreach ($row as $key => $value):?>
										<tr>
											<td><?= $a++; ?></td>
											<td><?= $value->main_criteria_name; ?></td>
											<td><?= $value->percentage; ?></td>
											<td class="td-actions">
												<div class="action-buttons">
													<input type="hidden" name="main_criteria_id" value="<?= $value->main_criteria_id; ?>">
													<input type="hidden" name="event_id" value="<?= $value->event_id; ?>">
													<input type="hidden" name="competition_id" value="<?= $value->competition_id; ?>">
													<input type="hidden" name="main_criteria_name" value="<?= $value->main_criteria_name; ?>">
													<input type="hidden" name="percentage" value="<?= $value->percentage; ?>">
													<a class="green" href="#">
														<i class="icon-pencil bigger-130 edit" data-toggle="modal" data-target=".modal-edit"></i>
													</a>
													<a class="red" href="#">
														<i class="icon-trash bigger-130 delete" data-toggle="modal" data-target=".modal-delete"></i>
													</a>
												</div>

											</td>
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

<script type="text/javascript">
  $(function() {
    $('[name=sort_by_event]').on('input', function(){
    	console.log(this);       
        location.href = "<?= $_SERVER['PHP_SELF'] ?>" + "?id_event=" +  $('[name=sort_by_event]').val()+"&let-me-in=ianolinares";
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

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
<?php include 'modal-main-criteria/add.php'; ?>
<?php include 'modal-main-criteria/edit.php'; ?>
<?php include 'modal-main-criteria/delete.php'; ?>
