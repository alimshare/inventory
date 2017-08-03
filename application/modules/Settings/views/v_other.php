<section role="main" class="content-body">
	<header class="page-header">
		<h2>Other</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><a href="<?php echo base_url('Dashboard/Settings') ?>"><span>Settings</span></a></li>
				<li><span>Other</span></li>
            </ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<form action="<?php echo base_url('Settings/Other/Do_save') ?>" method="post" class="form-horizontal col-md-8">
		<section class="panel">
			<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
				<h2 class="panel-title" style="font-size: medium; color: white;"><i class="fa fa-chevron-right"> </i> Other Settings</h2>
			</header>
			<div class="panel-body">
				<input type="hidden" name="paramKey" value="<?php echo implode("|", array_keys($param)); ?>">
				<div class="form-group">
					<label class="col-sm-3 control-label">Default Email</label>
					<div class="col-sm-9">
						<input type="email" name="parameter[]" class="form-control" value="<?php echo $param['defaultEmail'] ?>" placeholder="Default Email Target" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">PIC Request Document</label>
					<div class="col-sm-9">
						<input type="text" name="parameter[]" class="form-control" value="<?php echo $param['requestReceivedFrom'] ?>" placeholder="PIC Request Document" required />
					</div>
				</div>		
			</div>

			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="btn_save" name="btn_save"><span class="glyphicon glyphicon-floppy-saved"></span> Save </button>
						<!-- <button class="btn btn-default modal-dismiss-form"><span class="glyphicon glyphicon-off"></span> Close </button> -->
					</div>
				</div>
				<br>
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
				url  : '<?=base_url();?>Settings/Durations/do_add',
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
				$('#txt_code').val(get_init_code);
			}
		});


		$("#datatable-ajax").on('click', '.link-edit', function(e) {
			e.preventDefault();
			var data_href = $(this).attr('link-href');
			$.ajax({
				type: 'GET',
				url: data_href,
				success: function(response){
					var json_obj = JSON.parse(response);
					$("#edit-form").html("<input type='hidden' name='txt_id' id='txt_id' value='"+json_obj.item_id+"'/>");
					$("#txt_name").val(json_obj.item_name);
					$("#txt_code").val(json_obj.item_code);
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
			sAjaxSource: '<?=base_url();?>Settings/Durations/data_json_all',
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


	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);
</script>
