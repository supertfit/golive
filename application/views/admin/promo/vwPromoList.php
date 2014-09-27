<?php
$this->load->view('admin/vwHeader_v');
?>
	<!-- start: Content -->
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Promo Codes</li>
			</ol>
		</div><!--/row-->
		
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-ticket"></i><span class="break"></span>Promo List</h2>
						<div class="pull-right areaBtnAdd">
							<a class="btn btn-success" href='<?php echo base_url();?>admin/promo/add'>
							    <i class="icon-plus"></i> Add
							</a>
							<a class="btn btn-primary" href='<?php echo base_url();?>admin/promo/csv'>
							    <i class="icon-table"></i> Export CSV
							</a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblPromoList">
						  <thead>
							  <tr>
								  <th>ID</th>
								  <th>Code</th>
								  <th>Bonus</th>
								  <th>Start Date</th>
								  <th>End Date</th>
								  <th>Used On</th>
								  <th>Created On</th>
								  <th></th>
							  </tr>
						  </thead>
						  <tbody>
						  <?php 
						      if (isset($promos)) {
                                  $i = 1;
						  	      foreach($promos as $k=>$v) {
						  ?>
							  	<tr>
							  		<td><?php echo $v->id;?></td>
							  		<td>
							  		    <?php echo $v->code;?>
							  		</td>
							  		<td>
								  		<?php echo $v->bonus;?>
							  		</td>
							  		<td>
							  		    <?php echo $v->start_date;?>
							  		</td>
							  		<td>
							  		    <?php echo $v->end_date;?>
							  		</td>
							  		<td>
							  		    <?php echo $v->used_at;?>
							  		</td>
							  		<td>
							  		    <?php echo $v->created_at;?>
							  		</td>							  									  									  									  		
							  		<td>
										<a class="btn btn-info btn-sm" href='<?php echo base_url();?>admin/promo/edit/<?php echo $v->id;?>'>
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
<script src="<?php echo HTTP_JS_PATH;?>admin/promo.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>
