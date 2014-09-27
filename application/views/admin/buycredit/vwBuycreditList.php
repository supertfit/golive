<?php
$this->load->view('admin/vwHeader_v');
?>
	<!-- start: Content -->
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Buy Credits</li>
			</ol>
		</div><!--/row-->
		
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-money"></i><span class="break"></span>Buy Credits List</h2>
						<div class="pull-right areaBtnAdd">
							<a class="btn btn-success" href='<?php echo base_url();?>admin/buycredit/add'>
							    <i class="icon-plus"></i> Add
							</a>
							<a class="btn btn-primary" href='<?php echo base_url();?>admin/buycredit/csv'>
							    <i class="icon-table"></i> Export CSV
							</a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblBuycreditList">
						  <thead>
							  <tr>
								  <th>ID</th>
								  <th>Offer Reach</th>
								  <th>Offer Quantity</th>
								  <th>Discount %</th>
								  <th>Discount Value</th>
								  <th>Final Price</th>
								  <th>Created On</th>
								  <th></th>
							  </tr>
						  </thead>
						  <tbody>
						  <?php 
						      if (isset($buycredits)) {
                                  $i = 1;
						  	      foreach($buycredits as $k=>$v) {
						  ?>
							  	<tr>
							  		<td><?php echo $v->id;?></td>
							  		<td>
							  		    <?php echo ($v->is_active) ? 'Yes' : 'No';?>
							  		</td>
							  		<td>
								  		<?php echo $v->quantity;?>
							  		</td>
							  		<td>
							  		    <?php echo $v->discount;?>
							  		</td>
							  		<td>
							  		    <?php echo $v->quantity * CREDITS_PRICE * $v->discount / 100;?>
							  		</td>
							  		<td>
							  		    <?php echo $v->quantity * CREDITS_PRICE * (100 - $v->discount ) / 100;?>
							  		</td>							  									  		
							  		<td>
							  		    <?php echo $v->created_at;?>
							  		</td>							  									  		
							  		<td>
										<a class="btn btn-info btn-sm" href='<?php echo base_url();?>admin/buycredit/edit/<?php echo $v->id;?>'>
											<i class="icon-edit "></i> Edit
										</a>
							  		</td>
							  	</tr>
						  	<?php
							  	    $i++;
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
<script src="<?php echo HTTP_JS_PATH;?>admin/buycredit.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>
