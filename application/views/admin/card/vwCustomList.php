<?php
$this->load->view('admin/vwHeader_v');
?>
	<!-- start: Content -->
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Custom Cards</li>
			</ol>
		</div><!--/row-->
		
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-picture"></i><span class="break"></span>List</h2>
						<div class="pull-right areaBtnAdd">
							<a class="btn btn-primary" href='<?php echo base_url();?>admin/customCard/csv'>
							    <i class="icon-table"></i> Export CSV
							</a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblCustomCardList">
						  <thead>
							  <tr>
								  <th>ID</th>
								  <th>goLiveCard ID</th>
								  <th>Target Id</th>
								  <th>Sender Name</th>
								  <th>Sender Email</th>
								  <th>Created On</th>
								  <th></th>
							  </tr>
						  </thead>
						  <tbody>
						  <?php 
						      if (isset($cards)) {
                                  $i = 1;
						  	      foreach($cards as $k=>$v) {
						  ?>
							  	<tr>
							  		<td><?php echo $v->id;?></td>
							  		<td>
							  		    <a style="text-decoration: underline;" href="<?php echo HTTP_QRCODE_PATH.$v->qrcode_link;?>"><?php echo $v->qrcode;?></a>
							  		</td>
							  		<td>
							  		    <?php echo $v->target_id;?>
							  		</td>
							  		<td><?php echo $v->first_name." ".$v->last_name;?></td>
							  		<td><?php echo $v->email;?></td>
							  		<td><?php echo $v->created_at;?></td>
							  		<td>
										<a class="btn btn-info btn-sm" href='<?php echo base_url();?>admin/customCard/edit/<?php echo $v->id;?>'>
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
<script src="<?php echo HTTP_JS_PATH;?>admin/card.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>
