		<section role="main" class="content-body">
					<header class="page-header">
						<h2>PURCHASE ORDER</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?=base_url('Dashboard');?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Purchase Order</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<div class="row">
						<div class="tabs">
								<ul class="nav nav-tabs" id="tabUL">
									<li class="active" id="litab1">
										<a href="#tab1" data-toggle="tab"><b>Form</b></a>
									</li>
									<li id="litab2">
										<a href="#tab2" data-toggle="tab"><b>List All PO</b></a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="tab1" class="tab-pane active">

										<table class="table table-bordered table-striped mb-none" id="datatable-ajax-vendor" width="100%">
											<thead>
												<tr>
													<th>NO.</th>
													<th>PURCHASE NUMBER</th>
													<th>CODE</th>
													<th>NAME</th>
													<th>ADDRESS</th>
													<th>MEMO</th>
													<th>ACTION</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 1; ?>
												<?php foreach ($memo as $key => $value): ?>
													<tr>
														<td><?php echo $no++ ?></td>
														<td><?php echo $value['purchase_number'] ?></td>
														<td><?php echo $value['vendor_code'] ?></td>
														<td><?php echo $value['vendor_name'] ?></td>
														<td><?php echo $value['vendor_address'].'<br>'.$value['vendor_email'] ?></td>
														<td><?php echo $value['attachment'] ?></td>
														<td><a href="#modal-input-po" id="btn_po" class="modal-with-zoom-anim btn btn-default" onclick="setDataForm(<?php echo $value['id'] ?>)">Process</a></td>
														<script type="text/javascript">
															function setDataForm(id){
																$.ajax({
																	type: 'GET',
																	url: "<?php echo base_url('Po/getPO/') ?>"+id,
																	success: function(response){
																		var json_obj = JSON.parse(response);
																		// console.log(json_obj);

																		$("#txt_po_number").val(json_obj.purchase_number);
																		$("#txt_price").val(json_obj.price);
																		$("#txt_po_vendor_code").val(json_obj.vendor_code);
																		$("#txt_po_vendor_name").val(json_obj.vendor_name);
																		$("#txt_po_vendor_address").val(json_obj.vendor_address);
																		$("#txt_po_vendor_phone").val(json_obj.vendor_phone);
																		
																		var gfas = (json_obj.purchase_number).split("/")[1];
																		$("#txt_po_charge").val(gfas);
																		var details = json_obj.details;
																		var total = 0;
																		for (var i = 0; i < details.length; i++) {
																			// console.log(details[i]);
																			var row = document.createElement('tr'); // create row node
																		    var col1 = document.createElement('td'); // create column node
																		    var col2 = document.createElement('td'); 
																		    var col3 = document.createElement('td'); 
																		    var col4 = document.createElement('td'); 
																		    row.appendChild(col1); // append first column to row
																		    row.appendChild(col2); // append second column to row
																		    row.appendChild(col3); // append second column to row
																		    row.appendChild(col4); // append second column to row
																		    col1.innerHTML= details[i].description; 
																		    col2.innerHTML= details[i].qty;
																		    col3.innerHTML= details[i].unit_price;
																		    col4.innerHTML= (details[i].unit_price * details[i].qty); 
																		    var table = document.getElementById("bodyTableSpec"); // find table to append to
	   																		table.appendChild(row); // append row to table
	   																		total += (details[i].unit_price * details[i].qty);
																		}

																		$("#valTotal").html(total);
																	}
																});
															}
														</script>
													</tr>													
												<?php endforeach ?>
											</tbody>
										</table>							
									</div>
									<div id="tab2" class="tab-pane">
										<table class="table table-bordered tblDT" id="table-ajax" width="100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Purchase Number</th>
													<th>Document</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 1; ?>
												<?php foreach ($po as $key => $value): ?>
													<tr>
														<td><?php echo $no++ ?></td>
														<td><?php echo $value['pur_number'] ?></td>
														<td>
															<?php if ($value['pur_documents']<>""): ?>
																<a href="<?php echo base_url().'documents/po/'.$value['pur_documents'] ?>">Download</a>
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
											  <h4 class="modal-title">Are you sure?</h4>
											</div>
											<div class="modal-icon" style="padding-top: 10px;">
												<i class="fa fa-question-circle"></i>
											</div>
											<div class="modal-body">
												<div id="data-confirm"></div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
												<button type="submit" id="btn_yes" name="btn_yes" class="btn btn-primary"> Yes </button>
											</div>
										  </div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->



						</div>
					</div>
				</section>

				<div id="modal-input-po" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide" >

					<form action="" id="addnew-po" method="post" class="form-horizontal mb-lg" >
						<section class="panel">
							<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
								<h2 class="panel-title" style="font-size: medium; color: white;">Overview Purchase Order</h2>
							</header>
							<div class="panel-body">
								<div>
									<table class="table table-bordered mb-none text-left">
										<thead>
											<tr>
												<th colspan="4"><center>PURCHASE ORDER</center></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td width="30%">
													<div class="form-group">
														<label for="txt_po_number" class="col-sm-12 control-label input" style="text-align: left;">1.ORDER NO.</label>
														<div class="col-sm-12">
															<input type="text" required class="form-control input" id="txt_po_number" name="txt_po_number"  placeholder="Type PO number..." value="" readonly="">
														</div>
													</div>
												</td>
												<td colspan="2">
													<div class="form-group">
														<label for="txt_price" class="col-sm-12 control-label input" style="text-align: center;">2.PRICE TOTAL</label>
														<div class="col-sm-12">
															<input type="text" required class="form-control input" id="txt_price" name="txt_price"  placeholder="Type PO Price..." value="" readonly="">
														</div>
													</div>
												</td>
												<td width="30%">
													<div class="form-group">
														<label for="txt_po_date" class="col-sm-12 control-label input">3.EFFECTIVE DATE</label>
														<div class="col-sm-12">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																<input type="text" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}' class="form-control" name="txt_po_date" id="txt_po_date" value="">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<div class="form-group text-left" style="">
														<label for="txt_po_delivery" class="col-sm-5 control-label input">4.DELIVERY DATE/PERIOD OF PERFORMANCE</label>
														<div class="col-sm-5">
															<div class="input-daterange input-group" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}'>
																<span class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</span>
																<input type="text" class="form-control" name="txt_po_delivery1" id="txt_po_delivery1"  value="">
																<span class="input-group-addon">to</span>
																<input type="text" class="form-control" name="txt_po_delivery2" id="txt_po_delivery2"  value="">
															</div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td width="50%" colspan="2">


													<div class="form-group">
														<label class="control-label col-sm-4">5.VENDOR NAME</label>
														<div class="col-sm-8">
															<input type="hidden" id="txt_po_vendor_code" name="txt_po_vendor_code" readonly="">
															<input type="text" class="form-control input" id="txt_po_vendor_name" name="txt_po_vendor_name"  value="" readonly="">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">ADDRESS</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_po_vendor_address" name="txt_po_vendor_address"  value="" readonly="">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">PHONE NO.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_po_vendor_phone" name="txt_po_vendor_phone" value="" readonly="">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">FAX NO.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_po_vendor_fax" name="txt_po_vendor_fax" value="">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">IDENT. NO.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_po_vendor_ident" name="txt_po_vendor_ident" value="">
														</div>
													</div>

												</td>
												<td width="50%" colspan="2">
													<div class="form-group" style="">
														<label for="txt_sn" class="col-sm-4 control-label input">6.PLACE OF DELIVERY/ ACCEPTANCE</label>
														<div class="col-sm-8">
															<select class="form-control populate" id="txt_place" name="txt_place" data-plugin-selectTwo style="width: 100%;">
																<option value="">--Select--</option>
																<?php foreach ($location as $key => $value): ?>
																	<option value="<?php echo $value['project_name'].', '.$value['loca_province'] ?>"><?php echo $value['project_name'].' - '.$value['loca_province'] ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">MARK ATTN.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_place_mark" name="txt_place_mark" placeholder="Type place mark">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">PHONE NO.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_po_place_phone" name="txt_po_place_phone"  placeholder="Type place phone..." value="">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="form-group">
														<label for="txt_po_charge" class="col-sm-6 control-label input">7.FHI 360 CHARGE CODE</label>
														<div class="col-sm-6">
															<input type="text" class="form-control input" id="txt_po_charge" name="txt_po_charge" value="" readonly="">
														</div>
													</div>
													<div class="form-group">
														<label for="txt_model" class="col-sm-6 control-label input">8.FHI 360 VAT EXEMPTION</label>
														<div class="col-md-2">
															<div class="radio-custom">
																<input type="radio" id="txt_po_vatyes" name="txt_po_vat" value="yes">
																<label for="txt_po_vatyes">Yes</label>
															</div>

														</div>
														<div class="col-md-2">
															<div class="radio-custom">
																<input type="radio" id="txt_po_vatno" name="txt_po_vat" value="no">
																<label for="txt_po_vatno">No</label>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="txt_model" class="col-sm-6 control-label input">9.U.S.G./CLIENT/CONTRACT NO.</label>
														<div class="col-sm-6">
															<input type="text" class="form-control input" id="txt_po_contract" name="txt_po_contract"  placeholder="Type contract number..." value="">
														</div>
													</div>
												</td>
												<td colspan="2">
													<div class="form-group">
														<label class="control-label col-sm-4">10.FHI 360 PURCHASE AGENT</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_po_agent" name="txt_po_agent"  placeholder="Type purchase agent..." value="">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">PHONE/FAX NO.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_po_agent_phone" name="txt_po_agent_phone"  placeholder="Type agent phone/fax no..." value="">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4">E-MAIL ADDRESS</label>
														<div class="col-sm-8">
															<input type="email" class="form-control input" id="txt_po_agent_email" name="txt_po_agent_email"  placeholder="Type agent email address..." value="">
														</div>
													</div>
												</td>
											</tr>

											<tr>
												<td colspan="4">
													<center>11.TYPE OF ORDER</center>
													<center>
														BILATERAL AGREEMENT:  The signature of an authorized official of the Vendor's Organization is required in the space provided below.  This agreement shall not be in effect until the authorized representatives of both parties have affixed
													their respective signatures to an Original of this document.
													</center>
												</td>
											</tr>

											<tr>
												<td colspan="4">
													<center>12.TYPE OF BUSINESS</center>
													<div class="form-group">
														<label class="col-sm-4 control-label">The Vendor certifies that it</label>
														<div class="col-sm-8">
															<div class="checkbox-custom checkbox-default">
																<input type="checkbox" id="txt_po_nonus"  name="txt_po_nonus">
																<label for="checkboxExample1">Non-US Owned/Operated BusinesS</label>
															</div>

															<div class="checkbox-custom checkbox-default">
																<input type="checkbox" id="txt_po_nongov"  name="txt_po_nongov">
																<label for="checkboxExample2">Non-Governmental Owned/Operated/Affiliated Organization</label>
															</div>

														</div>
													</div>

												</td>
											</tr>

											<tr>
												<td colspan="4">
													<center>13.SPECIFICATIONS</center>													
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<table class="table">
														<tr>
															<td>14. Description</td>
															<td>15. Quantity</td>
															<td>16. Unit Price</td>
															<td>17. Totals</td>
														</tr>
														<tbody id="bodyTableSpec">													
														</tbody>
														<tfoot>
															<tr>
																<td></td>
																<td></td>
																<td>TOTAL</td>
																<td id="valTotal"></td>
															</tr>															
														</tfoot>
													</table>											
												</td>
											</tr>
										</tbody>
									</table>
								</div>

							<footer class="panel-footer" style="border: 1px solid #dddddd;">
								<div class="row">
									<div class="col-md-12 text-right">
										<button type="submit" class="btn btn-primary" id="btn_save_po" name="btn_save_po"><i class="fa fa-save"></i> Submit </button>
										<button class="btn btn-default modal-dismiss-po"><i class="fa fa-close"></i> Close </button>
									</div>
								</div>
								<br/>
								<div class="row">
									<div class="col-md-12">
										<div id="po-success" class="alert alert-success" style="display:none;">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
											<strong>Well done!</strong> The record has been saved successfully.
										</div>

										<div id="po-failure" class="alert alert-danger" style="display:none;">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
											<strong>Oh snap!</strong> <span id="span-po-failure"></span>
										</div>
									</div>
								</div>
							</footer>
						</section>
					</form>
				</div>


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

		<script type="text/javascript">
			(function($){

				$(document).on('click', '.modal-dismiss-po', function (e) {
					e.preventDefault();
					$.magnificPopup.close();
				});


				$('#addnew-po').submit(function(e) {
					e.preventDefault();

					if ($("#txt_po_number").val() == ""){
						$("#po-failure").slideDown('slow');
						$("#span-po-failure").html("Po Number can't empty");
					} else {
						$("#po-failure").slideUp();
						$("#btn_save_po").html('<i class="fa fa-spinner"></i> Saving...');
						var data = $("#addnew-po").serialize();

						$.ajax({
							type : "POST",
							url  : '<?=base_url();?>Po/po_do_add',
							data : data,
							success: function(response){

								if(response=="ok"){
									$( '#addnew-po' ).each(function(){
										this.reset();
									});
									//$('#addnew-po input[type="text"]').val('');
									$("#btn_save_po").html('<i class="fa fa-save"></i> Save ');
									$("#po-success").alert();
									$("#po-success").fadeTo(2000, 1000).slideUp(1500, function(){
										$("#po-success").slideUp(1500);
									});
									$("#txt_po_number").val("");
								}
								else
								{
									$("#btn_save_po").html('<i class="fa fa-save"></i> Save ');
									$("#po-failure").slideDown('slow');
									$("#span-po-failure").html(response)
								}

							}
						});
					}
				});

				$(".tblDT").DataTable({
				});
				

			}).apply(this, [jQuery]);
		</script>