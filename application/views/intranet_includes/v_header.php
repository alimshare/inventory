<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">
		<link rel="shortcut icon" type="images/logos/inventory.ico" href="<?=base_url();?>images/logos/inventory.ico" />
		<title>
			Invento | <?php echo (isset($bar_titel)) ? $bar_titel : "System"; ?>
		</title>
		<meta name="keywords" content="<?php echo (isset($meta_key)) ? $meta_key : "inventory, management, system";?>" />
		<meta name="description" content="<?php echo (isset($meta_desc)) ? $meta_desc : "Invento - Inventory Management System";?>">
		<meta name="author" content="<?php echo (isset($meta_author)) ? $meta_author : "USAID";?>">
		<meta name="robots" content="<?php echo (isset($meta_robots)) ? $meta_robots : "All";?>" />


		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor//bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/morris.js/morris.css" />



		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?=base_url();?>assets/adporto/vendor/modernizr/modernizr.js"></script>


		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/select2-bootstrap-theme/select2-bootstrap.css" />
		<link rel="stylesheet" href="<?=base_url();?>assets/adporto/vendor/jquery-datatables-bs3/assets/css/datatables.css" />


	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="" class="logo">
						<img src="<?=base_url();?>images/logos/linkages.png" height="35" alt="COMS" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<!-- start: search & user box -->
				<div class="header-right">



					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">

								<img src="<?php echo ($this->int_header->avatar()=='') ? base_url().'images/avatars/no-img.jpg' : base_url().$this->int_header->avatar(); ?>" alt="<?=$authen['full'];?>" class="img-circle" data-lock-picture="<?php echo ($this->int_header->avatar()=='') ? base_url().'images/avatars/no-img.jpg' : base_url().$this->int_header->avatar(); ?>" />

							</figure>
							<div class="profile-info" data-lock-name="<?php echo isset($authen['full']) ? $authen['full'] :"No Login";?>" data-lock-email="">
								<span class="name"><?php echo isset($authen['full']) ? $authen['full']." | ".$authen['instansi'] :"No Login" ;?></span>
								<span class="role"><?php echo isset($authen['jabatan']) ? $authen['jabatan']." | ".$authen['level_instansi'] :"No Login" ;?></span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?=base_url('Users/profile');?>"><i class="fa fa-user"></i> Profil Saya</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?=base_url('Login/logout');?>"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="<?php if(isset($menu_titel) && $menu_titel=="Dashboard"){ echo "nav-active"; } ?>">
										<a href="<?php echo base_url('Dashboard') ?>">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="<?php if(isset($menu_titel) && $menu_titel=="User"){ echo "nav-active"; } ?>">
										<a href="<?php echo base_url('Users') ?>">
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>User Management</span>
										</a>
									</li>
									<li class="nav-parent <?php if(isset($menu_titel) && $menu_titel=="Iventories"){ echo "nav-expanded nav-active"; } ?>">
										<a>
											<i class="fa fa-cubes" aria-hidden="true"></i>
											<span>Inventories</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?php if(isset($page_titel) && $page_titel=="Inventory Input Form"){ echo "nav-expanded nav-active"; } ?>">
												<a href="<?=base_url();?>Inventories/addnew">
													Add Inventory
												</a>
											</li>
											<li class="<?php if(isset($page_titel) && $page_titel=="Inventory Lists"){ echo "nav-expanded nav-active"; } ?>">
												<a href="<?=base_url();?>Inventories/lists">
													Inventory Lists
												</a>
											</li>
										</ul>
									</li>
                                    
									<li class="nav-parent">
										<a>
											<i class="fa fa-gears" aria-hidden="true"></i>
											<span>Settings</span>
										</a>
										<ul class="nav nav-children">
											<li class="">
												<a href="<?php echo base_url('Settings/Projects');?>">
													Project
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Locations');?>">
													Location
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Units');?>">
													Unit/Department
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Durations');?>">
													Duration
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Items');?>">
													Item Unit
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Consultant');?>">
													Consultant
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Subcontractor');?>">
													Sub-contractor
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Vendor/Vendor_category');?>">
													Vendor Category
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Preferred_vendor');?>">
													Preferred Vendor
												</a>
											</li>
											<li class="">
												<a href="<?=base_url('Settings/Consumable_stuff');?>">
													Consumable Stuff
												</a>
											</li>
										</ul>
									</li>

									<li class="<?php if(isset($menu_titel) && $menu_titel=="quotation"){ echo "nav-active"; } ?>">
										<a href="<?php echo base_url('Quotation') ?>">
											<i class="fa fa-circle" aria-hidden="true"></i>
											<span>Quotation</span>
										</a>
									</li>

									<li class="<?php if(isset($menu_titel) && $menu_titel=="memo"){ echo "nav-active"; } ?>">
										<a href="<?php echo base_url('Memo') ?>">
											<i class="fa fa-circle" aria-hidden="true"></i>
											<span>Selection Memo</span>
										</a>
									</li>

									<li class="<?php if(isset($menu_titel) && $menu_titel=="po"){ echo "nav-active"; } ?>">
										<a href="<?php echo base_url('Po') ?>">
											<i class="fa fa-circle" aria-hidden="true"></i>
											<span>Purchase Order</span>
										</a>
									</li>
								</ul>
							</nav>


						</div>



					</div>

				</aside>
				<!-- end: sidebar -->
