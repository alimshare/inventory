<!DOCTYPE html>
<html class="fixed js flexbox flexboxlegacy no-touch csstransforms csstransforms3d no-overflowscrolling no-mobile-device custom-scroll"><head>

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

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/theme-custom.css">

</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="<?=base_url();?>images/logos/linkages.png" height="54" alt="Invento Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Recover Password</h2>
					</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<p class="m-none text-weight-semibold h6">Enter your e-mail below and we will send you reset instructions!</p>
						</div>

						<form action="<?php echo base_url('Login/forget_password_submit') ?>" method="post">
							<div class="form-group mb-none">
								<div class="input-group">
									<input name="txt_email" type="email" placeholder="E-mail" class="form-control input-lg">
									<span class="input-group-btn">
										<button class="btn btn-primary btn-lg" type="submit">Reset!</button>
									</span>
								</div>
							</div>

							<p class="text-center mt-lg">Remembered? <a href="<?php echo base_url('Login') ?>">Sign In!</a></p>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">© Copyright 2016. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		
		<!-- Vendor -->
		<script src="<?=base_url();?>assets/adporto/vendor/jquery/jquery.js"></script>

	</body>
</html>