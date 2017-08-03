<style type="text/css">
	.modal-block {
		background: transparent;
		padding: 0;
		text-align: left;
		max-width: 80%;
		margin: 40px auto;
		position: relative;
	}
</style>
		<section role="main" class="content-body">
					<header class="page-header">
						<h2>SELECTION MEMO</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?=base_url('Dashboard');?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Memo</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<div class="row">
						<div class="tabs">
								<ul class="nav nav-tabs" id="tabUL">
									<li class="active" id="litab1">
										<a href="#tab1" data-toggle="tab"><b>New Vendor</b></a>
									</li>
									<li id="litab2">
										<a href="#tab2" data-toggle="tab"><b>Memo Documentation</b></a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="tab1" class="tab-pane active">
										<div class="panel">
											<div class="panel-body">
												<table class="table table-bordered mt-lg">
													<thead>
														<tr>
															<th>No</th>
															<th>Vendor Name</th>
															<th>Attachment</th>
															<th>PR Number</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1; ?>
														<?php foreach ($memo as $key => $value): ?>
															<tr>
																<td><?php echo $i++; ?></td>
																<td><?php echo $value['vendor_name'] ?></td>
																<td>
																	<a target="_blank" href="<?php echo base_url().'documents/vendor_quotation/'.$value['attachment'] ?>">
																	<?php echo $value['attachment'] ?></a>
																</td>
																<td><?php echo $value['purchase_number'] ?></td>
																<td>
																	<a href="#modalForm" class="modal-with-zoom-anim btn btn-success btn-sm" data-form="<?php echo $value['purchase_number'].'|'.$value['vendor_name'].'|'.$value['submission_date'] ?>" onclick="setDataForm('<?php echo $value['quotation_id'] ?>')">Process</a>
																</td>
															</tr>															
														<?php endforeach ?>
													</tbody>
												</table>	


												<div id="modalForm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">

													<section class="panel form-wizard" id="w1">
														<header class="panel-heading">
															<div class="panel-actions">
																<!-- <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
																<a href="#" class="modal-dismiss" data-panel-dismiss=""><span class="glyphicon glyphicon-off"></span></a> -->
																<button class="btn btn-default modal-dismiss"><span class="glyphicon glyphicon-off"></span> Close </button>
															</div>

															<h2 class="panel-title">Process Memo</h2>
														</header>
														<div class="panel-body panel-body-nopadding">
															<div class="wizard-tabs">
																<ul class="wizard-steps">
																	<li class="active">
																		<a href="#w1-account" data-toggle="tab" class="text-center" aria-expanded="true">
																			<span class="badge hidden-xs">1</span> Data
																		</a>
																	</li>
																	<li class="">
																		<a href="#w1-profile" data-toggle="tab" class="text-center" aria-expanded="false">
																			<span class="badge hidden-xs">2</span> Vendor
																		</a>
																	</li>
																	<li>
																		<a href="#w1-confirm" data-toggle="tab" class="text-center">
																			<span class="badge hidden-xs">3</span> Justification
																		</a>
																	</li>
																</ul>
															</div>
															<form class="form-horizontal" novalidate="novalidate" id="frmMemo" action="<?php echo base_url('Memo/saveProcess') ?>" method="post">
																<input type="hidden" name="txt_purchase_number" id="txt_purchase_number" value="">
																<input type="hidden" name="txt_quotation_id" id="txt_quotation_id" value="">
																<div class="tab-content">
																	<div id="w1-account" class="tab-pane active table-responsive">
																		 <table class="table table-bordered" id="tableRequest">
																              <thead>
																                <tr>
																                  <td width="17%">Purchase Request Number</td>
																                  <td width="15%">Vendor Name</td>
																                  <td width="11%">Date Submitted</td>
																                  <td><input type="text" name="header[]" width="50px" class='form-control'></td>
																                  <td><input type="text" name="header[]" width="50px" class='form-control'></td>
																                  <td><input type="text" name="header[]" width="50px" class='form-control'></td>
																                  <td>													                  	
																                  	<button type="button" class="btn btn-success btn-sm" onclick='createCol()'>
																                  		<span class="glyphicon glyphicon-plus"></span> Add Column
																                  	</button>
																                  </td>
																                </tr>
																              </thead>
																              <tbody id="requestBody">

																              </tbody>
															            </table>
																	</div>
																	<div id="w1-profile" class="tab-pane">
																		<div class="form-group mt-lg">
																			<label class="col-sm-2 control-label" for="txt_winner">Vendor Winner</label>
																			<div class="col-sm-10">
																				<select class="form-control" name="txt_winner" id="txt_winner">
																					<option>--Select--</option>
																					<?php foreach ($memo as $key => $value): ?>
																						<option value="<?php echo $value['id'] ?>" ><?php echo $value['vendor_name'] ?></option>
																					<?php endforeach ?>
																				</select>
																			</div>
																		</div>
																		<br>
																	</div>
																	<div id="w1-confirm" class="tab-pane">
																		<div class="form-group mt-lg">
																			<label class="col-sm-2 control-label" for="w1-email">Justifaction Memo</label>
																			<div class="col-sm-10">
																				<textarea id="txt_justification" name="txt_justification" class="form-control" rows="8"></textarea>
																			</div>
																		</div>
																		<div class="form-group">
																			<div class="col-sm-2"></div>
																			<div class="col-sm-10">
																				<div class="checkbox-custom">
																					<input type="checkbox" name="terms" id="w1-terms" required="" aria-required="true" onclick="cekTerms(this)">
																					<label for="w1-terms">I agree to the terms of service</label>
																					<script type="text/javascript">
																						function cekTerms(elem){	
																							if (elem.checked){
																								document.getElementById("li-finish").style.display = "block";
																							} else {
																								document.getElementById("li-finish").style.display = "none";
																							}
																						}
																					</script>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
														</div>
														<div class="panel-footer">
															<ul class="pager">
																<li class="pull-right" id="li-finish" style="display: none">
																	<!-- <a class="">Finish</a> -->
																	<button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
																</li>
															</ul>
															<script type="text/javascript">
																function submitForm(){
																	document.getElementById("frmMemo").submit();
																}
															</script>
														</div>
													</section>
												</div>											
											</div>

										</div>								
									</div>

									<div id="tab2" class="tab-pane">

										<table class="table table-bordered table-striped mb-none" id="datatable-ajax-vendor" width="100%">
											<thead>
												<tr>
													<th>NO.</th>
													<th>Purchase Number</th>
													<th>CODE</th>
													<th>NAME</th>
													<th>ADDRESS</th>
													<th>DOCUMENT</th>
													<th>MODIFY</th>
													<th>PROCESS TO PO</th>
												</tr>
											</thead>
											<tbody>
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
	
	function createRow(){

		var table 	= document.getElementById("tableRequest"); // find table to append to
		var cellLen = table.rows[0].cells.length;

	    var row = document.createElement('tr'); // create row node

	    for (var i=0; i<cellLen-1; i++){
	    	var col = document.createElement('td');
	    	col.innerHTML= "<input type='text' name='content[]' class='form-control'>";
	    	row.appendChild(col);
	    }

    	var col = document.createElement('td');
	    col.innerHTML= "<button class='btn btn-box-tool' type='button' onclick='remove(this)'><i class='fa fa-times'></i></button>";
	    row.appendChild(col);

	    var body = document.getElementById("requestBody"); // find table to append to
	    body.appendChild(row); // append row to table
	}

	function createCol(){
		// alert('col');
		var table = document.getElementById("tableRequest"); // find table to append to
		// console.log(table);
		var rows = table.rows;
		for (var i=0; i<rows.length; i++){
			var row = rows[i];
			var parent = row.parentNode.nodeName;
			// console.log(parent);
			if (parent.toLocaleLowerCase()=="thead") {
				var cellLen = row.cells.length;
				var col = row.insertCell(cellLen-1);
				col.innerHTML = "<input type='text' name='header[]' width='50px' class='form-control'>";
			} else {
				var cellLen = row.cells.length;
				var col = row.insertCell(cellLen-1);
				col.innerHTML = "<input type='text' name='content[]' class='form-control'>";				
			}
		}
	}

	function remove(x){
		var rowIndex = x.parentNode.parentNode.rowIndex;
		document.getElementById("tableRequest").deleteRow(rowIndex);
	}
