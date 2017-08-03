<HTML>

<head>
	<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap/css/bootstrap.css" />
	<style type="text/css">
		body{
			background: #40402a;
		}
	</style>
</head>

<body>
	
	<div class="container">
		
		<div id="content" class="row" style="margin-top: 35px">
			<div class="">
				
				<form action="<?php echo base_url('Link/submitQuotation') ?>" id="" method="post" class="form-horizontal mb-lg" enctype="multipart/form-data">
					<section class="panel">
						<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
							<h2 class="panel-title" style="font-size: medium; color: white;">Submit Your Quotation</h2>
						</header>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">Date Submission</label>
								<div class="col-sm-9">
									<label><?php echo $submission_date ?></label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Subject</label>
								<div class="col-sm-9">
									<label><?php echo $subject ?></label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Purchase Request Number</label>
								<div class="col-sm-9">
									<label><?php echo $purchase_number ?></label>
									<input type="hidden" value="<?php echo $purchase_number ?>" name="txt_purchase_number">
								</div>
							</div>
							<br>
							<br>
							<input type="hidden" value="<?php echo $id ?>" name="txt_id">
							<input type="hidden" value="<?php echo $token ?>" name="txt_token">
							<input type="hidden" value="<?php echo $email ?>" name="txt_email">
							<div class="form-group">
								<label class="col-sm-3 control-label">Vendor Name</label>
								<div class="col-sm-9">
								<?php if ($vendor == ""): ?>
									<input type="text" name="txt_vendor" id="txt_vendor" class="form-control" value="" placeholder="Type Vendor Name ..." required />
								<?php else: ?>
									<input type="text" name="txt_vendor" id="txt_vendor" class="form-control" value="<?php echo $vendor ?>" placeholder="Type Vendor Name ..." required readonly="" />
								<?php endif ?>
								</div>
							</div>
							<div class="form-group mt-lg">
								<label class="col-sm-3 control-label">Quotation</label>
								<div class="col-sm-9">
									<input type="file" name="txt_quotation" id="txt_quotation" class="form-control" value="" />
									<p class="help">Attachment Type: pdf</p>
								</div>
							</div>
						</div>

						</div>
						<footer class="panel-footer">
							<div class="row">
								<div class="col-md-12 text-center">
									<button type="submit" class="btn btn-primary btn-lg" id="btn_save" name="btn_save">
									<span class="glyphicon glyphicon-upload"></span> Submit </button>
								</div>
							</div>
							<br/>
						</footer>
					</section>
				</form>
			</div>
		</div>
		
	</div>

</body>


</HTML>