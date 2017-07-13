<section role="main" class="content-body">
	<header class="page-header">
		<h2>Purchase Request</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url('Dashboard') ?>">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Purchase Request</span></li>
            </ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

		<section class="row">
			<div class="panel col-md-12">
				<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
					<h2 class="panel-title" style="font-size: medium; color: white;">
					<i class="fa fa-chevron-right"> </i> Purchase Request Form</h2>
				</header>			
				<div class="panel-body">

					<div class="row">
						<div class="col-md-12">
							<div id="alert-success" class="alert alert-success" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
								<strong>Well done!</strong> The record has been saved successfully.
								<br>
								<!-- <span id="span-success" style="display: none">  -->
								<!-- <a href="#" target="_blank" id="linkDownload">Download Purchase Request Document</a> </span> -->
							</div>

							<div id="alert-failure" class="alert alert-danger" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
								<strong>Oh snap!</strong> <span id="span-failure">the record failed save</span>
							</div>
						</div>
					</div>


				<div class="row"> 

					<div id="modalForm" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
						<form action="" id="addnew-form" method="post" class="form-horizontal mb-lg" >
							<section class="panel">
								<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
									<h2 class="panel-title" style="font-size: medium; color: white;">Submit Your Request</h2>
								</header>
								<div class="panel-body">
									<div class="form-group mt-lg">
										<label class="col-sm-2 control-label">Justification</label>
										<div class="col-sm-10">
											<input type="text" name="txt_justification" id="txt_justification" value="" class="form-control" placeholder="Type Justification..." > 
											<p class="help"><span id="error-justification" style="color:red"></span></p>
										</div>
									</div>
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
												<span class="glyphicon glyphicon-floppy-saved"></span> Submit 
											</button>
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

				</div>



			      <form class="form-horizontal" method="post" action="<?php echo base_url('Purchase_request/do_save') ?>" id="frmRequest">
			        <div class="box-body text-center">
					
						<input type="hidden" name="txt_mini_proposal" value="<?php echo $id_mini_proposal ?>">

			          <datalist id="dlitem">
			            <option value="1">test</option>
			          </datalist>

			          <datalist id="dlqty">
			            <option value="1">test</option>
			          </datalist>
			          
			          <div class="table-responsive">     
			            <style type="text/css">
			              table thead tr th {
			                text-align: center;
			                vertical-align: middle !important;
			              }
			            </style>   

			            <input type="hidden" name="submitto" id="txt_submitto">
			            <input type="hidden" name="txt_justification_form" id="txt_justification_form">

			            <table class="table table-bordered" id="tableRequest">
			              <thead>
			                <tr>
			                  <th>ITEM</th>
			                  <th>SPECIFICATION</th>
			                  <th>QTY</th>
			                  <th>UNIT</th>
			                  <th>UNIT PRICE</th>
			                  <th>TOTAL ESTIMATED COST</th>
			                  <th></th>
			                </tr>
			              </thead>
			              <tbody id="requestBody">
			                <tr>
			                  <td>
			                    <select name="item[]" class="form-control" onchange="checkOther(this)">
			                    	<?php echo $item; ?>
			                    	<option value="other">Other</option>
			                    </select>
			                  </td>
			                  <td>
			                    <input type="text" class="form-control" name="description[]">
			                  </td>
			                  <td>
			                    <input type="text" class="form-control" name="qty[]" value="0" onchange='updatePrice(this)'>
			                  </td>
			                  <td>
			                    <select name="unit[]" class="form-control">
			                    	<?php echo $unit_item; ?>
			                    </select>
			                  </td>
			                  <td>
			                    <input type="text" name="price[]" class="form-control" value="0" onchange='updatePrice(this)'>
			                  </td>
			                  <td>000.000</td>
			                  <td></td>
			                </tr>
			                
			              </tbody>
			            </table>
			            <button type="button" class="btn btn-success btn-sm" onclick="createRow()"><span class="glyphicon glyphicon-plus"></span> Add Row</button>

			          </div>
			        </div
			        <div class="box-footer">
			        	<hr>
			          	<button type="button" class="btn btn-default btn-flat" onclick="document.location='<?php echo base_url('dashboard'); ?>'">Back</button>
						<a class="modal-with-zoom-anim btn btn-primary pull-right" href="#modalForm"><i class="fa fa-forward"></i> Submit Your Request</a>
			          <!-- <a class="modal-with-zoom-anim btn btn-primary" href="#modalForm">Save</a> -->
			        </div>
			      </form>

				</div>	
			</div>
		</section>
