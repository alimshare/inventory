<section role="main" class="content-body">
	<header class="page-header">
		<h2>Sub-Contractor</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><a href="<?php echo base_url('Dashboard/settings') ?>"><span>Settings</span></a></li>
				<li><span>Sub-Contractor</span></li>
            </ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

		<section class="panel">
			<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
				<h2 class="panel-title" style="font-size: medium; color: white;"><i class="fa fa-chevron-right"> </i> Sub-Contractor</h2>
			</header>
			<div class="panel-body">
				<div class="row"> 
					<div class="col-sm-6">
						<div class="mb-md">
							<a class="modal-with-zoom-anim btn btn-primary" href="#modalForm"><i class="fa fa-plus"></i> Add new</a>
						</div>
					</div>

					<div id="modalForm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
						<form action="" id="addnew-form" method="post" class="form-horizontal mb-lg" >
							<section class="panel">
								<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
									<h2 class="panel-title" style="font-size: medium; color: white;">Add Sub-Contractor</h2>
								</header>
								<div class="panel-body">
									<div class="form-group mt-lg">
										<label class="col-sm-3 control-label">Company Name</label>
										<div class="col-sm-6">
											<div id="edit-form"></div>
											<input type="text" name="txt_name" id="txt_name" class="form-control" value="" placeholder="Type name..." required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Code</label>
										<div class="col-sm-4">
											<input type="text" name="txt_code" id="txt_code" class="form-control" value="" placeholder="Type code..." required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Address</label>
										<div class="col-sm-6">
											<input type="text" name="txt_address" id="txt_address" class="form-control" value="" placeholder="Type Address..."  />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Phone</label>
										<div class="col-sm-6">
											<input type="text" name="txt_phone" id="txt_phone" class="form-control" value="" placeholder="Type Phone..."  />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Email</label>
										<div class="col-sm-6">
											<input type="email" name="txt_email" id="txt_email" class="form-control" value="" placeholder="Type Email..."  />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Contract</label>
										<div class="col-sm-6">
											<input type="text" name="txt_contract" id="txt_contract" class="form-control" value="" placeholder="Type Contract..."  />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Term of service</label>
										<!-- <div class="col-sm-3">
											<input type="text" name="txt_from" id="txt_from" class="form-control" value="" placeholder="From..."  />
										</div>
										<div class="col-sm-3">
											<input type="text" name="txt_to" id="txt_to" class="form-control" value="" placeholder="To..."  />
										</div> -->
										<div class="col-sm-6">
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
										<label class="col-sm-3 control-label">Project</label>
										<div class="col-sm-6">
											<select data-plugin-selectTwo class="form-control populate" id="txt_project_select" name="txt_project_select" style="width:100%">
												<option value="" title="">Select...</option>
												<?php foreach ($project as $key => $value): ?>
													<option value="<?php echo $value['project_id'] ?>" title=""><?php echo $value['project_code']." - ".$value['project_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Unit/Department</label>
										<div class="col-sm-6">
											<select data-plugin-selectTwo class="form-control" id="txt_unit_select" name="txt_unit_select" style="width:100%">
												<option value="" title="">Select...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Location</label>
										<div class="col-sm-6">
											<select data-plugin-selectTwo class="form-control" id="txt_location_select" name="txt_location_select" style="width:100%">
												<option value="" title="">Select...</option>
											</select>
										</div>
									</div>

								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<button type="submit" class="btn btn-primary" id="btn_save" name="btn_save"><span class="glyphicon glyphicon-floppy-saved"></span> Save </button>
											<button class="btn btn-default modal-dismiss-form"><span class="glyphicon glyphicon-off"></span> Close </button>
										</div>
									</div>
									<br/>
									<div class="row">
										<div class="col-md-12">
											<div id="alert-success" class="alert alert-success" style="display:none;">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
												<strong>Well done!</strong> The record has been saved successfully.
											</div>

											<div id="alert-failure" class="alert alert-danger" style="display:none;">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
												<strong>Oh snap!</strong> <span id="span-failure"></span>
											</div>
										</div>
									</div>
								</footer>
							</section>
						</form>
					</div>

					<div id="modalConfirm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title">Are you sure?</h2>
							</header>
							<div class="panel-body">
								<div class="modal-wrapper">
									<div class="modal-icon">
										<i class="fa fa-question-circle"></i>
									</div>
									<div class="modal-text">
										<p id="del-form"></p>
									</div>
								</div>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-12 text-right">
										<button  type="submit" id="btn_del" name="btn_del" class="btn btn-primary  modal-confirm">Confirm</button>
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
				<table class="table table-bordered table-striped mb-none" id="datatable-ajax">
					<thead>
						<tr>
							<th>NO.</th>
							<th>CODE</th>
							<th>NAME</th>
							<th>CONTRACT</th>
							<th>MODIFY</th>
							<th>ACTIONS</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
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
<script src="<?=base_url();?>assets/adporto/javascripts/forms/examples.advanced.form.js"></script>

<script src="<?=base_url();?>assets/adporto/javascripts/tables/examples.datatables.tabletools.js"></script>


<script>
(function($) {
	'use strict';
	var link_del="";
	var datatableInit = function() {

		LoadDatatable();

		$('#addnew-form').submit(function(e) {
			e.preventDefault();
			$("#alert-failure").slideUp();
			$("#btn_save").html('<span class="glyphicon glyphicon-transfer"></span> Sending...');
			var data = $("#addnew-form").serialize();
			$.ajax({
				type : "POST",
				url  : '<?=base_url();?>Settings/Subcontractor/do_add',
				data : data,
				success: function(response){
					//alert(response);
					if(response=="ok"){
						$('input[type="text"]').val('');
						$("#edit-form").html("");
						$("#btn_save").html('<span class="glyphicon glyphicon-floppy-saved"></span> Save');
						$("#alert-success").alert();
						$("#alert-success").fadeTo(2000, 1000).slideUp(1500, function(){
							$("#alert-success").slideUp(1500);
						});
						LoadDatatable();
					}
					else
					{
						$("#btn_save").html('<span class="glyphicon glyphicon-floppy-saved"></span> Save');
						$("#alert-failure").slideDown('slow');
						$("#span-failure").html(response)
					}

				}
			});
		});

		$('#txt_name').change(function() {
			if($("#txt_code").val()==''){
				//$('#txt_code').val(get_init_code);
				get_new_code();
			}
		});

		$('#txt_project_select').change(function() {
			LoadUnit($(this).val());
			LoadLocation($(this).val());
		});


		$("#datatable-ajax").on('click', '.link-edit', function(e) {
			e.preventDefault();
			var data_href = $(this).attr('link-href');
			$.ajax({
				type: 'GET',
				url: data_href,
				success: function(response){
					var json_obj = JSON.parse(response);
					$("#edit-form").html("<input type='hidden' name='txt_id' id='txt_id' value='"+json_obj.subcontractor_id+"'/>");
					$("#txt_name").val(json_obj.subcontractor_name);
					$("#txt_code").val(json_obj.subcontractor_code);
					$("#txt_address").val(json_obj.subcontractor_address);
					$("#txt_phone").val(json_obj.subcontractor_phone);
					$("#txt_email").val(json_obj.subcontractor_email);
					$("#txt_contract").val(json_obj.contract);
					$("#txt_from").val(json_obj.term_of_service_from);
					$("#txt_to").val(json_obj.term_of_service_end);
					
					$("#txt_project_select").val(json_obj.project_id);
					$("#txt_project_select").val(json_obj.project_id).trigger('change');
					LoadUnit(json_obj.project_id, json_obj.unit_id);
					LoadLocation(json_obj.project_id, json_obj.loca_id);
					// $("#txt_unit_select").val(json_obj.unit_id);
					// $("#txt_location_select").val(json_obj.loca_id);
				}
			});
		});

		$(document).on('click', '.modal-dismiss-form', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
			$('input[type="text"]').val('');
		});


		$("#datatable-ajax").on('click', '.link-del', function(e) {
			e.preventDefault();
			var data_del = $(this).attr('data-del');
			link_del = $(this).attr('link-href');
			$("#del-form").html("Are you sure that you want to delete '"+data_del+"' ? ");
			$('.modal-with-zoom-anim').magnificPopup({
				type: 'inline', fixedContentPos: false, fixedBgPos: true, overflowY: 'auto', loseBtnInside: true,
				preloader: false, midClick: true, removalDelay: 500, mainClass: 'my-mfp-zoom-in', modal: true
			});
		});

		$(document).on('click', '#btn_del', function (e) {
			e.preventDefault();
			$.ajax({
				type: 'GET',
				url: link_del,
				success: function(response){
					if(response=="ok"){
						LoadDatatable();
						/*
						$("#del-success").fadeTo(2000, 1000).slideUp(1500, function(){
							$("#del-success").slideUp(1500);
						});
						*/

					}
					else
					{
						$("#del-failure").slideDown('slow');
						$("#span-del-failure").html(response)
					}
				}

			});
		});


	};

	function LoadDatatable(){
		var $table = $('#datatable-ajax');
		var datatable = $table.dataTable({
			bProcessing: true,
			sAjaxSource: '<?=base_url();?>Settings/Subcontractor/data_json_all',
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

	function get_init_code(){
		var strName =$('#txt_name').val();
		var str4char = strName.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '').toUpperCase().substring(0,3);
		var fName = str4char;
		if(fName.length==2){
			fName+="0";
		}
		if(fName.length==1){
			fName+="00";
		}

		var newId = $('table#datatable-ajax tr:last').index();
		if (newId==0) {
			newId = newId + 1;
		}else{
			newId = newId + 2;
		}
		newId = newId.toString();
		if(newId.length==2){
			newId="0"+newId;
		}
		if(newId.length==1){
			newId="00"+newId;
		}
		return fName+newId;
	}

	function get_new_code(){
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url();?>Settings/Subcontractor/get_new_code',
			success: function(response) {
				if(response!=""){
					$('#txt_code').val(response);
				}
				else
				{
					$('#txt_code').val('001');
				}	
			}
		});
	}

	function LoadUnit(id, value){
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url();?>Settings/Consultant/getComboUnit/'+id,
			success: function(response) {
				$('#txt_unit_select').html(response);
				$("#txt_unit_select").val(value).trigger('change');
			}
		});
	}

	function LoadLocation(id, value){
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url();?>Settings/Consultant/getComboLocation/'+id,
			success: function(response) {
				$('#txt_location_select').html(response);
				$("#txt_location_select").val(value).trigger('change');
			}
		});
	}


	$(function() {
		datatableInit();
	});
	
}).apply(this, [jQuery]);
</script>
