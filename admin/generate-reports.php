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
							Reports
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<h3 class="header smaller lighter blue"></h3>
						
								
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