</script>
<script>
(function($) {
	'use strict';
	var link_del="";
	var datatableInit = function() {

	LoadDatatableVendor();

	function LoadDatatableVendor(){
		var $table = $('#datatable-ajax-vendor');
		var datatable = $table.dataTable({
			bProcessing: true,
			sAjaxSource: '<?=base_url();?>Memo/data_json_all',
			bDestroy: true,
			aoColumnDefs:[
			{
				bSortable: false,
				aTargets: [ 0 ]
			},
			{
				className: "center",
				targets: [0]
			}
			],

			"fnDrawCallback": function () {
				$('.modal-with-zoom-anim').magnificPopup({
					type: 'inline',

					fixedContentPos: false,
					fixedBgPos: true,

					overflowY: 'auto',

					closeBtnInside: true,
					preloader: false,

					midClick: true,
					removalDelay: 500,
					mainClass: 'my-mfp-zoom-in',
					modal: true
				});
			}
		});
	}

}


	$(function() {
		datatableInit();
	});
	
}).apply(this, [jQuery]);
</script>

<script type="text/javascript">
	function setDataForm(id){
		$.ajax({
			type: 'GET',
			url: "<?php echo base_url('Memo/getQuotationVendor/') ?>"+id,
			success: function(response){
				// console.log(response);
				var json_obj = JSON.parse(response);

				var table 	= document.getElementById("tableRequest"); // find table to append to
				var cellLen = table.rows[0].cells.length;
				var body = document.getElementById("requestBody"); // find table to append to
				$("#tableRequest tr:not(:first)").remove(); 

				var purchase_number = "";
				var quotation_id = id;

				for (var i=0; i<json_obj.length; i++){

					purchase_number = json_obj[i].purchase_number;
				    var row = document.createElement('tr'); // create row node

				    for (var j=0; j<cellLen-1; j++){
					    var col = document.createElement('td');
				    	if (j==0){
					    	col.innerHTML= "<input type='hidden' name='vendor[]'><input type='text' name='content["+json_obj[i].id+"][]' class='form-control' value='"+json_obj[i].purchase_number+"' readonly=''>";
				    	} else if (j==1) {
					    	col.innerHTML= "<input type='text' name='content["+json_obj[i].id+"][]' class='form-control' value='"+json_obj[i].vendor_name+"' readonly=''>";
				    	}  else if (j==2) {
					    	col.innerHTML= "<input type='text' name='content["+json_obj[i].id+"][]' class='form-control' value='"+json_obj[i].submission_date+"' readonly=''>";
				    	} else {
					    	col.innerHTML= "<input type='text' name='content["+json_obj[i].id+"][]' class='form-control'>";
				    	}
					    row.appendChild(col);
				    }

			    	var col = document.createElement('td');
				    col.innerHTML= "";
				    row.appendChild(col);

					body.appendChild(row); // append row to table
				}

				$("#txt_quotation_id").val(quotation_id);
				$("#txt_purchase_number").val(purchase_number);


			}
		});
	}
</script>