</section>

<script type="text/javascript">

	function show(argument) {
		alert('show form submit to');
	}
	
	function createRow(){
	    var row = document.createElement('tr'); // create row node
	    var col1 = document.createElement('td'); // create column node
	    var col2 = document.createElement('td'); // create second column node
	    var col3 = document.createElement('td'); // create second column node
	    var col4 = document.createElement('td'); // create second column node
	    var col5 = document.createElement('td'); // create second column node
	    var col6 = document.createElement('td'); // create second column node
	    var col7 = document.createElement('td'); // create second column node

	    row.appendChild(col1); // append first column to row
	    row.appendChild(col2); // append second column to row
	    row.appendChild(col3); // append second column to row
	    row.appendChild(col4); // append second column to row
	    row.appendChild(col5); // append second column to row
	    row.appendChild(col6); // append second column to row
	    row.appendChild(col7); // append second column to row

	    // col1.innerHTML= "<input type='text' name='item[]' class='form-control'>";
	    var cmbitem = "<select name='item[]' class='form-control'><?php echo $item; ?><option value='other'>Other</option></select>";
	    col1.innerHTML= cmbitem; 
	    col2.innerHTML= "<input type='text' name='description[]' class='form-control'>";
	    col3.innerHTML= "<input type='text' name='qty[]' class='form-control' value='0' onchange='updatePrice(this)'>"; 
	    var cmbunit = "<select name='unit[]' class='form-control'><?php echo $unit_item; ?></select>";
	    col4.innerHTML= cmbunit; 
	    col5.innerHTML= "<input type='text' name='price[]' class='form-control' value='0' onchange='updatePrice(this)'>";
	    col6.innerHTML= "00.000";
	    col7.innerHTML= "<button class='btn btn-box-tool' type='button' onclick='remove(this)'><i class='fa fa-times'></i></button>"; 	
	    var table = document.getElementById("requestBody"); // find table to append to
	    table.appendChild(row); // append row to table
	}

	function remove(x){
		var rowIndex = x.parentNode.parentNode.rowIndex;
		document.getElementById("tableRequest").deleteRow(rowIndex);
	}

	function updatePrice(x){		
		var rowIndex = x.parentNode.parentNode.rowIndex;
		var tbl = document.getElementById("tableRequest");
		var row = tbl.rows[rowIndex].cells;

		var cell1 = row[2].getElementsByTagName('input')[0].value;
		var cell2 = row[4].getElementsByTagName('input')[0].value;

		var total = cell1 * cell2;
		row[5].innerHTML = Number(total.toFixed(1)).toLocaleString();


		// console.log(total);
	}

	function checkOther(x){
		if (x.value == "other"){
			document.location = '<?php echo base_url('Inventories/addnew') ?>';
		}
	}

</script>


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
<!-- <script src="<?=base_url();?>assets/adporto/vendor/bootstrap-confirmation/bootstrMaximum call stack size exceededap-confirmation.js"></script> -->
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

<script type="text/javascript">

	function submitRequest(){
		var submitto = document.getElementById("submitto").value;
		$("#txt_submitto").val(submitto);
		var Justification = $("#txt_justification").val();
		if (Justification == ""){
			$("#error-justification").html("This field is required");
			$("#txt_justification").focus();
		} else {
			$("#txt_justification_form").val(Justification);	
			$("#frmRequest").submit();		
		}
	}

</script>