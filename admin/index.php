<?php include("common/header.php"); ?>
	<body class="login-layout">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">

							<div class="row-fluid">
								<div class="center">
									<h1>
										<i class="fa fa-laptop gray"></i>
										<span class="green">CCS</span>
										<span class="white">Application</span>
									</h1>
									<h4 class="blue">&copy; UMak Computer Society 2014</h4>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Please Enter Your Information
												</h4>

												<div class="space-6"></div>

												<form />
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" class="span12" name="username" placeholder="Username" />
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" name="lastname" placeholder="Password" />
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="space-4"></div>
														<div class="center">
															<input type="submit" name="submit" class="btn btn-primary">
														</div>
													</fieldset>
												</form>

											</div><!--/widget-main-->

										</div><!--/widget-body-->
									</div><!--/login-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->

<?php include 'common/footer.php';?>
		<!--inline scripts related to this page-->

		<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}
		</script>
