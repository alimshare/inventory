<!DOCTYPE html>
<html>
<head>

	<title>Confirmation Page</title>
	<!-- Basic -->
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="images/logos/inventory.ico" href="<?=base_url();?>images/logos/inventory.ico" />
	<meta name="keywords" content="<?php echo (isset($meta_key)) ? $meta_key : "inventory, management, system";?>" />
	<meta name="description" content="<?php echo (isset($meta_desc)) ? $meta_desc : "Invento - Inventory Management System";?>">
	<meta name="author" content="<?php echo (isset($meta_author)) ? $meta_author : "USAID";?>">
	<meta name="robots" content="<?php echo (isset($meta_robots)) ? $meta_robots : "All";?>" />

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap/css/bootstrap.css" />

</head>
<body>
	<div class="container" style="margin-top: 25px">
		
		<div class="row">
			<div class="alert alert-<?php echo isset($type)? $type : 'danger'; ?>" role="alert">
			  <strong><?php echo isset($status)? $status : ''; ?></strong> 
			  <?php echo isset($message)? $message : ''; ?>
			</div>
		</div>

		<div class="row text-center">
			<a href="<?php echo base_url() ?>" class="btn btn-default">LOGIN</a>
		</div>

	</div>
</body>	
</html>