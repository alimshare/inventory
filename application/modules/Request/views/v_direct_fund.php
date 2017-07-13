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
		<h2>Direct Fund</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Direct Fund</span></li>
            </ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

		<section class="row">
			<div class="panel col-md-12">
				<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
					<h2 class="panel-title" style="font-size: medium; color: white;"><i class="fa fa-chevron-right"> </i> Direct Fund</h2>
				</header>			
				<div class="panel-body">

					<div class="tabs">
						<ul class="nav nav-tabs" id="tabUL">
							<li class="active" id="litab1">
								<a href="#tab1" data-toggle="tab"><b>Form</b></a>
							</li>
						</ul>

							<div class="tab-content">
								<div id="tab1" class="tab-pane active">
									<section class="panel mt-lg">

										<form action="<?php echo base_url('Request/saveDirectFund') ?>" id="frmDirectFund" method="post" class="form-horizontal mb-lg">
											<input type="hidden" name="txt_submitto" id="txt_submitto" value="">
											<div class="form-group">
												<label class="col-sm-3 control-label">Type of paste your Proposal Background</label>
												<div class="col-sm-9">
													<textarea name="txt_background" class="form-control" rows="5"></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label">What</label>
												<div class="col-sm-9">
													<input type="text" name="txt_what" id="txt_what" class="form-control" value="" placeholder="Type What ..." />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Why</label>
												<div class="col-sm-9">
													<input type="text" name="txt_why" id="txt_why" class="form-control" value="" placeholder="Type Why ..." />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Who</label>
												<div class="col-sm-9">
													<input type="text" name="txt_who" id="txt_who" class="form-control" value="" placeholder="Type Who ..." />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Where</label>
												<div class="col-sm-9">
													<input type="text" name="txt_where" id="txt_where" class="form-control" value="" placeholder="Type Where ..." />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Date</label>
												<div class="col-sm-9">
													<div class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" name="txt_from">
														<span class="input-group-addon">to</span>
														<input type="text" class="form-control" name="txt_to">
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">How and or justification</label>
												<div class="col-sm-9">
													<textarea name="txt_justification" class="form-control" rows="5"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label"></label>
												<div class="col-sm-9">
													<div class="row">
														<div class="col-sm-6">
															<table class="table">
																<tr>
																	<td>Number of Participant</td>
																	<td><input type="text" name="txt_num_participant" class="form-control"></td>
																</tr>
																<tr>
																	<td>Number of special guess</td>
																	<td><input type="text" name="txt_num_guess" class="form-control"></td>
																</tr>
																<tr>
																	<td>Number of FHI/Project Staff</td>
																	<td><input type="text" name="txt_num_staff" class="form-control"></td>
																</tr>
																<tr>
																	<td>Number of Resource Person</td>
																	<td><input type="text" name="txt_num_person" class="form-control"></td>
																</tr>
																<tr>
																	<td>Number of Facilitator</td>
																	<td><input type="text" name="txt_num_facilitator" class="form-control"></td>
																</tr>
															</table>
														</div>
														<div class="col-sm-6">
															<table class="table">
																<tr>
																	<td>
																		<input type="checkbox" name="isFullDay" id="isFullDay" value="1">
																		<label for="isFullDay">Full Day Meeting</label>
																	</td>
																	<td>
																		<input type="checkbox" name="isHotel" id="isHotel" value="1">
																		<label for="isHotel">Hotel</label>
																	</td>
																</tr>
																<tr>
																	<td>
																		<input type="checkbox" name="isHalfDay" id="isHalfDay" value="1">
																		<label for="isHalfDay">Half Day Meeting</label>
																	</td>
																	<td>
																		<input type="checkbox" name="isPerdiem" id="isPerdiem" value="1">
																		<label for="isPerdiem">Perdiem</label>
																	</td>
																</tr>
																<tr>
																	<td>
																		<input type="checkbox" name="isTransportation" id="isTransportation" value="1">
																		<label for="isTransportation">Transportation</label>
																	</td>
																	<td>
																		<input type="checkbox" name="isMisc" id="isMisc" value="1">
																		<label for="isMisc">Miscellaneous</label>
																	</td>
																</tr>
																<tr>
																	<td>
																		<input type="checkbox" name="isPrinting" id="isPrinting" value="1">
																		<label for="isPrinting">Printing</label>
																	</td>
																	<td>
																		<input type="checkbox" name="isAirplaneTicket" id="isAirplaneTicket" value="1">
																		<label for="isAirplaneTicket">Airplane Ticket</label>
																	</td>
																</tr>
															</table>
														</div>
													</div>
												</div>
											</div>



											<br>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<a href='#modalForm' class="modal-with-zoom-anim on-default btn btn-primary" id="btn_save" name="btn_save"><span class="glyphicon glyphicon-floppy-saved"></span> Save </a>
													</div>
												</div>
											</footer>
										</form>
									</section>
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
													<p id="del-form">Are you sure want submit mini proposal ?</p>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="button" id="btn_del" name="btn_del" class="btn btn-primary modal-confirm" onclick="submitRequest()">Submit</button>
													<script type="text/javascript">
														function submitRequest(){
															document.getElementById("frmDirectFund").submit();
														}
													</script>
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


								<div id="modalForm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
									<form action="" id="addnew-form" method="post" class="form-horizontal mb-lg" >
										<section class="panel">
											<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
												<h2 class="panel-title" style="font-size: medium; color: white;">Submit Your Request</h2>
											</header>
											<div class="panel-body">
												<div class="form-group mt-lg">
													<label class="col-sm-2 control-label">Submit to</label>
													<div class="col-sm-10">
													  <select class="form-control select2" name="submitto" id="submitto">
													    <?php foreach ($user as $key => $value): ?>
													      <option value="<?php echo $value['email']; ?>"><?php echo $value['username']." - ".$value['email'] ?></option>
													    <?php endforeach ?>
													  </select>  
													</div>
												</div>

											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button type="button" class="btn btn-primary" id="btnSubmitTo" name="btnSubmitTo" onclick="submitRequest()">
															<span class="glyphicon glyphicon-forward"></span> Submit 
														</button>
														<button class="btn btn-default modal-dismiss-form"><span class="glyphicon glyphicon-off"></span> Close </button>
													</div>
												</div>
												<br/>
											</footer>
										</section>
									</form>
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
	function submitRequest(){
		var submitto = document.getElementById("submitto").value;
		$("#txt_submitto").val(submitto);
		$("#frmDirectFund").submit();
	}
</script>