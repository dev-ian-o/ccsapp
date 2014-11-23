<?php include 'common/header.php';?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php 
	$row = json_decode(Competition::fetch());
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
							Competition
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
								<h3 class="header smaller lighter blue"></h3>
								<div class="table-header clearfix">
									Competitions
									<div class="pull-right">
										<button class="btn btn-success" data-toggle="modal" data-target=".modal-add">ADD <i class="fa fa-plus"></i></button>
									</div>
								</div>

								<table id="table-competition" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Competition Name</th>
											<th>Competition Description</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										<?php $a = 1; foreach ($row as $key => $value):?>
										<tr>
											<td><?= $a++; ?></td>
											<td><?= $value->competition_name; ?></td>
											<td><?= $value->competition_description; ?></td>
											<td class="td-actions">
												<div class="action-buttons">
													<input type="hidden" name="competition_id" value="<?= $value->competition_id; ?>">
													<input type="hidden" name="competition_name" value="<?= $value->competition_name; ?>">
													<input type="hidden" name="competition_description" value="<?= $value->competition_description; ?>">
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

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
<?php include 'modal-competition/add.php'; ?>
<?php include 'modal-competition/edit.php'; ?>
<?php include 'modal-competition/delete.php'; ?>
