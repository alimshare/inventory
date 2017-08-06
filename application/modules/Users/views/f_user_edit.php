<section role="main" class="content-body">
	<header class="page-header">
		<h2>User Form</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><a href="<?php echo base_url('Users') ?>"><span>Users</span></a></li>
				<li><span>Edit</span></li>
            </ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

		<section class="panel">
			<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
				<h2 class="panel-title" style="font-size: medium; color: white;"><i class="fa fa-chevron-right"> </i> User Management</h2>
			</header>
			<div class="panel-body">
				<div class="row"> 
					<div class="col-sm-6">
						<div class="mb-md">
							<a class="modal-with-zoom-anim btn btn-primary" href="#modalForm"><i class="fa fa-plus"></i> Add new</a>
						</div>
					</div>

					<div id="modalForm" class="">
						<form action="" id="addnew-form" method="post" class="form-horizontal mb-lg" enctype="multipart/form-data">
							<section class="panel">
								<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
									<h2 class="panel-title" style="font-size: medium; color: white;">Update Form</h2>
								</header>
								<div class="panel-body">
									<div class="form-group">
										<label class="col-sm-3 control-label">Account Name/Login</label>
										<div class="col-sm-6">
											<div id="edit-form"><input type='hidden' name='txt_id' id='txt_id' value='<?php echo $id ?>'/></div>
											<input type="text" name="txt_account" id="txt_account" class="form-control" value="<?php echo $user->account_name; ?>" placeholder="Type name..." required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Username</label>
										<div class="col-sm-6">
											<input type="text" name="txt_username" id="txt_username" class="form-control" value="<?php echo $user->username; ?>" placeholder="Type username..." required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Email</label>
										<div class="col-sm-6">
											<input type="email" name="txt_email" id="txt_email" class="form-control" value="<?php echo $user->email; ?>" placeholder="Type email..." required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Role</label>
										<div class="col-sm-6">
											<select name="txt_role" class="form-control">
												<option value="">Select...</option>
												<option value="OPERATION" <?php echo ($user->role=="OPERATION")?'selected':''; ?>>Operation</option>
												<option value="PROGRAMITIC" <?php echo ($user->role=="PROGRAMITIC")?'selected':''; ?>>Programitic</option>
												<option value="MANAGEMENT" <?php echo ($user->role=="MANAGEMENT")?'selected':''; ?>>Management</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Project</label>
										<div class="col-sm-6">
											<select data-plugin-selectTwo class="form-control populate" id="txt_project_select" name="txt_project_select" style="width:100%">
												<option value="" title="">Select...</option>
												<?php foreach ($project as $key => $value): ?>
													<option value="<?php echo $value['project_id'] ?>" 
													<?php if ($value['project_id'] == $user->project_id): ?>
														selected = ""
													<?php endif ?>
													><?php echo $value['project_code']." - ".$value['project_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Unit/Department</label>
										<div class="col-sm-6">
											<select data-plugin-selectTwo class="form-control" id="txt_unit_select" name="txt_unit_select" style="width:100%">
												<option value="" title="">Select...</option>
												<?php foreach ($unit as $key => $value): ?>
													<option value="<?php echo $value['id'] ?>" 
														<?php if ($value['id'] == $user->unit_id): ?>
															selected = ""
														<?php endif ?>
													><?php echo $value['unit_name']." - ".$value['project_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Location</label>
										<div class="col-sm-6">
											<select data-plugin-selectTwo class="form-control" id="txt_location_select" name="txt_location_select" style="width:100%">
												<option value="" title="">Select...</option>
												<?php foreach ($location as $key => $value): ?>
													<option value="<?php echo $value['loca_id'] ?>" 
														<?php if ($value['loca_id'] == $user->loca_id): ?>
															selected = ""
														<?php endif ?>
													><?php echo $value['loca_province']." - ".$value['loca_district'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Job Title</label>
										<div class="col-sm-6">
											<input type="text" name="txt_purpose" id="txt_purpose" class="form-control" value="<?php echo $user->purpose ?>" placeholder="Type Job Title..." />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Insert Signature</label>
										<div class="col-sm-6">
											<input type="file" name="txt_signature" id="txt_signature" class="form-control" />
											<div class="mt-sm">
												<?php if ($user->signature <> ""): ?>
													<img src="<?php echo base_url().'images/items/'.$user->signature ?>" id="preview" style="max-width:100%">
												<?php else: ?>
													<img src="<?php echo base_url().'images/items/no-image.png' ?>" id="preview" style="max-width:100%">
												<?php endif ?>
											</div>
										</div>
									</div>
									</div>

								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<button type="submit" class="btn btn-primary" id="btn_save" name="btn_save"><span class="glyphicon glyphicon-floppy-saved"></span> Update </button>
											<a href="<?php echo base_url('Users') ?>" class="btn btn-default pull-left" type="button"><span class="glyphicon glyphicon-off"></span> Back </a>
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
<script src="<?=base_url();?>assets/adporto/javascripts/forms/examples.advanced.form.js"></script>

<script src="<?=base_url();?>assets/adporto/javascripts/tables/examples.datatables.tabletools.js"></script>


<script>
(function($) {
	'use strict';
	var link_del="";
	var datatableInit = function() {

		// LoadDatatable();

		$('#addnew-form').submit(function(e) {
			e.preventDefault();
			$("#alert-failure").slideUp();
			$("#btn_save").html('<span class="glyphicon glyphicon-transfer"></span> Sending...');
			var data = $("#addnew-form").serialize();
			$.ajax({
				type : "POST",
				url  : '<?=base_url();?>Users/do_add',
				data : data,
				success: function(response){
					//alert(response);
				    var patt = new RegExp("[::ok]");
					if(patt.test(response)){
						$('input[type="text"]').val('');
						$("#edit-form").html("");
						$("#btn_save").html('<span class="glyphicon glyphicon-floppy-saved"></span> Save');
						$("#alert-success").alert();
						$("#alert-success").fadeTo(2000, 1000).slideUp(1500, function(){
							$("#alert-success").slideUp(1500);
						});
						// LoadDatatable();

						if ($('#txt_signature').get(0).files.length > 0) {
							var imgValue = $("#txt_signature").val();
							setTimeout( function () {
								var file_data = $('#txt_signature').prop('files')[0];
								var form_data = new FormData();
								form_data.append('txt_signature', file_data);
								form_data.append('id', response.split("::")[0]);
								// console.log(file_data);
								$.ajax({
									type 	: 'POST',
									url 	:'<?php echo base_url();?>Users/do_upload',
									data 	: form_data,
									cache 		: false,
									contentType : false,
									processData : false,
									dataType	: 'json',
									success: function (response){
										if (response.msg=='success') {
										// 	$('#loader').hide();
										// 	//alert(response.filename);
										// 	$('#no-image').attr("src", urlAbsolute+response.filename)
										}else{
										// 	$('#loader').hide();
										// 	//alert(response.msg);
										// 	$(".modal-body #data-alert").html(response.msg);
										// 	$("#modal-alert").modal('show');
										// 	$('#no-image').attr("src", urlAbsolute+response.filename)
										}
										console.log(response);
									}
								});
							}, 100);
						}
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

		// $('#txt_name').change(function() {
		// 	if($("#txt_code").val()==''){
		// 		$('#txt_code').val(get_init_code);
		// 	}
		// });


		// $("#datatable-ajax").on('click', '.link-edit', function(e) {
		// 	e.preventDefault();
		// 	var data_href = $(this).attr('link-href');
		// 	$.ajax({
		// 		type: 'GET',
		// 		url: data_href,
		// 		success: function(response){
		// 			var json_obj = JSON.parse(response);
		// 			// $("#edit-form").html("<input type='hidden' name='txt_id' id='txt_id' value='"+json_obj.project_id+"'/>");
		// 			$("#txt_name").val(json_obj.project_name);
		// 			$("#txt_code").val(json_obj.project_code);
		// 			$("#txt_gfas").val(json_obj.gfas);
		// 		}
		// 	});
		// });

		// $(document).on('click', '.modal-dismiss-form', function (e) {
		// 	e.preventDefault();
		// 	$.magnificPopup.close();
		// 	$('input[type="text"]').val('');
		// });


		// $("#datatable-ajax").on('click', '.link-del', function(e) {
		// 	e.preventDefault();
		// 	var data_del = $(this).attr('data-del');
		// 	link_del = $(this).attr('link-href');
		// 	$("#del-form").html("Are you sure that you want to delete '"+data_del+"' ? ");
		// 	$('.modal-with-zoom-anim').magnificPopup({
		// 		type: 'inline', fixedContentPos: false, fixedBgPos: true, overflowY: 'auto', loseBtnInside: true,
		// 		preloader: false, midClick: true, removalDelay: 500, mainClass: 'my-mfp-zoom-in', modal: true
		// 	});
		// });

		// $(document).on('click', '#btn_del', function (e) {
		// 	e.preventDefault();
		// 	$.ajax({
		// 		type: 'GET',
		// 		url: link_del,
		// 		success: function(response){
		// 			if(response=="ok"){
		// 				LoadDatatable();
						
		// 				$("#del-success").fadeTo(2000, 1000).slideUp(1500, function(){
		// 					$("#del-success").slideUp(1500);
		// 				});
						

		// 			}
		// 			else
		// 			{
		// 				$("#del-failure").slideDown('slow');
		// 				$("#span-del-failure").html(response)
		// 			}
		// 		}

		// 	});
		// });


	};

	// function LoadDatatable(){
	// 	var $table = $('#datatable-ajax');
	// 	var datatable = $table.dataTable({
	// 		bProcessing: true,
	// 		sAjaxSource: '<?=base_url();?>users/data_json_all',
	// 		bDestroy: true,
	// 		aoColumnDefs:[
	// 		{
	// 			bSortable: false,
	// 			aTargets: [ 0 ]
	// 		},
	// 		{
	// 			className: "center",
	// 			targets: [0]
	// 		}
	// 		],

	// 		"fnDrawCallback": function () {
	// 			$('.modal-with-zoom-anim').magnificPopup({
	// 				type: 'inline',

	// 				fixedContentPos: false,
	// 				fixedBgPos: true,

	// 				overflowY: 'auto',

	// 				closeBtnInside: true,
	// 				preloader: false,

	// 				midClick: true,
	// 				removalDelay: 500,
	// 				mainClass: 'my-mfp-zoom-in',
	// 				modal: true
	// 			});
	// 		}
	// 	});
	// }

	// function get_init_code(){
	// 	var strName =$('#txt_name').val();
	// 	var str4char = strName.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '').toUpperCase().substring(0,3);
	// 	var fName = str4char;
	// 	if(fName.length==2){
	// 		fName+="0";
	// 	}
	// 	if(fName.length==1){
	// 		fName+="00";
	// 	}

	// 	var newId = $('table#datatable-ajax tr:last').index();
	// 	if (newId==0) {
	// 		newId = newId + 1;
	// 	}else{
	// 		newId = newId + 2;
	// 	}
	// 	newId = newId.toString();
	// 	if(newId.length==2){
	// 		newId="0"+newId;
	// 	}
	// 	if(newId.length==1){
	// 		newId="00"+newId;
	// 	}
	// 	return fName+newId;
	// }


	$(function() {
		datatableInit();
	});

    $("#txt_signature").change(function () {
        readURL(this);
    });
	
}).apply(this, [jQuery]);


   	function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
