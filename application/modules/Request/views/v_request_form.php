<section role="main" class="content-body">
	<header class="page-header">
		<h2>Request</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Request</span></li>
            </ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

		<section class="row">
			<div class="panel col-md-8">
				<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
					<h2 class="panel-title" style="font-size: medium; color: white;">
						<i class="fa fa-chevron-right"> </i> Request Form
					</h2>
				</header>			
				<div class="panel-body">

					 <form class="form-horizontal" method="post" action="<?php echo base_url('Request/do_save') ?>" id="frmRequest">
				        <div class="box-body">
				        <input type="hidden" name="list_id" value="<?php echo $list_id; ?>">
				          <div class="form-group">
				            <label class="col-sm-2 control-label">Name</label>
				            <div class="col-sm-10">
				            	<input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo $_SESSION['us_user'] ?>" disabled />
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-sm-2 control-label">Project</label>
				            <div class="col-sm-10">
				            	<input type="text" class="form-control" value="<?php echo $project_name ?>" disabled />
				            	<input type="hidden" name="txt_project" id="txt_project" value="<?php echo $_SESSION['project_id'] ?>" />
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-sm-2 control-label">Unit</label>
				            <div class="col-sm-10">
				            	<input type="text" class="form-control" value="<?php echo $unit_name ?>" disabled />
				            	<input type="hidden" name="txt_unit" id="txt_unit" value="<?php echo $_SESSION['unit_id'] ?>" />
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-sm-2 control-label">Location</label>
				            <div class="col-sm-10">
				            	<input type="text" class="form-control" value="<?php echo $loca_province.', '.$loca_district ?>" disabled />
				            	<input type="hidden" name="txt_location" id="txt_location" value="<?php echo $_SESSION['loca_id'] ?>" />
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-sm-2 control-label">Purpose</label>
				            <div class="col-sm-10">
				              <textarea type="text" class="form-control" name="purpose" rows="5"></textarea>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-sm-2 control-label">Duration</label>
				            <div class="col-sm-10">
				              <select class="form-control" id="duration" name="duration">
				                <?php foreach ($duration as $key => $value): ?>
				                  <option value="<?php echo $value['item_name']; ?>"><?php echo $value['item_name'] ?></option>
				                <?php endforeach ?>
				              </select>  
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-sm-2 control-label">Submit to</label>
				            <div class="col-sm-10">
				              <select class="form-control select2" name="submitto" id="">
				                <?php foreach ($user as $key => $value): ?>
				                  <option value="<?php echo $value['email']; ?>"><?php echo $value['username']." - ".$value['email'] ?></option>
				                <?php endforeach ?>
				              </select>  
				            </div>
				          </div>

				        </div>

				        <div class="box-footer mt-lg">
				          <button type="button" class="btn btn-default" onclick="document.location='<?php echo base_url('Request/lists'); ?>'">Back</button>
				          <a href='#modalConfirm' class='modal-with-zoom-anim on-default btn btn-primary pull-right'>Request</a>
				        </div><!-- /.box-footer -->


						<div id="modalConfirm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title" id="title-modal">Are you sure?</h2>
								</header>
								<div class="panel-body">
									<div class="modal-wrapper">
										<div class="modal-icon">
											<i class="fa fa-question-circle"></i>
										</div>
										<div class="modal-text">
											<p id="del-form">Are you sure that you want to request this data ?</p>
										</div>
									</div>
								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<button type="button" id="btn_del" name="btn_del" class="btn btn-primary modal-confirm" onclick="submitRequest()">Request</button>
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

						<div id="modalSuccess" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title" id="title-modal">Message</h2>
								</header>
								<div class="panel-body">
									<div class="modal-wrapper">
										<div class="modal-icon">
											<i class="fa fa-check"></i>
										</div>
										<div class="modal-text">
											<p id="del-form">well done, your request has been sucesfully</p>
										</div>
									</div>
								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<button type="button" id="btn_del" name="btn_del" class="btn btn-primary modal-confirm" 
											onclick="document.location='<?php echo base_url('dashboard') ?>'">OK</button>
										</div>
									</div>
								</footer>
							</section>
						</div>


				      </form>


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
		$("#frmRequest").submit();
	}

</script>

<?php if (isset($message)): ?>
	<?php if ($message == "success"): ?>
		<script type="text/javascript">
			$.magnificPopup.open({
			    items: {
			        src: '#modalSuccess' 
			    },
			    type: 'inline'
		    });
		</script>		
	<?php endif ?>
<?php endif ?>