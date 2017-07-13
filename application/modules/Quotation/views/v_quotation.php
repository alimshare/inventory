<style type="text/css">
	.bootstrap-tagsinput {
	  background-color: #fff;
	  border: 1px solid #ccc;
	  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	  clear: both;
	  display: block;
	  padding: 4px 6px;
	  color: #555;
	  vertical-align: middle;
	  border-radius: 4px;
	  max-width: 100%;
	  line-height: 22px;
	  cursor: text;
	}
	.bootstrap-tagsinput input {
	    border: 0;
	    background: transparent /* the important bit */
	}
	.tag span:after {
		content: " | X "
	}
	.tag span {
		cursor: pointer;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Quotation</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Quotation</span></li>
            </ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

		<section class="row">
			<div class="panel col-md-12">
				<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
					<h2 class="panel-title" style="font-size: medium; color: white;"><i class="fa fa-chevron-right"> </i> Quotation</h2>
				</header>			
				<div class="panel-body">

					<div class="tabs">
						<ul class="nav nav-tabs" id="tabUL">
							<li class="active" id="litab1">
								<a href="#tab1" data-toggle="tab"><b>Form</b></a>
							</li>
							<!-- <li id="">
								<a href="#tab2" data-toggle="tab"><b>Quotation</b></a>
							</li> -->
							<li id="litab2" class="">
								<a href="#tab3" data-toggle="tab"><b>Quotation List</b></a>
							</li>
						</ul>

							<div class="tab-content">
								<div id="tab1" class="tab-pane active">
									<section class="panel mt-lg">

										<form action="<?php echo base_url('Quotation/save') ?>" id="frmQuotation" method="post" class="form-horizontal mb-lg" enctype="multipart/form-data">
					
											<div class="form-group">
												<label class="col-sm-3 control-label">To</label>
												<div class="col-sm-9">
													<select data-plugin-selectTwo multiple="" class="form-control populate" aria-hidden="true" id="" name="txt_vendor[]" style="width:100%">
														<?php foreach ($vendor as $key => $row): ?>
															<option value="<?php echo $row['vendor_contact']."|".$row['vendor_email'] ?>"><?php echo $row['vendor_name']." - ".$row['vendor_email'] ?></option>
														<?php endforeach ?>
													</select>
													<p><a class="modal-with-zoom-anim btn btn-link btn-xs" href="#modalForm">Add Other Vendor</a></p>
													<select name="txt_otherVendor[]" multiple="" data-role="tagsinput" id="otherVendorContainer"></select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label">Nomor PR</label>
												<div class="col-sm-9">
													<input type="text" name="txt_purchase_number" id="txt_purchase_number" class="form-control" value="<?php echo (isset($purchase_number)) ? $purchase_number : "" ?>" placeholder="Type Purchase Request Number..." <?php echo (isset($purchase_number)) ? "readonly" : "" ?> required />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Subject</label>
												<div class="col-sm-9">
													<input type="text" name="txt_subject" id="" class="form-control" value="" placeholder="Type Subject..." required />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Specification</label>
												<div class="col-sm-9">
													<input type="text" name="txt_specification" id="txt_specification" class="form-control" value="<?php echo (isset($specification)) ? $specification : "" ?>" <?php echo (isset($specification)) ? "readonly" : "" ?> placeholder="Type Specification..." required />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Date for submission</label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker="" class="form-control"  name="txt_date" id="txt_date" required="">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Invitation</label>
												<div class="col-sm-9">
													<input type="file" name="invitation" id="" class="form-control" value="" />
													<p class="help">Attachment Type: pdf</p>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Attach TOR</label>
												<div class="col-sm-9">
													<input type="file" name="tor" id="" class="form-control" value="" />
													<p class="help">Attachment Type: pdf</p>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Attach RFQ/RFP</label>
												<div class="col-sm-9">
													<input type="file" name="rfq" id="" class="form-control" value="" />
													<p class="help">Attachment Type: pdf</p>
												</div>
											</div>

											<div id="modalForm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
												<section class="panel">
													<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
														<h2 class="panel-title" style="font-size: medium; color: white;">Add Other Vendor</h2>
													</header>
													<div class="panel-body">
														<div class="form-group mt-lg">
															<label class="col-sm-3 control-label">Vendor Name</label>
															<div class="col-sm-6">
																<div id="edit-form"></div>
																<input type="text" name="txt_name" id="txt_name" class="form-control" value="" placeholder="Type Vendor Name..." />
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3 control-label">Email</label>
															<div class="col-sm-4">
																<input type="email" name="txt_email" id="txt_email" class="form-control" value="" placeholder="Type Email..." />
															</div>
														</div>
													</div>
													<footer class="panel-footer">
														<div class="row">
															<div class="col-md-12 text-right">
																<button type="button" class="btn btn-primary" id="btn_add_other_vendor" name="btn_save"><span class="glyphicon glyphicon-plus"></span> Add </button>
																<button class="btn btn-default modal-dismiss"><span class="glyphicon glyphicon-off"></span> Close </button>
															</div>
														</div>
													</footer>
												</section>
											</div>
											<br>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<a href='#modalConfirm' class="modal-with-zoom-anim on-default btn btn-primary" id="btn_save" name="btn_save"><span class="glyphicon glyphicon-floppy-saved"></span> Save </a>
													</div>
												</div>
											</footer>
										</form>
									</section>
								</div>

								<!-- <div id="tab2" class="tab-pane">
									<section class="panel mt-lg">

										<form action="<?php echo base_url('quotation/saveWinner') ?>" id="frmWinner" method="post" class="form-horizontal mb-lg" >
											
											<div class="form-group">
												<label class="col-sm-3 control-label">Purchase Request Number</label>
												<div class="col-sm-9">
													<input type="text" name="txt_purchase_number" id="txt_purchase_number" class="form-control" value="<?php echo (isset($purchase_number)) ? $purchase_number : "" ?>" placeholder="Type Purchase Request Number..." <?php echo (isset($purchase_number)) ? "readonly" : "" ?> required />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Winner</label>
												<div class="col-sm-9">
													<select class="form-control" name="txt_winner" id="txt_winner">
														<?php if (count(@$quotation) > 0): ?>
															<?php foreach ($quotation as $key => $value): ?>
																<option value="<?php echo $value['id'] ?>"><?php echo $value['vendor_name'] ?></option>
															<?php endforeach ?>															
														<?php endif ?>
													</select>
												</div>
											</div>

											<div id="modalConfirm2" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
												<section class="panel">
													<header class="panel-heading">
														<h2 class="panel-title">Confirmation Winner</h2>
													</header>
													<div class="panel-body">
														<div class="modal-wrapper">
															<div class="modal-icon">
																<i class="fa fa-question-circle"></i>
															</div>
															<div class="modal-text">
																<p id="del-form">Are you sure choose this vendor as winner ?</p>
															</div>
														</div>
													</div>
													<footer class="panel-footer">
														<div class="row">
															<div class="col-md-12 text-right">
																<button type="button" id="btn_del" name="btn_del" class="btn btn-primary modal-confirm" onclick="submitWinner()">Send</button>
																<button class="btn btn-default modal-dismiss">Cancel</button>
															</div>
														</div>
														<br/>
															<div class="row">
																<div class="col-md-12">
																	<div id="del-success" class="alert alert-success" style="display:none;">
																		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																		<strong>Well done!</strong> The record has been successfully deleted.
																	</div>

																	<div id="del-failure" class="alert alert-danger" style="display:none;">
																		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																		<strong>Oh snap!</strong> <span id="span-del-failure"></span>
																	</div>
																</div>
															</div>
													</footer>
												</section>
											</div>
											<br>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<?php if (isset($purchase_number)): ?>
															<a href='#modalConfirm2' class="modal-with-zoom-anim on-default btn btn-primary" id="btn_save" name="btn_save"><span class="glyphicon glyphicon-floppy-saved"></span> Save </a>															
														<?php endif ?>
													</div>
												</div>
											</footer>
										</form>
									</section>
								</div>-->

								<div id="tab3" class="tab-pane">
									<!-- <table class="table table-bordered dt" id="tblRequestApprove" width="100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Vendor</th>
												<th>Attachment</th>
												<th>Purchase Number</th>
												<th>Process To Selection Memo</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; ?>
											<?php foreach ($quotation_list as $key => $value): ?>
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $value['vendor_name']; ?></td>
													<td><a href="<?php echo base_url().'documents/vendor_quotation/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a></td>
													<td><?php echo $value['purchase_request_number']; ?></td>
													<td>
														<?php if ($value['status']=="WINNER"): ?>
																<a href="<?php echo base_url('memo') ?>" class="btn btn-primary btn-sm" id="" name=""> Process </a>				
														<?php endif ?>
													</td>
												</tr>							
											<?php endforeach ?>
										</tbody>
									</table> -->
									<table class="table table-bordered dt" id="tblRequestApprove" width="100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Purchase Number</th>
												<th>Subject</th>
												<th>Submission Date</th>
												<th>Documents</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; ?>
											<?php foreach ($quotation_list as $key => $value): ?>
												<tr>
													<td><?php echo $no++; ?></td>
													<td><?php echo $value['purchase_number'] ?></td>
													<td><?php echo $value['subject'] ?></td>
													<td><?php echo $value['submission_date'] ?></td>
													<td>
														<ul>
															<li><a href="<?php echo base_url().'documents/quotation/'.$value['attachment_invitation'] ?>" target="_blank">Invitation</a></li>
															<li><a href="<?php echo base_url().'documents/quotation/'.$value['attachment_tor'] ?>" target="_blank">TOR</a></li>
															<li><a href="<?php echo base_url().'documents/quotation/'.$value['attachment_rfq'] ?>" target="_blank">RFQ/RFP</a></li>
														</ul>
													</td>
													<td><?php echo $value['status'] ?></td>
													<td>
														<?php #if ($value['status']<>"CLOSED"): ?>
																<a href="<?php echo base_url('Memo/index/').$value['id'] ?>" class="btn btn-primary btn-sm" id="" name=""> Process </a>				
														<?php #endif ?>														
													</td>
												</tr>												
											<?php endforeach ?>
										</tbody>
									</table>
								</div>

								
								<div id="modalConfirm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<section class="panel">
										<header class="panel-heading">
											<h2 class="panel-title">Confirmation Message</h2>
										</header>
										<div class="panel-body">
											<div class="modal-wrapper">
												<div class="modal-icon">
													<i class="fa fa-question-circle"></i>
												</div>
												<div class="modal-text">
													<p id="del-form">Are you sure want broadcast this information ?</p>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="button" id="btn_del" name="btn_del" class="btn btn-primary modal-confirm" onclick="submitRequest()">Send</button>
													<button class="btn btn-default modal-dismiss">Cancel</button>
												</div>
											</div>
											<br/>
												<div class="row">
													<div class="col-md-12">
														<div id="del-success" class="alert alert-success" style="display:none;">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
															<strong>Well done!</strong> The record has been successfully deleted.
														</div>

														<div id="del-failure" class="alert alert-danger" style="display:none;">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
															<strong>Oh snap!</strong> <span id="span-del-failure"></span>
														</div>
													</div>
												</div>
										</footer>
									</section>
								</div>
							</div>
						</form>

					</div>
						
				</div>
							
			</div>
		</section>
</section>




<!-- Vendor -->
<script src="<?=base_url();?>assets/adporto/vendor/jquery/jquery.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<script src="<?=base_url();?>assets/adporto/vendor/select2/js/select2.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>


<!-- Specific Page Vendor -->
<script src="<?=base_url();?>assets/adporto/vendor/jquery-ui/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/select2/js/select2.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/fuelux/js/spinner.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/dropzone/dropzone.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-markdown/js/markdown.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-markdown/js/to-markdown.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/codemirror/lib/codemirror.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/codemirror/addon/selection/active-line.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/codemirror/addon/edit/matchbrackets.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/codemirror/mode/javascript/javascript.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/codemirror/mode/xml/xml.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/codemirror/mode/css/css.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/summernote/summernote.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/ios7-switch/ios7-switch.js"></script>
<!-- <script src="<?=base_url();?>assets/adporto/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script> -->
<script src="<?=base_url();?>assets/adporto/vendor/magnific-popup/jquery.magnific-popup.js"></script>


<script src="<?=base_url();?>assets/adporto/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- Specific Page Vendor -->
<script src="<?=base_url();?>assets/adporto/vendor/select2/js/select2.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/pnotify/pnotify.custom.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?=base_url();?>assets/adporto/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="<?=base_url();?>assets/adporto/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?=base_url();?>assets/adporto/javascripts/theme.init.js"></script>

<!-- Examples -->
<script src="<?=base_url();?>assets/adporto/javascripts/ui-elements/examples.modals.js"></script>
<!-- Examples -->
<!-- <script src="<?=base_url();?>assets/adporto/javascripts/forms/examples.advanced.form.js"></script> -->

<!-- <script src="<?=base_url();?>assets/adporto/javascripts/tables/examples.datatables.tabletools.js"></script> -->

<script type="text/javascript">
	
	(function($){
		$("#otherVendorContainer").tagsinput({
			itemValue: 'value',
			itemText: 'text',
			tagClass: 'btn btn-default btn-sm'
		});

		$("#btn_add_other_vendor").click(function(){
			var vendorName 		= $("#txt_name").val();
			var vendorEmail 	= $("#txt_email").val();
			$('#otherVendorContainer').tagsinput('add', { "value": vendorName+"|"+vendorEmail , "text": vendorName+" - "+vendorEmail, "continent":"" });

			$("#txt_name").val("");
			$("#txt_email").val("");
			$.magnificPopup.close();
		});


	}).apply(this, [jQuery]);
	

</script>
<?php if (isset($message)): ?>
	<?php if ($message == "success"): ?>
		<script type="text/javascript">
			document.getElementById("alert-success").style.display = "block";
		</script>
	<?php else: ?>
		<script type="text/javascript">
			var x = document.getElementById("alert-failure").style.display = "block";
			<?php 
				$str_error = "";
				if (count($_SESSION['error_arr'])>0){
					for ($i=0; $i < count($_SESSION['error_arr']); $i++) { 
						$str_error .= "<br>".$_SESSION['error_arr'][$i];
					}
				}
			?>
			document.getElementById("span-failure").innerHTML = "<?php echo $str_error; ?>";
		</script>		
	<?php endif ?>
<?php endif ?>
<script type="text/javascript">

	function submitRequest(){
		$("#frmQuotation").submit();
	}

	function submitWinner(){
		$("#frmWinner").submit();
	}

</script>