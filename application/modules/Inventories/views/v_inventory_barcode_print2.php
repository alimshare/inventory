<html>
	<head>
		<link rel="shortcut icon" type="images/logos/inventory.ico" href="<?=base_url();?>images/logos/inventory.ico" />
		<title>Inventory - Barcode</title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap/css/bootstrap.css" />

	</head>
	<body>
		<div class="row" style="margin: 2px;">
			<?php if(isset($data_all) & count($data_all)>0) { ?>
			<?php foreach($data_all as $dt) { ?>
			<?php $inven_no=base64_encode($dt->list_inv_no); ?>
			<div class="col-sm-4" style="border: 1px solid #123; padding: 10px; width: 50mm; height: 55mm; margin: 2px">
				<div style="text-align: center">
					<div>Property of USAID</div>
					<img src="<?=base_url();?>Inventories/get_barcode2/<?=$inven_no;?>">
				</div>

			</div>
			<?php } ?>
			<?php } ?>
		</div>

		<script>
			window.print();
		</script>
	</body>
</html>
