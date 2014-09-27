<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li><a href="#">Dashboard</a></li>
					</ol>
	
				</div><!--/row-->
				
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>Dashboard</h2>
							</div>
							<div class="box-content">
							    <div class="row">
    								<div class="col-sm-2">
    									<a class="quick-button" href="<?php echo base_url(); ?>admin/users">
    										<i class="icon-group"></i>
    										<p>User Management</p>
    										<span class="notification blue"><?php echo $count_user;?></span>
    									</a>
    								</div>
    								<!-- div class="col-sm-2">
    									<a class="quick-button" href="<?php echo base_url();?>admin/card">
    										<i class="icon-picture"></i>
    										<p>Card List</p>
    										<span class="notification blue"><?php echo $cardscnt;?></span>
    									</a>
    								</div -->
    								<div class="col-sm-2">
    									<a class="quick-button" href="<?php echo base_url();?>admin/card">
    										<i class="icon-ticket"></i>
    										<p>Franchise Cards</p>
    										<span class="notification blue"><?php echo $count_tourist;?></span>
    									</a>
    								</div>
    								<div class="col-sm-2">
    									<a class="quick-button" href="<?php echo base_url();?>admin/card">
    										<i class="icon-picture"></i>
    										<p>Custom Cards</p>
    										<span class="notification blue"><?php echo $count_custom;?></span>
    									</a>
    								</div>
    								<div class="col-sm-2">
    									<a class="quick-button" href="<?php echo base_url();?>admin/card">
    										<i class="icon-tag"></i>
    										<p>Category Cards</p>
    										<span class="notification blue"><?php echo $count_category;?></span>
    									</a>
    								</div>
    								<div class="col-sm-2">
    									<a class="quick-button" href="<?php echo base_url();?>admin/category">
    										<i class="icon-tags"></i>
    										<p>Default Cards</p>
    										<span class="notification blue"><?php echo $count_default_category;?></span>
    									</a>
    								</div>
    								<div class="col-sm-2">
    									<a class="quick-button" href="<?php echo base_url(); ?>admin/home/go_qrgenerator">
    										<i class="icon-qrcode"></i>
    										<p>QR Code Generator</p>
    									</a>
    								</div>    								
    								<div class="clearfix"></div>
								</div>
							</div>	
						</div>	
					</div><!--/col-->
					
				</div><!--/row-->
			</div>
			<!-- end: Content -->
				
		</div><!--/row-->	
<?php
$this->load->view('admin/vwFooter');
?>