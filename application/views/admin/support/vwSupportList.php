<?php
$this->load->view('admin/vwHeader_v');
?>
	<!-- start: Content -->
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Support</li>
			</ol>
		</div><!--/row-->
		
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-comment"></i><span class="break"></span>Support</h2>
						<div class="pull-right areaBtnAdd">
							<a class="btn btn-primary" href='<?php echo base_url();?>admin/support/csv'>
							    <i class="icon-table"></i> Export CSV
							</a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblSupportList">
						  <thead>
							  <tr>
								  <th>Issue ID</th>
								  <th>Issued On</th>
								  <th>SubCategory</th>
								  <th>Email</th>
								  <th>goLiveCard ID</th>
								  <th>Status</th>
								  <th>Priority</th>
								  <th></th>
							  </tr>
						  </thead>
						  <tbody>
						  <?php 
						      if (isset($supports)) {
						  	      foreach($supports as $k=>$v) {
						  ?>
							  	<tr>
							  		<td><?php echo $v->issue_id;?></td>
							  		<td><?php echo $v->issue_at;?></td>
							  		<td><?php echo $v->support_category_name;?></td>
							  		<td><?php echo $v->email;?></td>
							  		<td><?php echo $v->qrcode;?></td>
							  		<td><?php echo $status[$v->status];?></td>
							  		<td><?php echo $priority[$v->priority];?></td>		  									  		
							  		<td>
										<a class="btn btn-info btn-sm" href='<?php echo base_url();?>admin/support/edit/<?php echo $v->id;?>'>
											<i class="icon-edit "></i> Edit
										</a>
							  		</td>
							  	</tr>
						  	<?php
							  	    } 
								}
							?>
						  </tbody>
						</table>
						<div class="clearfix"></div>
					</div>	
				</div>	
			</div><!--/col-->
		</div><!--/row-->
	</div>
	<!-- end: Content -->
				
</div><!--/row-->	
<script src="<?php echo GENIUS_JS_PATH;?>jquery.sparkline.min.js"></script>
<script src="<?php echo GENIUS_JS_PATH;?>jquery.dataTables.min.js"></script>
<script src="<?php echo GENIUS_JS_PATH;?>dataTables.bootstrap.min.js"></script>
<script src="<?php echo HTTP_JS_PATH;?>admin/support.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>
