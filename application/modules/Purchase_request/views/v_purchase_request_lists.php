		<link rel="stylesheet" href="<?=base_url();?>assets/additional/jquery.ui.css" />
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>PURCHASE REQUEST LISTS</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo base_url('Dashboard') ?>">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Purchase Request</span></li>
								<li><span>List</span></li>
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


									<table class="table table-bordered table-striped">
										<thead>
											<th>
												<td>Item/Brand</td>
												<td>PIC</td>
												<td>Location/Department</td>
												<td></td>
											</th>
										</thead>
									</table>

									<table class="table table-bordered table-striped mb-none" id="datatable-ajax">
										<thead>
											<tr>
												<th><input type="checkbox" id="txt_check_all"  name="txt_check_all"></th>
												<th></th>
												<th>Purchase Date</th>
												<th>PO No.</th>
												<th>Unit Cost (IDR)</th>
												<th>Item & Brand</th>
												<th>Vendor</th>
												<th>User/PiC</th>
												<th>Location/ Department</th>
												<th>Inven. No.</th>
												<th style=" max-width: 50px;"></th>
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
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
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
					var uri = item+brand;
					var $table = $('#datatable-ajax');
					var datatable = $table.dataTable({
						ordering: false,
						processing: true,
						serverSide: true,
						scrollY:        300,
						deferRender:    true,
						scroller:       true,
						ajax: {
							url: "<?=base_url();?>Inventories/data_json/"+uri,
							type:'POST'
						},
						bDestroy: true,

						aoColumnDefs:[
							{bSortable: false, aTargets: [ 0 ]},
							{className: "center", aTargets: [0,1,2,3,4,9]}
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

				$('#btn_excel').click(function(e) {
					e.preventDefault();
					var item = $('#txt_item').val()=='' ? '' : "item="+$('#txt_item').val()+"&";
					var brand = $('#txt_brand').val()=='' ? '' : "brand="+$('#txt_brand').val()+"&";
					var uri = item+brand;
					window.location.href="<?=base_url();?>Inventories/data_excel/"+uri;
				});















				$('#addnew-form').submit(function(e) {
					e.preventDefault();
					$("#alert-failure").slideUp();
					$("#btn_save").html('<span class="glyphicon glyphicon-transfer"></span> Sending...');
					var data = $("#addnew-form").serialize();
					$.ajax({
						type : "POST",
						url  : '<?=base_url();?>Settings/Items/do_add',
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
