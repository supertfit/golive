<!DOCTYPE html>
<html lang="en" style="overflow-x: auto;">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>goLiveCard Admin Panel</title>
	<meta name="description" content="goLiveCard Admin panel.">
	<meta name="author" content="goLiveCard">
	<meta name="keyword" content="goLiveCard, Backend">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	
	<!-- start: JavaScript-->
	<!--[if !IE]>-->

	<script src="<?php echo GENIUS_JS_PATH;?>jquery-2.0.3.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script src="<?php echo GENIUS_JS_PATH;?>jquery-1.10.2.min.js"></script>
	
	<![endif]-->

	<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo GENIUS_JS_PATH;?>jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script type="text/javascript">
	 	window.jQuery || document.write("<script src='<?php echo GENIUS_JS_PATH;?>jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		
	<![endif]-->
	<script src="<?php echo GENIUS_JS_PATH;?>jquery-migrate-1.2.1.min.js"></script>
	<script src="<?php echo GENIUS_JS_PATH;?>bootstrap.min.js"></script>
	
	<!-- page scripts -->
	<script src="<?php echo GENIUS_JS_PATH;?>jquery-ui-1.10.3.custom.min.js"></script>
	
	<!-- theme scripts -->
	<script src="<?php echo GENIUS_JS_PATH;?>custom.min.js"></script>
	<script src="<?php echo GENIUS_JS_PATH;?>core.min.js"></script>
	
	<!-- inline scripts related to this page -->
	
	<!-- end: JavaScript-->
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo GENIUS_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo GENIUS_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
    
	<!-- start: CSS -->
	<link href="<?php echo GENIUS_CSS_PATH; ?>bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo GENIUS_CSS_PATH; ?>style.min.css" rel="stylesheet">
	<link href="<?php echo GENIUS_CSS_PATH; ?>retina.min.css" rel="stylesheet">
	<link href="<?php echo GENIUS_CSS_PATH; ?>print.css" rel="stylesheet" type="text/css" media="print"/>
	<link href="<?php echo HTTP_CSS_PATH; ?>admin/style.css" rel="stylesheet" type="text/css">
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo GENIUS_JS_PATH; ?>/respond.min.js"></script>
		
	<![endif]-->

	<link rel="shortcut icon" href="<?php echo HTTP_IMAGES_PATH; ?>favicon.png">
	<!-- end: Favicon and Touch Icons -->	
		
</head>
<body>
<?php
    $pg = isset($page) && $page != '' ?  $page : 0  ;    
?>
	<!-- start: Header -->
	<header class="navbar">
		<div class="container">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".sidebar-nav.nav-collapse">
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			</button>
			<a id="main-menu-toggle" class="hidden-xs open"><i class="icon-reorder"></i></a>		
			<a class="navbar-brand col-md-2 col-sm-1 col-xs-2" href="#"><span>goLiveCard</span></a>
			<!-- start: Header Menu -->
			<div class="nav-no-collapse header-nav">
				<ul class="nav navbar-nav pull-right">
					<!-- start: User Dropdown -->
					<li class="dropdown">
						<a class="btn account dropdown-toggle" data-toggle="dropdown" href="ui-elements.html#">
							<div class="avatar"><img src="<?php echo HTTP_PROFILE_PATH.$this->session->userdata('photo');?>" alt="Avatar"></div>
							<div class="user">
								<span class="hello">Welcome!</span>
								<span class="name"><?php echo $this->session->userdata('username')?></span>
							</div>
						</a>
						<ul class="dropdown-menu">
							<!-- li><a href="#"><i class="icon-user"></i> Profile</a></li>
							<li><a href="#"><i class="icon-cog"></i> Settings</a></li -->
							<li><a href="<?php echo base_url(); ?>admin/users/logout"><i class="icon-off"></i> Logout</a></li>
						</ul>
					</li>
					<!-- end: User Dropdown -->
				</ul>
			</div>
			<!-- end: Header Menu -->
		</div>	
	</header>
	<!-- end: Header -->
	<div class="container">
		<div class="row">
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="col-lg-2 col-sm-1 ">
				<div class="sidebar-nav nav-collapse collapse navbar-collapse">
					<ul class="nav main-menu">
						<li <?php if ($pg == 0) { echo 'class="active"';}?>><a href="<?php echo base_url(); ?>admin/dashboard" ><i class="icon-bar-chart"></i><span class="hidden-sm text"> Dashboard</span></a></li>	
						<li <?php echo ($pg == 1) ? 'class="active"' : '' ?>>
							<a href="<?php echo base_url();?>admin/users"><i class="icon-male"></i><span class="hidden-sm text"> Users</span></a>
						</li>
						<li <?php if ($pg == 7) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/customCard"><i class="icon-picture"></i><span class="hidden-sm text"> Custom Cards</span></a>
						</li>
						<li <?php if ($pg == 8) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/categoryCard"><i class="icon-tag"></i><span class="hidden-sm text"> Category Cards</span></a>
						</li>
						<li <?php if ($pg == 9) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/touristCard"><i class="icon-bar-chart"></i><span class="hidden-sm text"> Franchise Cards</span></a>
						</li>																																				
						<li <?php if ($pg == 10) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/category"><i class="icon-tags"></i><span class="hidden-sm text"> Default Categories</span></a>
						</li>
						<li <?php if ($pg == 14) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/touristcategory"><i class="icon-tags"></i><span class="hidden-sm text"> Franchise Categories</span></a>
						</li>						
						<li <?php if ($pg == 11) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/deal"><i class="icon-rocket"></i><span class="hidden-sm text"> Deals</span></a>
						</li>
						<li <?php if ($pg == 12) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/promo"><i class="icon-ticket"></i><span class="hidden-sm text"> Promo Codes</span></a>
						</li>
						<li <?php if ($pg == 13) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/buycredit"><i class="icon-money"></i><span class="hidden-sm text"> Buy Credits</span></a>
						</li>
						<li <?php if ($pg == 21) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/invoice"><i class="icon-print"></i><span class="hidden-sm text"> Invoices</span></a>
						</li>
						<li <?php if ($pg == 22) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/transaction"><i class="icon-credit-card"></i><span class="hidden-sm text"> Transactions</span></a>
						</li>
						<li <?php if ($pg == 23) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/deliveryNote"><i class="icon-flag"></i><span class="hidden-sm text"> Delivery Note</span></a>
						</li>
						<li <?php if ($pg == 24) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/supportCategory"><i class="icon-tag"></i><span class="hidden-sm text"> Support Category</span></a>
						</li>						
						<li <?php if ($pg == 6) { echo 'class="active"';}?>>
							<a href="<?php echo base_url();?>admin/home/go_qrgenerator"><i class="icon-qrcode"></i><span class="hidden-sm text"> QR Code Generator</span></a>
						</li>
					</ul>
				</div>
				<a href="#" id="main-menu-min" class="full visible-md visible-lg"><i class="icon-double-angle-left"></i></a>
			</div>
			<!-- end: Main Menu -->
					
