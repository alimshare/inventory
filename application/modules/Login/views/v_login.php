<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<link rel="shortcut icon" type="images/logos/inventory.ico" href="<?=base_url();?>images/logos/inventory.ico" />
		<title>
			Invento | <?php echo (isset($bar_titel)) ? $bar_titel : "Login"; ?>
		</title>
		<meta name="keywords" content="<?php echo (isset($meta_key)) ? $meta_key : "login, inventory, management, system";?>" />
		<meta name="description" content="<?php echo (isset($meta_desc)) ? $meta_desc : "Invento - Inventory Management System";?>">
		<meta name="author" content="<?php echo (isset($meta_author)) ? $meta_author : "USAID";?>">
		<meta name="robots" content="<?php echo (isset($meta_robots)) ? $meta_robots : "All";?>" />


		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?=base_url();?>assets/adporto/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="<?=base_url();?>images/logos/linkages.png" height="54" alt="Invento Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<div id="alert">
							<!-- error will be shown here ! -->
						</div>


						<form action="" id="login-form" method="post">
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input  name="txt_login_name" id="txt_login_name" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<a href="<?php echo base_url('Login/forget_password') ?>" class="pull-right">Lost Password?</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="txt_login_pass" id="txt_login_pass" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" id="btn_signin" class="btn btn-primary hidden-xs"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>

						</form>
					</div>
				</div>

			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?=base_url();?>assets/adporto/vendor/jquery/jquery.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/jquery-placeholder/jquery-placeholder.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="<?=base_url();?>assets/adporto/javascripts/theme.js"></script>

		<!-- Theme Custom -->
		<script src="<?=base_url();?>assets/adporto/javascripts/theme.custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="<?=base_url();?>assets/adporto/javascripts/theme.init.js"></script>

		<script>
			(function($) {
			'use strict';
			var datatableInit = function() {
				$('#btn_signin').click(function(e) {
					e.preventDefault();
					var data = $("#login-form").serialize();
					$.ajax({
						type : 'POST',
						url  : '<?=base_url();?>Login/do_login',
						data : data,
						beforeSend: function()
						{
							$("#btn_signin").html('<span class="glyphicon glyphicon-transfer"></span> Sending...');
						},
						success :  function(response)
						{
							//alert(response);
							if(response=="ok"){
								$("#alert").html('<div class="alert alert-success"><strong>Well done!</strong> Authentication has been successfully.<br/>Please wait while directing...</div>');
								$("#btn_signin").html('<span class="glyphicon glyphicon-transfer"></span> Authen...');
								setTimeout(' window.location.href = "<?=base_url();?>Dashboard"; ',3000);
							}
							else
							{
								$("#alert").fadeIn(1000, function(){
									$("#alert").html('<div id="alert-login" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Oh snap!</strong> '+response+'</div>');
									$("#btn_signin").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
								});
							}

						}
					});
					return false;
				});
			};

			$(function() {
				datatableInit();
			});

		}).apply(this, [jQuery]);
         </script>

	</body>
</html>
