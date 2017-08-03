<html>
	<head>
		<link rel="shortcut icon" type="images/logos/inventory.ico" href="<?=base_url();?>images/logos/inventory.ico" />
		<title>Inventory - Barcode</title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap/css/bootstrap.css" />

	</head>
	<style>		
		@media print {
			.page-break	{ display: block; page-break-before: always; }
		}
	</style>
	<body>
		<?php	if(isset($data_all) & count($data_all)>0) { ?>
					
			<?php
				$num_row=count($data_all);
				$num_per_page=33;
				$num_page=ceil($num_row/$num_per_page);
				$row=1;
				foreach($data_all as $dt) {
				
			?>		
			
			<?php $inven_no=base64_encode($dt->list_inv_no); ?>
			<?php if(!isset($page)){ ?>
			<div class="row" style="margin: 2mm; width: 210mm; border: 0px solid #123;">
			<?php }else if($row==$limit+1){ ?>
			<div class="row page-break" style="margin: 2mm; width: 210mm; border: 0px solid #123;">
			<?php } ?>
			<div  class="col-xs-4" style="border: 1px solid #123; padding: 2px; width: 64mm; height: 24mm; margin: 2px">
				<div style="text-align: center;  width: 14mm; float: left; padding-top: 2mm">
					<img style="width: 14mm;" src="<?=base_url();?>images/logos/fhi360.jpg">
				</div>
				<div style="text-align: center;  width: 48mm; float: right">
					<div style=" font-size: 10px; font-family: calibri"><b>Property of USAID</b></div>
					<img style="width: 48mm;" src="<?=base_url();?>Inventories/get_barcode/<?=$inven_no;?>">
				</div>

			</div>
			<?php
				if(!isset($page)){
					$page=1;					
				}
				$limit=$page*$num_per_page;
				
				if($limit==$row){
					$page++;
			?>
			</div>
			<?php
				}
				
				$row++;
			?>
			
			<?php } ?>
			<?php } ?>
		
		
		
		<!--
		<div class="row  page-break" style="margin: 2mm; width: 210mm; border: 0px solid #123;">
			
			<?php $n=1; if(isset($data_all) & count($data_all)>0) { ?>
			<?php foreach($data_all as $dt) { ?>
			<?php $inven_no=base64_encode($dt->list_inv_no); ?>
			<div  class="col-xs-4" style="border: 1px solid #123; padding: 2px; width: 64mm; height: 24mm; margin: 2px">
				<div style="text-align: center;  width: 14mm; float: left; padding-top: 2mm">
					<img style="width: 14mm;" src="<?=base_url();?>images/logos/fhi360.jpg">
				</div>
				<div style="text-align: center;  width: 48mm; float: right">
					<div style=" font-size: 10px; font-family: calibri"><b>Property of USAID</b></div>
					<img style="width: 48mm;" src="<?=base_url();?>Inventories/get_barcode/<?=$inven_no;?>">
				</div>

			</div>
			<?php $n++; } ?>
			<?php } ?>
		</div>
		-->
		
		
		<!--
		<div style="width: 210mm;
        min-height: 297mm;
        border: 0px solid #111;">
			<?php if(isset($data_all) & count($data_all)>0) { ?>
			<?php foreach($data_all as $dt) { ?>
			<?php $inven_no=base64_encode($dt->list_inv_no); ?>
			<div style="border: 1px solid #123; padding: 3px; width: 70mm; height: 25mm; margin: 2px">
				<div style="text-align: center;  width: 16mm; float: left; padding-top: 0mm">
					<img style="width: 16mm;" src="<?=base_url();?>images/logos/fhi360.jpg">
				</div>
				<div style="text-align: center;  width: 50mm; float: right">
					<div style=" font-size: 10px; font-family: calibri"><b>Property of USAID</b></div>
					<img style="width: 50mm;" src="<?=base_url();?>Inventories/get_barcode/<?=$inven_no;?>">
				</div>

			</div>
			<?php } ?>
			<?php } ?>
		</div>
		-->
		<script>
			window.print();
		</script>
	</body>
</html>
