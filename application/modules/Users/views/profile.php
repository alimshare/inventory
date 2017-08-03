				<section role="main" class="content-body">
					<header class="page-header">
						<h2>User Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Pages</span></li>
								<li><span>User Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

					<div class="row">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img src="<?php echo base_url() ?>images/avatars/no-img.jpg" class="rounded img-responsive" alt="John Doe">
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?php echo $user->account_name ?></span>
											<span class="thumb-info-type"><?php echo $user->role ?></span>
										</div>
									</div>


								</div>
							</section>

						</div>
						<div class="col-md-8 col-lg-9">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a href="#overview" data-toggle="tab">Info</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">
										<form class="form-horizontal" method="post" action="<?php echo base_url('Users/updateProfile') ?>">
											<h4 class="mb-xlg">Personal Information</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-sm-4 control-label">Account Name/Login</label>
													<div class="col-sm-8">
														<div id="edit-form"></div>
														<input type="text" name="txt_account" id="txt_account" class="form-control" value="<?php echo $user->account_name ?>" placeholder="" disabled/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Username</label>
													<div class="col-sm-8">
														<input type="text" name="txt_username" id="txt_username" class="form-control" value="<?php echo $user->username ?>" placeholder="Type username..." required />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Email</label>
													<div class="col-sm-8">
														<input type="email" name="txt_email" id="txt_email" class="form-control" value="<?php echo $user->email ?>" placeholder="Type email..." required />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Role</label>
													<div class="col-sm-8">
														<input type="text" name="txt_role" id="txt_name" class="form-control" value="<?php echo $user->role ?>" placeholder="" disabled/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Project</label>
													<div class="col-sm-8">
														<input type="text" name="txt_project" id="txt_name" class="form-control" value="<?php echo $user->project_code.' - '.$user->project_name ?>" placeholder="" disabled />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Unit/Department</label>
													<div class="col-sm-8">
														<input type="text" name="txt_unit" id="txt_name" class="form-control" value="<?php echo $user->unit_name ?>" placeholder="" disabled />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Location</label>
													<div class="col-sm-8">
														<input type="text" name="txt_loca" id="txt_name" class="form-control" value="<?php echo $user->loca_province ?>" placeholder="" disabled />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Job Title</label>
													<div class="col-sm-8">
														<input type="text" name="txt_job" id="txt_purpose" class="form-control" value="<?php echo $user->purpose ?>" placeholder="" disabled/>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Signature</label>
													<div class="col-sm-8">
														<div class="mt-sm">
															<?php if ($user->signature <> ""): ?>
																<img src="<?php echo base_url().'images/items/'.$user->signature ?>" id="preview" style="max-width:100%">
															<?php else: ?>
																<img src="<?php echo base_url().'images/items/no-image.png' ?>" id="preview" style="max-width:100%">
															<?php endif ?>
														</div>
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">Update</button>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>

					</div>
					<!-- end: page -->
				</section>
			</div>
		</section>
		
<script src="<?=base_url();?>assets/adporto/vendor/jquery/jquery.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/jquery-ui/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/adporto/vendor/bootstrap/js/bootstrap.js"></script>