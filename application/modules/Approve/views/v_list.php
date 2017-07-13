<section role="main" class="content-body">
<header class="page-header">
	<h2>APPROVE / REJECT</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="<?=base_url('Dashboard');?>">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Approve/Reject</span></li>
		</ol>

		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>

<div class="row">
	<div class="tabs">
			<div class="row">
				<div class="col-md-12">
					<div id="alert-success" class="alert alert-success" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<strong>Well done!</strong> Respond has been saved successfully.
						<br>
						<!-- <span id="span-success" style="display: none">  -->
						<!-- <a href="#" target="_blank" id="linkDownload">Download Purchase Request Document</a> </span> -->
					</div>

					<div id="alert-failure" class="alert alert-danger" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<strong>Oh snap!</strong> <span id="span-failure">Respond failed save</span>
					</div>
				</div>
			</div>

			<ul class="nav nav-tabs" id="tabUL">
				<!-- <li id="litab1">
					<a href="#tab1" data-toggle="tab"><b>Purchase Request</b></a>
				</li>
				<li id="litab2" class="active" >
					<a href="#tab2" data-toggle="tab"><b>Request</b></a>
				</li> -->
				<li class="active" ><a href="#tab3" data-toggle="tab"><b>Approve/Reject (All)</b></a></li>
				<li class="" ><a href="#tab4" data-toggle="tab"><b>Request (Approve)</b></a></li>
				<li class="" ><a href="#tab5" data-toggle="tab"><b>PR (Approve)</b></a></li>
				<li class="" ><a href="#tab9" data-toggle="tab"><b>Mini Proposal</b></a></li>
				<li class="" ><a href="#tab6" data-toggle="tab"><b>Select Memo (Approve)</b></a></li>
				<li class="" ><a href="#tab7" data-toggle="tab"><b>PO (Approve)</b></a></li>
				<li class="" ><a href="#tab8" data-toggle="tab"><b>Reject (All)</b></a></li>
			</ul>

			<div class="tab-content">
				<div id="tab3" class="tab-pane active">			
					<table class="table table-bordered dt" id="tblApproveRejectAll" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Code</th>
								<th>Document</th>
								<th>Requested By</th>
								<th>Type</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($data_all as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value['number']; ?></td>
									<td>
										<?php if ($value['type']=="REQUEST"){ ?>
											<a href="<?php echo $path.'/request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a>
										<?php } elseif ($value['type']=="PURCHASE REQUEST") { ?>
											<a href="<?php echo $path.'/purchase_request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a>
										<?php } elseif ($value['type']=="MINI PROPOSAL") { ?>
											<a href="<?php echo $path.'/mini/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a>
										<?php } ?>
									</td>
									<td><?php echo $value['user']." on ".$value['create_date']; ?></td>
									<td><?php echo $value['type']; ?></td>
									<td>
										<?php if ($value['type']=="REQUEST"){ ?>
											<a href="<?php echo base_url('Approve/confirmRequestApp').'/'.$value['token'].'/'.base64_encode("APPROVE") ?>" class="btn btn-primary btn-sm" >Approve</a>
											<a href="<?php echo base_url('Approve/confirmRequestApp').'/'.$value['token'].'/'.base64_encode("REJECT") ?>" class="btn btn-danger btn-sm" >Reject</a>
										<?php } elseif ($value['type']=="PURCHASE REQUEST") { ?>
											<a href="<?php echo base_url('Approve/confirmPurchaseApp').'/'.$value['token'].'/'.base64_encode("APPROVE") ?>" class="btn btn-primary btn-sm" >Approve</a>
											<a href="<?php echo base_url('Approve/confirmPurchaseApp').'/'.$value['token'].'/'.base64_encode("REJECT") ?>" class="btn btn-danger btn-sm" >Reject</a>	
										<?php } elseif ($value['type']=="MINI PROPOSAL") { ?>
											<a href="<?php echo base_url('Approve/confirmMiniProposalApp').'/'.$value['token'].'/'.base64_encode("APPROVE") ?>" class="btn btn-primary btn-sm" >Approve</a>
											<a href="<?php echo base_url('Approve/confirmMiniProposalApp').'/'.$value['token'].'/'.base64_encode("REJECT") ?>" class="btn btn-danger btn-sm" >Reject</a>	
										<?php } ?>
									</td>
								</tr>							
							<?php endforeach ?>
						</tbody>
					</table>
				</div>								
				<div id="tab4" class="tab-pane">
					<table class="table table-bordered dt" id="tblRequestApprove" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Code</th>
								<th>Document</th>
								<th>Requested By</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($request_approve as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value['number']; ?></td>
									<td><a href="<?php echo $path.'/request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a></td>
									<td><?php echo $value['user']." on ".$value['create_date']; ?></td>
									<td>
										<span style="color: green">APPROVE</span>
									</td>
								</tr>							
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div id="tab5" class="tab-pane">
					<table class="table table-bordered dt" id="tblPRApprove" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Code</th>
								<th>Document</th>
								<th>Requested By</th>
								<th>Item Description</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($pr_approve as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value['number']; ?></td>
									<td><a href="<?php echo $path.'/purchase_request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a></td>
									<td><?php echo $value['user']." on ".$value['create_date']; ?></td>
									<td><?php echo str_replace(",", ";", $value['item']); ?></td>
									<td><span style="color: green">APPROVE</span></td>
									<td style="text-align: center;">
										<?php if ($value['statusNow'] <> "CLOSED"): ?>
											<a href="<?php echo base_url('Quotation/index').'/'.$value['id'] ?>" class="btn btn-success btn-xs">Process</a>											
										<?php endif ?>
									</td>
								</tr>							
							<?php endforeach ?>
						</tbody>
					</table>					
				</div>
				<div id="tab6" class="tab-pane">
					<table class="table table-bordered dt" id="tblMemoApprove" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Code</th>
								<th>Document</th>
								<th>Requested By</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($memo_approve as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value['number']; ?></td>
									<td><a href="<?php echo $path.'/request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a></td>
									<td><?php echo $value['user']." on ".$value['create_date']; ?></td>
									<td>
										<span style="color: green">APPROVE</span>
									</td>
								</tr>							
							<?php endforeach ?>
						</tbody>
					</table>	
				</div>
				<div id="tab7" class="tab-pane">
					<table class="table table-bordered dt" id="tblPOApprove" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Code</th>
								<th>Document</th>
								<th>Requested By</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($po_approve as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value['number']; ?></td>
									<td><a href="<?php echo $path.'/request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a></td>
									<td><?php echo $value['user']." on ".$value['create_date']; ?></td>
									<td>
										<span style="color: green">APPROVE</span>
									</td>
								</tr>							
							<?php endforeach ?>
						</tbody>
					</table>						
				</div>	
				<div id="tab8" class="tab-pane">
					<table class="table table-bordered dt" id="tblRejectAll" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Code</th>
								<th>Document</th>
								<th>Requested By</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($reject_all as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value['number']; ?></td>
									<td>
										<?php if ($value['type']=="REQUEST"){ ?>
											<a href="<?php echo $path.'/request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a>
										<?php } elseif ($value['type']=="PURCHASE REQUEST") { ?>
											<a href="<?php echo $path.'/purchase_request/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a>
										<?php } elseif ($value['type']=="MINI PROPOSAL") { ?>
											<a href="<?php echo $path.'/mini/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a>
										<?php } ?>
									</td>
									<td><?php echo $value['user']." on ".$value['create_date']; ?></td>
									<td>
										<span style="color: red">REJECTED</span>
									</td>
								</tr>							
							<?php endforeach ?>
						</tbody>
					</table>
				</div>	

				<div id="tab9" class="tab-pane">
					<table class="table table-bordered dt" id="tblMiniApprove" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Document</th>
								<th>Requested By</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($mini_proposal as $key => $value): ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><a href="<?php echo $path.'/mini/'.$value['attachment']; ?>" target="_blank"><?php echo $value['attachment']; ?></a></td>
									<td><?php echo $value['create_by']." on ".$value['create_date']; ?></td>
									<td>
										<?php if ($value['purchase_id'] == 0): ?>
											<a href="<?php echo base_url('Purchase_request/index/').$value['id'] ?>" class="btn btn-default btn-sm">PROCESS</a>
										<?php else: ?>
											<?php echo 'PR : '. $value['purchase_number'] ?>
										<?php endif ?>
									</td>
								</tr>							
							<?php endforeach ?>
						</tbody>
					</table>
				</div>							
			</div>


				<!-- .modal dialog alert -->
				<div class="modal fade" id="modal-alert">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						  <h4 class="modal-title">Attention</h4>
						</div>
						<div class="modal-icon" style="padding-top: 10px;">
							<i class="fa fa-stop-circle-o"></i>
						</div>
						<div class="modal-body">
							<div id="data-alert"></div>
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-primary" id="btn_close" data-dismiss="modal"> Ok </button>
						</div>
					  </div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->

				<!-- .modal dialog confirm -->
				<div class="modal fade" id="modal-confirm">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						  <h4 class="modal-title">Are you sure ?</h4>
						</div>
						<div class="modal-icon" style="padding-top: 10px;">
							<i class="fa fa-question-circle"></i>
						</div>
						<div class="modal-body">
							<div id="data-confirm"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"> Reject </button>
							<button type="submit" id="btn_yes" name="btn_yes" class="btn btn-primary"> Approve </button>
						</div>
					  </div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->



	</div>
</div>
</section>


<!-- Vendor -->
<script src="<?=base_url();?>assets/adporto/vendor/jquery/jquery.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- <script src="<?=base_url();?>assets/adporto/vendor/select2/js/select2.js"></script> -->
<script src="<?=base_url();?>assets/adporto/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<!-- <script src="<?=base_url();?>assets/adporto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script> -->
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

<?php if (isset($message)): ?>
	<?php if ($message == "success"): ?>
		<script type="text/javascript">
			document.getElementById("alert-success").style.display = "block";
		</script>
	<?php else: ?>
		<script type="text/javascript">
			var x = document.getElementById("alert-failure").style.display = "block";
		</script>		
	<?php endif ?>
<?php endif ?>

<script type="text/javascript">
	
	// $(function(){
		$(".dt").dataTable({			
			"language": {
				"zeroRecords": "No Data Found"
			}
		});
	// });

</script>