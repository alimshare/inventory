<!-- <link rel="stylesheet" href="<?=base_url();?>assets/additional/jquery.ui.css" /> -->
<section role="main" class="content-body">
	<header class="page-header">
		<h2>REQUEST LISTS</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Request</span></li>
				<li><span>Request Lists</span></li>
			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<div class="row">
		<div class="">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group" style="margin-left: -15px;">
                                <div class="col-sm-6">
                                	<input type="hidden" name="txt_search" value="<?php echo (isset($search))?$search:''; ?>" id="txt_search">
									<select  required data-plugin-selectTwo class="form-control populate" id="txt_item" name="txt_item">
										<option value="" title="">Filter by item...</option>
											<?php if(isset($list_items) && count($list_items)>0){ ?>
											<?php foreach($list_items as $list){ ?>
												<option value="<?=$list->op_kode;?>" title="<?=$list->op_kode;?> - <?=$list->op_titel;?>" <?php if(isset($edit_item)){ if($edit_item==$list->op_kode) { echo "selected";}}else{ if(set_value('txt_item')==$list->op_kode){ echo "selected";}}?>><?=$list->op_kode;?> - <?=$list->op_titel;?></option>
											<?php }}  ?>
									</select>
								</div>
								
								<div class="col-sm-5">
									<select required class="form-control populate" id="txt_brand" name="txt_brand">
											<option value="">Filter by mark/brand...</option>
											<?php if(isset($list_brands) && count($list_brands)>0){ ?>
											<?php foreach($list_brands as $list){ ?>
												<option value="<?=$list->op_kode;?>" <?php if(isset($edit_brand)){ if($edit_brand==$list->op_kode) { echo "selected";}}else{ if(set_value('txt_brand')==$list->op_kode){ echo "selected";}}?>><?=$list->op_kode;?> - <?=$list->op_titel;?></option>
											<?php }}  ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
						</div>
					</div>
					
					<hr style="margin: 10px;"/>

					<div class="row">
						<div class="col-md-12">
							<div id="alert-success" class="alert alert-success" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
								<strong>Well done!</strong> The record has been saved successfully.<br><span id="span-success"></span>
							</div>

							<div id="alert-failure" class="alert alert-danger" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
								<strong>Oh snap!</strong> <span id="span-failure">the record failed save</span>
							</div>
						</div>
					</div>

					<table class="table table-bordered table-striped mb-none" id="datatable-ajax">
						<thead>
							<tr>
								<!-- <th><input type="checkbox" id="txt_check_all"  name="txt_check_all"></th>
								<th></th>
								<th>Purchase Date</th>
								<th>PO No.</th>
								<th>Unit Cost (IDR)</th> -->
								<th>Item & Brand</th>
								<th>User/PiC</th>
								<th>Location/ Department</th>
								<th style="">Action</th>
							</tr>
						</thead>

						<tbody>
						</tbody>
					</table>

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
<!-- Examples -->
<script src="<?=base_url();?>assets/adporto/javascripts/forms/examples.advanced.form.js"></script>

<script src="<?=base_url();?>assets/adporto/javascripts/tables/examples.datatables.tabletools.js"></script>


<script>
	(function($) {
		'use strict';
		var link_del="";
		var datatableInit = function() {

		LoadDatatable();


		$('#txt_item').change(function() {
			var paren = $(this).val();
			LoadOption("Brands", paren);
			LoadDatatable();
		});

		$('#txt_brand').change(function() {
			LoadDatatable();
		});

		$('#btn_barcode').click(function(e) {
			e.preventDefault();
			var item = $('#txt_item').val()=='' ? '' : "item="+$('#txt_item').val()+"&";
			var brand = $('#txt_brand').val()=='' ? '' : "brand="+$('#txt_brand').val()+"&";
			var uri = item+brand;
			
			if (uri=='') {
				window.open ("<?=base_url();?>Inventories/data_barcode");
			}else{
				window.open ("<?=base_url();?>Inventories/data_barcode/"+uri);
			}

		});

		function LoadDatatable(){
			var item = $('#txt_item').val()=='' ? '' : "item="+$('#txt_item').val()+"&";
			var brand = $('#txt_brand').val()=='' ? '' : "brand="+$('#txt_brand').val()+"&";
			var search = $('#txt_search').val();
			console.log(search);
			var uri = item+brand;
			var urlTarget = '<?php echo base_url("Purchase_request") ?>';
			var $table = $('#datatable-ajax');
			var datatable = $table.dataTable({
				"language": {
					"zeroRecords": "If there is no stock in storage, please request New <br><br><a href='"+urlTarget+"' class='btn btn-primary btn-lg'>Request New</a>"
				},
				ordering: false,
				processing: true,
				serverSide: true,
				scrollY:        300,
				deferRender:    true,
				scroller:       true,
				// oSearch: {"sSearch": ""},
				ajax: {
					url: "<?=base_url();?>Request/data_json/"+uri,
					type:'POST',
					data : {
						"txt_search" : search
					}
				},
				bDestroy: true,

				aoColumnDefs:[
					{bSortable: false, aTargets: [ 0 ]},
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

		function LoadOption(str, paren=''){
			$.ajax({
				type: 'GET',
				url: '<?php echo base_url();?>Inventories/get_option_forlists/'+str+'/'+paren,
				success: function(response) {
					if (str=='Items') {
						$('#txt_item').html(response);
					}else if (str=='Brands') {
						$('#txt_brand').html(response);
					}

				}
			});
		}

		};

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