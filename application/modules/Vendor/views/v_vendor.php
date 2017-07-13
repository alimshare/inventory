<section role="main" class="content-body">
	<header class="page-header">
		<h2>VENDOR/SUPPLIER</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?=base_url('Dashboard');?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Vendor & Supplier</span></li>
			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<div class="row">
		<div class="tabs">
				<ul class="nav nav-tabs" id="tabUL">
					<li class="active" id="litab1">
						<a href="#tabVendor" data-toggle="tab"><b>Vendor</b></a>
					</li>
					<li id="litab2">
						<a href="#tabSubcontractor" data-toggle="tab"><b>Sub-contractor</b></a>
					</li>
					<li id="litab2">
						<a href="#tabConsultant" data-toggle="tab"><b>Consultant</b></a>
					</li>
				</ul>

				<div class="tab-content">
					<div id="tabVendor" class="tab-pane active">
						<div class="row">
							<div class="col-sm-6">
								<div class="mb-md">
									<a class="btn btn-primary" href="<?php echo base_url('Settings/Preferred_vendor') ?>"><i class="fa fa-plus"></i> Add new</a>
									<hr>
								</div>
							</div>
						</div>
						<table class="table table-bordered table-striped mb-none" id="datatable-ajax-vendor">
							<thead>
								<tr>
									<th>NO.</th>
									<th>CODE</th>
									<th>NAME</th>
									<th>EMAIL</th>
									<th>MODIFY</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>							
						</div>
					<div id="tabSubcontractor" class="tab-pane">
						<div class="row">
							<div class="col-sm-6">
								<div class="mb-md">
									<a class="btn btn-primary" href="<?php echo base_url('Settings/Subcontractor') ?>"><i class="fa fa-plus"></i> Add new</a>
									<hr>
								</div>
							</div>
						</div>
						<table width="100%" class="table table-bordered table-striped mb-none" id="datatable-ajax-subcontractor">
							<thead>
								<tr>
									<th>NO.</th>
									<th>CODE</th>
									<th>NAME</th>
									<th>CONTRACT</th>
									<th>MODIFY</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>																		
					</div>	
					<div id="tabConsultant" class="tab-pane">
						<div class="row">
							<div class="col-sm-6">
								<div class="mb-md">
									<a class="btn btn-primary" href="<?php echo base_url('Settings/Consultant') ?>"><i class="fa fa-plus"></i> Add new</a>
									<hr>
								</div>
							</div>
						</div>
						<table width="100%" class="table table-bordered table-striped mb-none" id="datatable-ajax-consultant">
							<thead>
								<tr>
									<th>NO.</th>
									<th>CODE</th>
									<th>NAME</th>
									<th>CONTRACT</th>
									<th>MODIFY</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>							
					</div>								
				</div>

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


<script>
(function($) {
	'use strict';
	var link_del="";
	var datatableInit = function() {

	LoadDatatableVendor();
	LoadDatatableSubcontractor();
	LoadDatatableConsultant();

	function LoadDatatableVendor(){
		var $table = $('#datatable-ajax-vendor');
		var datatable = $table.dataTable({
			bProcessing: true,
			sAjaxSource: '<?=base_url();?>Settings/Preferred_vendor/data_json_all',
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

	function LoadDatatableSubcontractor(){
		var $table = $('#datatable-ajax-subcontractor');
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

	function LoadDatatableConsultant(){
		var $table = $('#datatable-ajax-consultant');
		var datatable = $table.dataTable({
			bProcessing: true,
			sAjaxSource: '<?=base_url();?>Settings/Consultant/data_json_all',
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
