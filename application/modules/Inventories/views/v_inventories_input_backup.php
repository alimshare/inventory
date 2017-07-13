		<link rel="stylesheet" href="<?=base_url();?>assets/additional/jquery.ui.css" />
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>INVENTORY INPUT FORM</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?=base_url();?>intranet/dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Inventories</span></li>
								<li><span>Inventory Input Form</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<div class="row">
						<div class="tabs">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="<?=base_url();?>inventories/addnew"><b>Inventory Input Form</b></a>
									</li>
									<li>
										<a href="<?=base_url();?>inventories/lists">Inventory Lists</a>
									</li>
								</ul>
								<div class="tab-content">
									<form id="addnew-list" class="form-horizontal form-bordered" method="post"  enctype="multipart/form-data" action="">
									<div class="row">
										<div class="col-sm-6">
											<?php if(isset($edit_id)){ ?>
											<input type="hidden" id="txt_id" name="txt_id" value="<?php echo (isset($edit_id))? $edit_id : set_value('txt_id');?>" size="3">
                                            <?php } ?>

											<div class="form-group">
                                                <label class="control-label col-sm-4">Item Classification</label>
                                                <div class="col-sm-6">
													<div class="input-group">
														<select  required data-plugin-selectTwo class="form-control populate" id="txt_item" name="txt_item">
															<option value="" title="">Select...</option>
															<?php if(isset($list_items) && count($list_items)>0){ ?>
															<?php foreach($list_items as $list){ ?>
																<option value="<?=$list->op_kode;?>" title="<?=$list->op_kode;?> - <?=$list->op_titel;?>" <?php if(isset($edit_item)){ if($edit_item==$list->op_kode) { echo "selected";}}else{ if(set_value('txt_item')==$list->op_kode){ echo "selected";}}?>><?=$list->op_kode;?> - <?=$list->op_titel;?></option>
															<?php }}  ?>
														</select>
														<a href="#modal-form-item" id="btn_item" class="modal-with-zoom-anim btn btn-default input-group-addon"><i class="fa fa-plus"></i></a>

													</div>

												</div>
                                            </div>

											<div class="form-group" style="">
                                                <label class="control-label col-sm-4">Brand/Merk</label>
                                               <div class="col-sm-6">
                                                    <div class="input-group">
														<select required class="form-control populate" id="txt_brand" name="txt_brand">
															<option value="">Select...</option>
															<?php if(isset($list_brands) && count($list_brands)>0){ ?>
															<?php foreach($list_brands as $list){ ?>
																<option value="<?=$list->op_kode;?>" <?php if(isset($edit_brand)){ if($edit_brand==$list->op_kode) { echo "selected";}}else{ if(set_value('txt_brand')==$list->op_kode){ echo "selected";}}?>><?=$list->op_kode;?> - <?=$list->op_titel;?></option>
															<?php }}  ?>
														</select>
														<a href="#modal-form-brand" id="btn_brand" class="modal-with-zoom-anim btn btn-default input-group-addon"><i class="fa fa-plus"></i></a>
													</div>
												</div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_model" class="col-sm-4 control-label input">Model/Type</label>
                                                <div class="col-sm-6">
													<input type="hidden" class="form-control input" id="txt_serial" name="txt_serial"  placeholder="Type serial..." value="<?php echo (isset($edit_serial))? $edit_serial : set_value('txt_serial');?>">
                                                    <input type="text" class="form-control input" id="txt_model" name="txt_model"  placeholder="Type model/type..." value="<?php echo (isset($edit_model))? $edit_model : set_value('txt_model');?>">
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_sn" class="col-sm-4 control-label input">Serial Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control input" id="txt_sn" name="txt_sn"  placeholder="Type serial number..." value="<?php echo (isset($edit_sn))? $edit_sn : set_value('txt_sn');?>">
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_usd" class="col-sm-4 control-label input">Cost [IDR] [USD]</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control input" id="txt_idr" name="txt_idr"  placeholder="Type IDR..." value="<?php echo (isset($edit_idr))? $edit_idr : set_value('txt_idr');?>">
                                                </div>
												<div class="col-sm-4">
                                                    <input type="text" class="form-control input" id="txt_usd" name="txt_usd"  placeholder="Type USD..." value="<?php echo (isset($edit_usd))? $edit_usd : set_value('txt_usd');?>">
                                                </div>

                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_usd" class="col-sm-4 control-label input">Exchange Rate</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control input" id="txt_rate" name="txt_rate"  placeholder="Type IDR/$1..." value="<?php echo (isset($edit_rate))? $edit_rate : set_value('txt_rate');?>">
                                                </div>
												<div class="col-sm-4">
                                                    <div class="input-group">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
														<input type="text" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}' class="form-control" name="txt_exchange_date" id="txt_exchange_date" value="<?php echo (isset($edit_exchange_date))? $edit_exchange_date : set_value('txt_exchange_date');?>">
													</div>
												</div>

                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_title" class="col-sm-4 control-label input">Name/Title</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input" id="txt_title" name="txt_title"  placeholder="Type name/title..." value="<?php echo (isset($edit_title))? $edit_title : set_value('txt_title');?>">
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_detail" class="col-sm-4 control-label input">Detail</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control input" id="txt_detail" name="txt_detail"  placeholder="Type detail, specifiction, etc..." rows="3"><?php echo (isset($edit_detail))? $edit_detail : set_value('txt_detail');?></textarea>
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_nama" class="col-sm-4 control-label input">Picture/Image</label>
                                                <div class="col-sm-8">
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file" id="txt_item_image"  name="txt_item_image"/>
															</span>
															<a href="#" id="item_image_remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a> <!-- data-dismiss="fileupload" -->
														</div>
													</div>

                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_nama" class="col-sm-4 control-label input"></label>
                                                <div class="col-sm-8">
													<div id="item_image" style="height: 120px">
														<img id="no-image" src="<?=base_url();?>images/items/no-image.png" style="border: 2px solid #DEDEDE; height: 120px"/>
														<img id="loader" src="<?=base_url();?>images/loaders/loading1.gif" style="height: 70px; display: none"/>
													</div>

												</div>
                                            </div>

										</div>
										<div class="col-sm-6">
											<div class="form-group">
                                                <label class="control-label col-sm-4">PO Number</label>
                                                <div class="col-sm-8">
													<div class="input-group">
														<select required data-plugin-selectTwo class="form-control populate" id="txt_po" name="txt_po">
															<option value="" title="">Select...</option>
															<?php if(isset($list_po) && count($list_po)>0){ ?>
															<?php foreach($list_po as $list){ ?>
																<option value="<?=$list->op_kode;?>" title="<?=$list->op_kode;?> - <?=$list->op_titel;?>" <?php if(isset($edit_item)){ if($edit_item==$list->op_kode) { echo "selected";}}else{ if(set_value('txt_po')==$list->op_kode){ echo "selected";}}?>><?=$list->op_kode;?> - <?=$list->op_titel;?></option>
															<?php }}  ?>
														</select>
														<a href="#modal-input-po" id="btn_po" class="modal-with-zoom-anim btn btn-default input-group-addon"><i class="fa fa-plus"></i></a>

													</div>

												</div>
                                            </div>

											<div class="form-group" style="">
                                                <label class="control-label col-sm-4">Project Title</label>
                                                <div class="col-sm-6">
													<div class="input-group">
														<select required data-plugin-selectTwo class="form-control populate" id="txt_project" name="txt_project">
															<option value="">Select...</option>
															<option value="01.01" <?php if(isset($edit_project)){ if($edit_project=="01.01") { echo "selected";}}else{ if(set_value('txt_project')=="01.01"){ echo "selected";}}?>>01.01 - Linkages.USAID</option>
															<option value="02.01" <?php if(isset($edit_project)){ if($edit_project=="02.01") { echo "selected";}}else{ if(set_value('txt_project')=="02.01"){ echo "selected";}}?>>02.01 - CTB.USAID</option>
														</select>
													</div>
												</div>
                                            </div>

											<div class="form-group" style="">
                                                <label class="control-label col-sm-4">Status</label>
                                                <div class="col-sm-4">
													<div class="input-group">
														<select data-plugin-selectTwo class="form-control populate" id="txt_status" name="txt_status">
															<option value="">Select...</option>
															<option value="Processed" <?php if(isset($edit_status)){ if($edit_status=="Processed") { echo "selected";}}else{ if(set_value('txt_status')=="Processed"){ echo "selected";}}?>>Processed</option>
															<option value="Delivered" <?php if(isset($edit_status)){ if($edit_status=="Delivered") { echo "selected";}}else{ if(set_value('txt_status')=="Delivered"){ echo "selected";}}?> selected>Delivered</option>
															<option value="Donated" <?php if(isset($edit_status)){ if($edit_status=="Donated") { echo "selected";}}else{ if(set_value('txt_status')=="Donated"){ echo "selected";}}?>>Donated</option>
															<option value="Expired" <?php if(isset($edit_status)){ if($edit_status=="Expired") { echo "selected";}}else{ if(set_value('txt_status')=="Expired"){ echo "selected";}}?>>Expired</option>

														</select>
													</div>
												</div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_consumable" class="col-sm-4 control-label input">Consumable life (Year)</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control input"  maxlength="4" id="txt_consumable" name="txt_consumable"  placeholder="Year" value="<?php echo (isset($edit_consumable))? $edit_consumable : set_value('txt_consumable');?>">
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_location" class="col-sm-4 control-label input">Location/Department</label>
                                                <div class="col-sm-8">
                                                    <div id="select-group-location" class="input-group">
														<select data-plugin-selectTwo class="form-control populate" id="txt_location_select" name="txt_location_select">
															<option value="" title="">Select...</option>
															<?php if(isset($list_location) && count($list_location)>0){ ?>
															<?php foreach($list_location as $list){ ?>
																<option value="<?=$list->loc_code;?>"  <?php if(isset($edit_location)){ if($edit_location==$list->loc_code) { echo "selected";}}else{ if(set_value('txt_location')==$list->loc_code){ echo "selected";}}?>><?=$list->loc_code;?> - <?=$list->loc_name;?></option>
															<?php }}  ?>
														</select>
														<a href="#" id="btn_location_plus" class="btn btn-default input-group-addon"><i class="fa fa-plus"></i></a>
													</div>

													<div id="input-group-location" class="input-group" style="display: none;">
														<input type="text" class="form-control input" id="txt_location" name="txt_location"  placeholder="Type location/department..." value="<?php echo (isset($edit_location))? $edit_location : set_value('txt_location');?>">
														<span class="input-group-btn">
															<a href="#" id="btn_location_undo" class="btn btn-default" ><i class="fa fa-undo"></i></a>
														</span>
													</div>
													<div id='location-id'></div>
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_district" class="col-sm-4 control-label input">District</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input" id="txt_district" name="txt_district"  placeholder="Type district..." value="<?php echo (isset($edit_district))? $edit_district : set_value('txt_district');?>">
                                                </div>
                                            </div>
											<div class="form-group" style="">
                                                <label for="txt_province" class="col-sm-4 control-label input">Province</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input" id="txt_province" name="txt_province"  placeholder="Type province..." value="<?php echo (isset($edit_province))? $edit_province : set_value('txt_province');?>">
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_country" class="col-sm-4 control-label input">Country</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input" id="txt_country" name="txt_country"  placeholder="Type country..." value="<?php echo (isset($edit_country))? $edit_country : set_value('txt_country');?>">
                                                </div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_user" class="col-sm-4 control-label input">User/PiC</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control input" id="txt_user" name="txt_user"  placeholder="Type person using..." value="<?php echo (isset($edit_user))? $edit_user : set_value('txt_user');?>">
                                                </div>
                                            </div>

											<div class="form-group">
												<label for="txt_hand_date" class="col-sm-4 control-label input">Handover Date</label>
												<div class="col-sm-4">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
														<input type="text" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}' class="form-control" name="txt_hand_date" id="txt_hand_date" value="<?php echo (isset($edit_hand_date))? $edit_hand_date : set_value('txt_hand_date');?>">
													</div>
												</div>
											</div>

											<div class="form-group" style="">
                                                <label for="txt_condition" class="col-sm-4 control-label input">Condition</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input" id="txt_condition" name="txt_condition"  placeholder="Type condition when distributed/handover..." value="<?php echo (isset($edit_condition))? $edit_condition : set_value('txt_condition');?>">
                                                </div>
                                            </div>

											<br/>
											<div class="form-group" style="">
                                                <label for="txt_inventory_number" class="col-sm-4 control-label input">INVENTORY NO.</label>
                                                <div class="col-sm-8">
													<div class="input-group mb-md">
														<span class="input-group-btn">
															<a href="#" title="Click here to generate Inven. Number" id="btn_inventory_generate" class="btn btn-default" ><i class="fa fa-refresh"></i></a>
														</span>
														<input required type="text" class="form-control input center" style="text-transform:uppercase" id="txt_inventory_number" name="txt_inventory_number"  placeholder="" value="<?php echo (isset($edit_inventory_number))? $edit_inventory_number : set_value('txt_inventory_number');?>">
														<span class="input-group-btn">
															<a href="#" title="Click here to generate barcode" id="btn_barcode_generate" class="btn btn-default" ><i class="fa fa-barcode"></i></a>
														</span>
													</div>

												</div>
                                            </div>

											<div class="form-group" style="">
                                                <label for="txt_inventory_number" class="col-sm-2 control-label input"></label>
                                                <div class="col-sm-10" style="text-align: center">
													<div id="barcode"></div>

                                                </div>
                                            </div>


										</div>
									</div>
									<br/>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-12">
													<textarea class="form-control input" id="txt_quotes" name="txt_quotes"  placeholder="Type pecial comments, quotes, etc..." rows="2"><?php echo (isset($edit_quotes))? $edit_quotes : set_value('txt_quotes');?></textarea>
												</div>
											</div>
										</div>
									</div>
									<br/>
									<br/>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-12">
													<button type="submit" class="btn  btn-primary" name="btn_save" id="btn_save" style="background: #5B707B; border: 1px solid #5B707B;"> <i class="fa fa-save"></i> Save </button>
													<button type="submit" class="btn  btn-primary" name="btn_print" id="btn_print" style="background: #5B707B; border: 1px solid #5B707B;"> <i class="fa fa-print"></i> Print </button>
													<button type="submit" class="btn  btn-primary" name="btn_barcode" id="btn_barcode" style="background: #5B707B; border: 1px solid #5B707B;"> <i class="fa fa-barcode"></i> Barcode </button>
													<a href="<?=base_url();?>inventories/addnew" class="btn btn-default"> <i class="fa fa-refresh"></i> Reset </a>
												</div>
											</div>
										</div>
									</div>

									<br/>
										<div class="row">
											<div class="col-md-12">
												<div id="list-success" class="alert alert-success" style="display:none;">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
													<strong>Well done!</strong> The record has been saved successfully.
												</div>
												<div id="list-failure" class="alert alert-danger" style="display:none;">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
													<strong>Oh snap!</strong> <span id="span-list-failure"></span>
												</div>
											</div>
										</div>
									</form>
								</div>




									<div id="modal-input-po" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide" >

										<form action="" id="addnew-po" method="post" class="form-horizontal mb-lg" >
											<section class="panel">
												<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
													<h2 class="panel-title" style="font-size: medium; color: white;">Add New Purchase Order</h2>
												</header>
												<div class="panel-body">
													<div>
														<table class="table table-bordered mb-none">
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
																				<input type="text" required class="form-control input" id="txt_po_number" name="txt_po_number"  placeholder="Type PO number..." value="<?php echo (isset($edit_po_number))? $edit_po_number : set_value('txt_po_number');?>">
																			</div>
																		</div>
																	</td>
																	<td colspan="2">
																		<div class="form-group">
																			<label for="txt_price" class="col-sm-12 control-label input" style="text-align: center;">2.PRICE TOTAL</label>
																			<div class="col-sm-7">
																				<input type="text" class="form-control input" id="txt_po_idr" name="txt_po_idr"  placeholder="Type IDR..." value="<?php echo (isset($edit_po_idr))? $edit_po_idr : set_value('txt_po_idr');?>">
																			</div>
																			<div class="col-sm-5">
																				<input type="text" class="form-control input" id="txt_po_usd" name="txt_po_usd"  placeholder="Type USD..." value="<?php echo (isset($edit_po_usd))? $edit_po_usd : set_value('txt_po_usd');?>">
																			</div>
																		</div>
																	</td>
																	<td width="30%">
																		<div class="form-group">
																			<label for="txt_po_date" class="col-sm-12 control-label input">3.EFFECTIVE DATE</label>
																			<div class="col-sm-12">
																				<div class="input-group">
																					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																					<input type="text" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}' class="form-control" name="txt_po_date" id="txt_po_date" value="<?php echo (isset($edit_po_date))? $edit_po_date : set_value('txt_po_date');?>">
																				</div>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td colspan="4">
																		<div class="form-group" style="">
																			<label for="txt_po_delivery" class="col-sm-5 control-label input">4.DELIVERY DATE/PERIOD OF PERFORMANCE</label>
																			<div class="col-sm-5">
																				<div class="input-daterange input-group" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}'>
																					<span class="input-group-addon">
																						<i class="fa fa-calendar"></i>
																					</span>
																					<input type="text" class="form-control" name="txt_po_delivery1" id="txt_po_delivery1"  value="<?php echo (isset($edit_po_delivery1))? date_format_id($edit_po_delivery1,7) : set_value('txt_po_delivery1');?>">
																					<span class="input-group-addon">to</span>
																					<input type="text" class="form-control" name="txt_po_delivery2" id="txt_po_delivery2"  value="<?php echo (isset($edit_po_delivery2))? date_format_id($edit_po_delivery2,7) : set_value('txt_po_delivery2');?>">
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
																				<div id="select-group-vendor" class="input-group">
																					<select data-plugin-selectTwo class="form-control populate" style="width: 100%;" id="txt_po_vendor_select" name="txt_po_vendor_select">
																						<option value="">Select...</option>
																						<?php if(isset($list_vendors) && count($list_vendors)>0){ ?>
																						<?php foreach($list_vendors as $list){ ?>
																							<option value="<?=$list->vendor_code;?>" <?php if(isset($edit_po_vendor_select)){ if($edit_po_vendor_select==$list->vendor_code) { echo "selected";}}else{ if(set_value('txt_po_vendor_select')==$list->vendor_code){ echo "selected";}}?>><?=$list->vendor_code;?> - <?=$list->vendor_name;?></option>
																						<?php }}  ?>
																					</select>
																					<a href="#" id="btn_po_vendor_select" class="btn btn-default input-group-addon"><i class="fa fa-plus"></i></a>
																				</div>

																				<div id="input-group-vendor" class="input-group" style="display: none;">
																					<input type="text" class="form-control input" id="txt_po_vendor" name="txt_po_vendor"  placeholder="Type vendor name..." value="<?php echo (isset($edit_po_vendor))? $edit_po_vendor : set_value('txt_po_vendor');?>">
																					<span class="input-group-btn">
																						<a href="#" id="btn_po_vendor_new" class="btn btn-default" ><i class="fa fa-undo"></i></a>
																					</span>
																				</div>
																				<div id='vendor-id'></div>


																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">ADDRESS</label>
																			<div class="col-sm-8">
																				<input type="text" class="form-control input" id="txt_po_vendor_address" name="txt_po_vendor_address"  placeholder="Type vendor address..." value="<?php echo (isset($edit_po_vendor_address))? $edit_po_vendor_address : set_value('txt_po_vendor_address');?>">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">FAX NO.</label>
																			<div class="col-sm-8">
																				<input type="text" class="form-control input" id="txt_po_vendor_fax" name="txt_po_vendor_fax"  placeholder="Type vendor fax..." value="<?php echo (isset($edit_po_vendor_fax))? $edit_po_vendor_fax : set_value('txt_po_vendor_fax');?>">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">PHONE NO.</label>
																			<div class="col-sm-8">
																				<input type="text" class="form-control input" id="txt_po_vendor_phone" name="txt_po_vendor_phone"  placeholder="Type vendor phone..." value="<?php echo (isset($edit_po_vendor_phone))? $edit_po_vendor_phone : set_value('txt_po_vendor_phone');?>">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">IDENT. NO.</label>
																			<div class="col-sm-8">
																				<input type="text" class="form-control input" id="txt_po_vendor_ident" name="txt_po_vendor_ident"  placeholder="Type vendor ident..." value="<?php echo (isset($edit_po_vendor_ident))? $edit_po_vendor_ident : set_value('txt_po_vendor_ident');?>">
																			</div>
																		</div>


																	</td>
																	<td width="50%" colspan="2">
																		<div class="form-group" style="">
																			<label for="txt_sn" class="col-sm-4 control-label input">6.PLACE OF DELIVERY/ ACCEPTANCE</label>
																			<div class="col-sm-8">
																				<textarea class="form-control input" id="txt_place" name="txt_place"  placeholder="Type place of delivery..." rows="4"><?php echo (isset($edit_place))? $edit_place : set_value('txt_place');?></textarea>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">MARK ATTN.</label>
																			<div class="col-sm-8">
																				<textarea class="form-control input" id="txt_place_mark" name="txt_place_mark"  placeholder="Type mark attn..." rows="2"><?php echo (isset($edit_place_mark))? $edit_place_mark : set_value('txt_place_mark');?></textarea>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">PHONE NO.</label>
																			<div class="col-sm-8">
																				<input type="text" class="form-control input" id="txt_po_place_phone" name="txt_po_place_phone"  placeholder="Type place phone..." value="<?php echo (isset($edit_po_place_phone))? $edit_po_place_phone : set_value('txt_po_place_phone');?>">
																			</div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td colspan="2">
																		<div class="form-group">
																			<label for="txt_po_charge" class="col-sm-6 control-label input">7.FHI 360 CHARGE CODE</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control input" id="txt_po_charge" name="txt_po_charge"  placeholder="Type charge code..." value="<?php echo (isset($edit_po_charge))? $edit_po_charge : set_value('txt_po_charge');?>">
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="txt_model" class="col-sm-6 control-label input">8.FHI 360 VAT EXEMPTION</label>
																			<div class="col-md-2">
																				<div class="radio-custom">
																					<input type="radio" id="txt_po_vatyes" name="txt_po_vat" value="Yes">
																					<label for="txt_po_vatyes">Yes</label>
																				</div>

																			</div>
																			<div class="col-md-2">
																				<div class="radio-custom">
																					<input type="radio" id="txt_po_vatno" name="txt_po_vat" value="No">
																					<label for="txt_po_vatno">No</label>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="txt_model" class="col-sm-6 control-label input">9.U.S.G./CLIENT/CONTRACT NO.</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control input" id="txt_po_contract" name="txt_po_contract"  placeholder="Type contract number..." value="<?php echo (isset($edit_po_contract))? $edit_po_contract : set_value('txt_po_contract');?>">
																			</div>
																		</div>
																	</td>
																	<td colspan="2">
																		<div class="form-group">
																			<label class="control-label col-sm-4">10.FHI 360 PURCHASE AGENT</label>
																			<div class="col-sm-8">
																				<input type="text" class="form-control input" id="txt_po_agent" name="txt_po_agent"  placeholder="Type purchase agent..." value="<?php echo (isset($edit_po_agent))? $edit_po_agent : set_value('txt_po_agent');?>">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">PHONE/FAX NO.</label>
																			<div class="col-sm-8">
																				<input type="text" class="form-control input" id="txt_po_agent_phone" name="txt_po_agent_phone"  placeholder="Type agent phone/fax no..." value="<?php echo (isset($edit_po_agent_phone))? $edit_po_agent_phone : set_value('txt_po_agent_phone');?>">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-sm-4">E-MAIL ADDRESS</label>
																			<div class="col-sm-8">
																				<input type="email" class="form-control input" id="txt_po_agent_email" name="txt_po_agent_email"  placeholder="Type agent email address..." value="<?php echo (isset($edit_po_agent_email))? $edit_po_agent_email : set_value('txt_po_agent_email');?>">
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
																	<td colspan="2">
																		<div class="form-group" style="">
																			<div class="col-sm-7">
																				<input type="text" class="form-control input" id="txt_po_signatured1" name="txt_po_signatured1"  placeholder="Type signatured #1..." value="<?php echo (isset($edit_po_signatured1))? $edit_po_signatured1 : set_value('txt_po_signatured1');?>">

																			</div>
																			<div class="col-sm-5">
																				 <div class="input-group">
																					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																					<input type="text" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}' class="form-control" name="txt_po_signatured_date1" id="txt_po_signatured_date1" value="<?php echo (isset($edit_po_signatured_date1))? $edit_po_signatured_date1 : set_value('txt_po_signatured_date1');?>">
																				</div>

																			</div>
																		</div>
																	</td>
																	<td colspan="2">
																		<div class="form-group" style="">
																			<div class="col-sm-7">
																				<input type="text" class="form-control input" id="txt_po_signatured2" name="txt_po_signatured2"  placeholder="Type signatured #2..." value="<?php echo (isset($edit_po_signatured2))? $edit_po_signatured2 : set_value('txt_po_signatured2');?>">

																			</div>
																			<div class="col-sm-5">
																				 <div class="input-group">
																					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																					<input type="text" data-plugin-datepicker data-plugin-options='{"orientation": "bottom auto"}' class="form-control" name="txt_po_signatured_date2" id="txt_po_signatured_date2" value="<?php echo (isset($edit_po_signatured_date2))? $edit_po_signatured_date2 : set_value('txt_po_signatured_date2');?>">
																				</div>

																			</div>
																		</div>
																	</td>
																</tr>


															</tbody>
														</table>
													</div>

												<footer class="panel-footer" style="border: 1px solid #dddddd;">
													<div class="row">
														<div class="col-md-12 text-right">
															<button type="submit" class="btn btn-primary" id="btn_save_po" name="btn_save_po"><i class="fa fa-save"></i> Save </button>
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

									<div id="modal-form-location" class="zoom-anim-dialog modal-block mfp-hide">
										<form action="" id="addnew-location" method="post" class="form-horizontal mb-lg" >
											<section class="panel">
												<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
													<h2 class="panel-title" style="font-size: medium; color: white;">Add New Item</h2>
												</header>
												<div class="panel-body">
													<div class="form-group">
														<label class="col-sm-3 control-label">ID/Code</label>
														<div class="col-sm-2">
															<input type="text" name="txt_item_code" id="txt_item_code" class="form-control" value="" placeholder="Type Id/code..." required />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Name/Title</label>
														<div class="col-sm-6">
															<div id="edit-form"></div>
															<input type="text" name="txt_item_name" id="txt_item_name" class="form-control" value="" placeholder="Type name/title classification..." required />
														</div>
													</div>
													<div class="form-group" style="">
														<label for="txt_district" class="col-sm-4 control-label input">District & Province</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_district" name="txt_district"  placeholder="Type district..." value="<?php echo (isset($edit_district))? $edit_district : set_value('txt_district');?>">
														</div>
													</div>

													<div class="form-group" style="">
														<label for="txt_country" class="col-sm-4 control-label input">Country</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input" id="txt_country" name="txt_country"  placeholder="Type country..." value="<?php echo (isset($edit_country))? $edit_country : set_value('txt_country');?>">
														</div>
													</div>

												</div>
												<footer class="panel-footer">
													<div class="row">
														<div class="col-md-12 text-right">
															<button type="submit" class="btn btn-primary" id="btn_save_location" name="btn_save_location"><i class="fa fa-save"></i> Save </button>
															<button class="btn btn-default modal-dismiss-location"><i class="fa fa-close"></i> Close </button>
														</div>
													</div>
													<br/>
													<div class="row">
														<div class="col-md-12">
															<div id="location-success" class="alert alert-success" style="display:none;">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																<strong>Well done!</strong> The record has been saved successfully.
															</div>

															<div id="location-failure" class="alert alert-danger" style="display:none;">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																<strong>Oh snap!</strong> <span id="span-location-failure"></span>
															</div>
														</div>
													</div>
												</footer>
											</section>
										</form>
									</div>

									<div id="modal-form-item" class="zoom-anim-dialog modal-block mfp-hide">
										<form action="" id="addnew-item" method="post" class="form-horizontal mb-lg" >
											<section class="panel">
												<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
													<h2 class="panel-title" style="font-size: medium; color: white;">Add New Item</h2>
												</header>
												<div class="panel-body">
													<div class="form-group">
														<label class="col-sm-3 control-label">ID/Code</label>
														<div class="col-sm-2">
															<input type="text" name="txt_item_code" id="txt_item_code" class="form-control" value="" placeholder="Type Id/code..." required />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Name/Title</label>
														<div class="col-sm-6">
															<div id="edit-form"></div>
															<input type="text" name="txt_item_name" id="txt_item_name" class="form-control" value="" placeholder="Type name/title classification..." required />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Category</label>
														<div class="col-sm-6">
															<div id="edit-form"></div>
															<input  autocomplete="off" type="text" name="txt_item_category" id="txt_item_category" class="form-control" value="" placeholder="Type category..." />
														</div>
													</div>

												</div>
												<footer class="panel-footer">
													<div class="row">
														<div class="col-md-12 text-right">
															<button type="submit" class="btn btn-primary" id="btn_save_item" name="btn_save_item"><i class="fa fa-save"></i> Save </button>
															<button class="btn btn-default modal-dismiss-item"><i class="fa fa-close"></i> Close </button>
														</div>
													</div>
													<br/>
													<div class="row">
														<div class="col-md-12">
															<div id="item-success" class="alert alert-success" style="display:none;">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																<strong>Well done!</strong> The record has been saved successfully.
															</div>

															<div id="item-failure" class="alert alert-danger" style="display:none;">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																<strong>Oh snap!</strong> <span id="span-item-failure"></span>
															</div>
														</div>
													</div>
												</footer>
											</section>
										</form>
									</div>

									<div id="modal-form-brand" class="zoom-anim-dialog modal-block mfp-hide">
										<form action="" id="addnew-brand" method="post" class="form-horizontal mb-lg" >
											<section class="panel">
												<header class="panel-heading" style=" border: 1px solid #5B707B; padding: 10px 14px; background: #5B707B;">
													<h2 class="panel-title" style="font-size: medium; color: white;">Add New Brand</h2>
												</header>
												<div class="panel-body">
													<div class="form-group">
														<label class="col-sm-3 control-label">Name/Title</label>
														<div class="col-sm-6">
															<input type="hidden" name="txt_brand_id" id="txt_brand_id" class="form-control" value="" placeholder="Type Id/code..." required />
															<input readonly type="text" name="txt_brand_item" id="txt_brand_item" class="form-control" value="" placeholder="Type name/title classification..." required />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">ID/Code</label>
														<div class="col-sm-2">
															<input type="text" name="txt_brand_code" id="txt_brand_code" class="form-control" value="" placeholder="Type Id/code..." required />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Brand/Merk</label>
														<div class="col-sm-6">
															<div id="edit-form"></div>
															<input type="text" name="txt_brand_name" id="txt_brand_name" class="form-control" value="" placeholder="Type brand/merk..." required />
														</div>
													</div>

												</div>
												<footer class="panel-footer">
													<div class="row">
														<div class="col-md-12 text-right">
															<button type="submit" class="btn btn-primary" id="btn_save_brand" name="btn_save_brand"><i class="fa fa-save"></i> Save </button>
															<button class="btn btn-default modal-dismiss-brand"><i class="fa fa-close"></i> Close </button>
														</div>
													</div>
													<br/>
													<div class="row">
														<div class="col-md-12">
															<div id="brand-success" class="alert alert-success" style="display:none;">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																<strong>Well done!</strong> The record has been saved successfully.
															</div>

															<div id="brand-failure" class="alert alert-danger" style="display:none;">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
																<strong>Oh snap!</strong> <span id="span-brand-failure"></span>
															</div>
														</div>
													</div>
												</footer>
											</section>
										</form>
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
		<script src="<?=base_url();?>assets/adporto/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/jquery-placeholder/jquery-placeholder.js"></script>

		<!-- Specific Page Vendor -->
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap/js/bootstrap.min.js"></script>


		<script src="<?=base_url();?>assets/adporto/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/select2/js/select2.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
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


		<!-- Theme Base, Components and Settings -->
		<script src="<?=base_url();?>assets/adporto/javascripts/theme.js"></script>

		<!-- Theme Custom -->
		<script src="<?=base_url();?>assets/adporto/javascripts/theme.custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="<?=base_url();?>assets/adporto/javascripts/theme.init.js"></script>

		<!-- Examples -->
		<script src="<?=base_url();?>assets/adporto/javascripts/forms/examples.advanced.form.js"></script>

		<!-- Examples -->
		<script src="<?=base_url();?>assets/adporto/javascripts/ui-elements/examples.modals.js"></script>

		<script src="<?=base_url();?>assets/additional/jquery.maskMoney.js"></script>


		<script src="<?=base_url();?>assets/adporto/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="<?=base_url();?>assets/additional/typeahead/demo/assets/js/jquery.mockjax.js"></script>
        <script src="<?=base_url();?>assets/additional/typeahead/src/bootstrap-typeahead.js"></script>





	<script type="text/javascript">
    (function($) {
		'use strict';
		var serial_id='';
		var docInit = function() {
			LoadPurchaseNumber();
			LoadLocation();
			LoadVendor();
			$(document).on('click', '.modal-dismiss-po', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
				$('modal-form-po input[type="text"]').val('');
			});

			$(document).on('click', '.modal-dismiss-item', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
				$('#modal-form-item input[type="text"]').val('');
			});

			$(document).on('click', '.modal-dismiss-brand', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
				$('#modal-form-brand input[type="text"]').val('');
			});

			$(document).on('click', '#btn_item', function (e) {
				e.preventDefault();
				$.ajax({
					type : "GET",
					url  : '<?=base_url();?>inventories/get_new_item_code',
					success: function(response){
						if(response!=""){
							$('#txt_item_code').val(response);
						}
						else
						{
							$('#txt_item_code').val('00');
						}

					}
				});
			});

			$('#addnew-item').submit(function(e) {
				e.preventDefault();
				$("#item-failure").slideUp();
				$("#btn_save_item").html('<i class="fa fa-spinner"></i> Saving...');
				var data = $("#addnew-item").serialize();
				$.ajax({
					type : "POST",
					url  : '<?=base_url();?>inventories/item_do_add',
					data : data,
					success: function(response){
						if(response=="ok"){
							$('#addnew-item input[type="text"]').val('');
							$("#btn_save_item").html('<i class="fa fa-save"></i> Save ');
							$("#item-success").alert();
							$("#item-success").fadeTo(2000, 1000).slideUp(1500, function(){
								$("#item-success").slideUp(1500);
							});
							LoadOption("Items");

							$.ajax({
								type : "GET",
								url  : '<?=base_url();?>inventories/get_new_item_code',
								success: function(response){
									if(response!=""){
										$('#txt_item_code').val(response);
									}
									else
									{
										$('#txt_item_code').val('00');
									}

								}
							});
						}
						else
						{
							$("#btn_save_item").html('<i class="fa fa-save"></i> Save ');
							$("#item-failure").slideDown('slow');
							$("#span-item-failure").html(response)
						}

					}
				});
			});

			$(document).on('click', '#btn_brand', function (e) {
				e.preventDefault();
				var item = $('#txt_item  option:selected').attr('title');
				var item_id = $('#txt_item').val();
				if (item_id=='') {
					$.magnificPopup.close();
					$(".modal-body #data-alert").html('You must select the Clasification item above.');
					$("#modal-alert").modal('show');
				}else{
					$.ajax({
						type : "GET",
						url  : '<?=base_url();?>inventories/get_new_brand_code/'+item_id,
						success: function(response){
							if(response!=""){
								$('#txt_brand_code').val(response);
								$('#txt_brand_id').val(item_id);
								$('#txt_brand_item').val(item);
							}
							else
							{
								$('#txt_brand_code').val('00');
								$('#txt_brand_id').val(item_id);
								$('#txt_brand_item').val(item);
							}

						}
					});
				}
			});

			$('#txt_brand').change(function() {
				var item_id = $('#txt_item').val();
				var brand_id = $(this).val();
				if (item_id=='') {
					$(".modal-body #data-alert").html('You must select the Clasification item above.');
					$("#modal-alert").modal('show');
					$(this).val('');
				}else{
					$.ajax({
						type : "GET",
						url  : '<?=base_url();?>inventories/get_new_serial/'+item_id+'/'+brand_id,
						success: function(response){
							$('#txt_serial').val(response);
							$('#txt_inventory_number').val('');
							var item_id = $('#txt_item').val();
							var brand_id = $('#txt_brand').val();
							var serial_id = response;
							var po_id = $('#txt_po').val();
							var project_id = $('#txt_project').val();

							if (item_id!='' & brand_id!=''& po_id!='' & project_id!='') {
								$.ajax({
									type : "POST",
									url  : '<?=base_url();?>inventories/get_purchase_date/',
									data: { po_number: po_id} ,
									success: function(response){
										$('#txt_inventory_number').val(project_id+'/'+item_id+'.'+brand_id+'.'+serial_id+'/'+response);
									}
								});
							}
						}
					});
				}
				//LoadInvNo();
			});

			$('#txt_po').change(function() {
				LoadInvNo();
			});

			$('#txt_project').change(function() {
				LoadInvNo();
			});


			$('#addnew-brand').submit(function(e) {
				e.preventDefault();
				$("#brand-failure").slideUp();
				$("#btn_save_brand").html('<i class="fa fa-spinner"></i> Saving...');
				var item = $('#txt_item  option:selected').attr('title');
				var item_id = $('#txt_item').val();
				var data = $("#addnew-brand").serialize();
				$.ajax({
					type : "POST",
					url  : '<?=base_url();?>inventories/brand_do_add',
					data : data,
					success: function(response){
						if(response=="ok"){
							$('#addnew-brand input[type="text"]').val('');
							$("#btn_save_brand").html('<i class="fa fa-save"></i> Save ');
							$("#brand-success").alert();
							$("#brand-success").fadeTo(2000, 1000).slideUp(1500, function(){
								$("#brand-success").slideUp(1500);
							});
							var paren = $('#txt_brand_id').val();
							LoadOption("Brands", paren);
							$.ajax({
								type : "GET",
								url  : '<?=base_url();?>inventories/get_new_brand_code/'+paren,
								success: function(response){
									if(response!=""){
										$('#txt_brand_code').val(response);
										$('#txt_brand_id').val(item_id);
										$('#txt_brand_item').val(item);
									}
									else
									{
										$('#txt_brand_code').val('00');
										$('#txt_brand_id').val(item_id);
										$('#txt_brand_item').val(item);
									}

								}
							});
						}
						else
						{
							$("#btn_save_brand").html('<i class="fa fa-save"></i> Save ');
							$("#brand-failure").slideDown('slow');
							$("#span-brand-failure").html(response)
						}

					}
				});
			});

			$('#txt_item').change(function() {
				var paren = $(this).val();
				LoadOption("Brands", paren);
				LoadInvNo();

			});



			function LoadOption(str, paren=''){
				$.ajax({
					type: 'GET',
					url: '<?php echo base_url();?>inventories/get_option/'+str+'/'+paren,
					success: function(response) {
						if (str=='Items') {
							$('#txt_item').html(response);
						}else if (str=='Brands') {
							$('#txt_brand').html(response);
						}

					}
				});
			}

			$('#txt_item_image').change(function() {
				if ($('#txt_item_image').get(0).files.length > 0) {
					var imgValue = $(this).val();
					var urlAbsolute='<?php echo base_url();?>images/items/';
					$('#loader').show();
					setTimeout( function () {
						var file_data = $('#txt_item_image').prop('files')[0];
						var form_data = new FormData();
						form_data.append('txt_item_image', file_data);
						$.ajax({
							url 			:'<?php echo base_url();?>inventories/do_upload',
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,
							type: 'post',
							dataType		: 'json',
							success: function (response){
								if (response.msg=='success') {
									$('#loader').hide();
									//alert(response.filename);
									$('#no-image').attr("src", urlAbsolute+response.filename)
								}else{
									$('#loader').hide();
									//alert(response.msg);
									$(".modal-body #data-alert").html(response.msg);
									$("#modal-alert").modal('show');
									$('#no-image').attr("src", urlAbsolute+response.filename)
								}
							}

						});

					}, 100);
				}

			});

			$(document).on('click', '#item_image_remove', function (e) {
				e.preventDefault();
				$("#no-image").attr("src","<?php echo base_url();?>images/items/no-image.png");
				/*
				var urlAbsolute=$('#no-image').attr("src");
				if (urlAbsolute!='<?php echo base_url();?>images/items/no-image.png') {
					//alert(urlAbsolute);
					$('#loader').show();
					$.ajax({
						url: '<?php echo base_url();?>inventories/do_remove_file',
						type: 'post',
						data: {path: urlAbsolute},
						success: function(response){
							if(response == 'success'){
								$('#loader').hide();
								$("#no-image").attr("src","<?php echo base_url();?>images/items/no-image.png");
							}

						}
					});
				}
				*/
			});


			$('#btn_po_vendor_select').click(function(e) {
				e.preventDefault();
				$('#select-group-vendor').slideUp('fast');
				$('#input-group-vendor').slideDown('fast');
				$('#txt_po_vendor_name').val('');
				$('#txt_po_vendor_address').val('');
				$('#txt_po_vendor_phone').val('');
				$('#txt_po_vendor_fax').val('');
				$('#txt_po_vendor_ident').val('');
				$.ajax({
					type : "GET",
					url  : '<?=base_url();?>inventories/get_new_vendor_code',
					success: function(response){
						if(response!=""){
							$('#vendor-id').html("<input type='hidden' class='form-control input' id='txt_po_vendor_id' name='txt_po_vendor_id' value='"+response+"'>");
						}
					}
				});
			});

			$('#txt_po_vendor_select').change(function() {
				var str = $(this).val();
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: '<?php echo base_url();?>inventories/get_vendor/'+str,
					success: function(response) {
						$('#txt_po_vendor_name').val(response.vendor_name);
						$('#txt_po_vendor_address').val(response.vendor_address);
						$('#txt_po_vendor_phone').val(response.vendor_phone);
						$('#txt_po_vendor_fax').val(response.vendor_fax);
						$('#txt_po_vendor_ident').val(response.vendor_ident);
						//alert(str+' - '+response.vendor_name)
					}
				});

			});

			$('#btn_po_vendor_new').click(function(e) {
				e.preventDefault();
				LoadVendor();
				$('#input-group-vendor').slideUp('fast');
				$('#select-group-vendor').slideDown('fast');
				$('#vendor-id').html('')
			});

			$('#txt_rate').maskMoney({thousands:'.', precision:0});
			$('#txt_usd').maskMoney();
			$('#txt_idr').maskMoney({thousands:'.', precision:0});
			$('#txt_po_usd').maskMoney();
			$('#txt_po_idr').maskMoney({thousands:'.', precision:0});


			$('#addnew-po').submit(function(e) {
				e.preventDefault();

				$("#po-failure").slideUp();
				$("#btn_save_po").html('<i class="fa fa-spinner"></i> Saving...');
				var data = $("#addnew-po").serialize();

				$.ajax({
					type : "POST",
					url  : '<?=base_url();?>inventories/po_do_add',
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
							LoadPurchaseNumber();
							LoadVendor();
						}
						else
						{
							$("#btn_save_po").html('<i class="fa fa-save"></i> Save ');
							$("#po-failure").slideDown('slow');
							$("#span-po-failure").html(response)
						}

					}
				});
			});

			$('#btn_location_plus').click(function(e) {
				e.preventDefault();
				$('#select-group-location').slideUp('fast');
				$('#input-group-location').slideDown('fast');

				$('#txt_district').val('');
				$('#txt_province').val('');
				$('#txt_country').val('');
				$('#txt_location').val('');

				$.ajax({
					type : "GET",
					url  : '<?=base_url();?>inventories/get_new_location_code',
					success: function(response){
						if(response!=""){
							$('#location-id').html("<input type='hidden' class='form-control input' id='txt_location_id' name='txt_location_id' value='"+response+"'>");
						}
					}
				});
			});

			$('#btn_location_undo').click(function(e) {
				e.preventDefault();
				LoadLocation();
				$('#input-group-location').slideUp('fast');
				$('#select-group-location').slideDown('fast');
				$('#location-id').html('')
			});

			$('#txt_location_select').change(function() {
				var str = $(this).val();
				if (str!='') {
					$.ajax({
						type: 'POST',
						dataType: 'json',
						url: '<?php echo base_url();?>inventories/get_location/'+str,
						success: function(response) {

							$('#txt_location').val(response.loca_name);
							$('#txt_district').val(response.loca_district);
							$('#txt_province').val(response.loca_province);
							$('#txt_country').val(response.loca_country);
						}
					});
				}else{
					$('#txt_location').val('');
					$('#txt_district').val('');
					$('#txt_province').val('');
					$('#txt_country').val('');
				}


			});

			function LoadPurchaseNumber(){
				$.ajax({
					type: 'GET',
					url: '<?php echo base_url();?>inventories/get_po_number',
					success: function(response) {
						$('#txt_po').html(response);
					}
				});
			}

			function LoadVendor(){
				$.ajax({
					type: 'GET',
					url: '<?php echo base_url();?>inventories/get_vendor_lists',
					success: function(response) {
						$('#txt_po_vendor_select').html(response);
					}
				});
			}

			function LoadLocation(){
				$.ajax({
					type: 'GET',
					url: '<?php echo base_url();?>inventories/get_location_lists',
					success: function(response) {
						$('#txt_location_select').html(response);
					}
				});
			}

			$('#addnew-list').submit(function(e) {
				e.preventDefault();
				//$("#list-failure").slideUp();
				$("#btn_save").html('<i class="fa fa-spinner"></i> Saving...');
				//var data = $("#addnew-list").serialize();

				$.ajax({
					type : "POST",
					url  : '<?=base_url();?>inventories/do_add',
					data: new FormData( this ),
					processData: false,
					contentType: false,
					//data : data,
					success: function(response){
						//alert(response);
						if(response=="ok"){
							/*
							$( '#addnew-list' ).each(function(){
								this.reset();
							});
							$("#no-image").attr("src","<?php echo base_url();?>images/items/no-image.png");
							$('#barcode').html('');
							*/
							$("#btn_save").html('<i class="fa fa-save"></i> Save ');
							$("#list-success").alert();
							$("#list-success").fadeTo(2000, 1000).slideUp(1500, function(){
								$("#list-success").slideUp(1500);
							});
							//window.location.reload();
						}
						else
						{
							$("#btn_save").html('<i class="fa fa-save"></i> Save ');
							$("#list-failure").slideDown('slow');
							$("#span-list-failure").html(response)
						}

					}
				});
			});

			$('#btn_inventory_generate').click(function(e) {
				e.preventDefault();
				var item_id = $('#txt_item').val();
				var brand_id = $('#txt_brand').val();
				var serial_id = $('#txt_serial').val();
				var po_id = $('#txt_po').val();
				var project_id = $('#txt_project').val();

				if (item_id=='') {
					$(".modal-body #data-alert").html('You must select the Clasification item above.');
					$("#modal-alert").modal('show');
				}else if(brand_id=='') {
					$(".modal-body #data-alert").html('You must select the Brand item above.');
					$("#modal-alert").modal('show');
				}else if(po_id=='') {
					$(".modal-body #data-alert").html('You must select the PO Number above.');
					$("#modal-alert").modal('show');
				}else if(project_id=='') {
					$(".modal-body #data-alert").html('You must select the Project Title above.');
					$("#modal-alert").modal('show');
				}else{
					$.ajax({
						type : "POST",
						url  : '<?=base_url();?>inventories/get_purchase_date/',
						data: { po_number: po_id} ,
						success: function(response){
							$('#txt_inventory_number').val(project_id+'/'+item_id+'.'+brand_id+'.'+serial_id+'/'+response);
						}
					});
				}

			});

			function LoadInvNo(){
				$('#txt_inventory_number').val('');
				var item_id = $('#txt_item').val();
				var brand_id = $('#txt_brand').val();
				var serial_id = $('#txt_serial').val();
				var po_id = $('#txt_po').val();
				var project_id = $('#txt_project').val();

				if (item_id!='' & brand_id!=''& po_id!='' & project_id!='') {
					$.ajax({
						type : "POST",
						url  : '<?=base_url();?>inventories/get_purchase_date/',
						data: { po_number: po_id} ,
						success: function(response){
							$('#txt_inventory_number').val(project_id+'/'+item_id+'.'+brand_id+'.'+serial_id+'/'+response);
						}
					});
				}
			}

			$('#btn_barcode_generate').click(function(e) {
				e.preventDefault();
				var inventory_number = $('#txt_inventory_number').val();

				if (inventory_number=='') {
					$(".modal-body #data-alert").html('Inventory Number is not null.');
					$("#modal-alert").modal('show');
				}else{
					$.ajax({
						type : "POST",
						url  : '<?=base_url();?>inventories/get_form_urlencode',
						data: { txt_inventory_number: inventory_number},
						success: function(response){
							$('#barcode').html("<img src='<?=base_url();?>inventories/get_barcode/"+response+"'>");
						}
					});


				}

			});

			$('#btn_barcode').click(function(e){
				e.preventDefault();
				var inventory_number = $('#txt_inventory_number').val();
				if (inventory_number=='') {
					$(".modal-body #data-alert").html('Inventory Number is not null.');
					$("#modal-alert").modal('show');
				}else{
					$.ajax({
						type : "POST",
						url  : '<?=base_url();?>inventories/get_form_urlencode',
						data: { txt_inventory_number: inventory_number},
						success: function(response){
							window.open("<?=base_url();?>inventories/print_barcode/"+response);
						}
					});
				}
			});

			$('#txt_model').typeahead({
				source: function (query, process) {
					$.ajax({
						url: '<?=base_url();?>inventories/get_list_model',
						type: 'POST',
						dataType: 'JSON',
						data: 'query=' + query,
						success: function(data) {
							console.log(data);
							process(data);
						}
					});
				}
			});
		}


		$(function() {
			docInit();
		});

	}).apply(this, [jQuery]);


	</script>
