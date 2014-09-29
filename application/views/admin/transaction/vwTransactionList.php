<?php
$this->load->view('admin/vwHeader_v');
?>
	<!-- start: Content -->
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Transactions</li>
			</ol>
		</div><!--/row-->
		
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-print"></i><span class="break"></span>Transaction List</h2>
						<div class="pull-right areaBtnAdd">
							<a class="btn btn-primary" href='<?php echo base_url();?>admin/transaction/csv'>
							    <i class="icon-table"></i> Export CSV
							</a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblTransactionList">
						  <thead>
							  <tr>
								  <th>Transaction ID</th>
								  <th>Sender Email</th>
								  <th>goLiveCard ID</th>
								  <th>Card Sent</th>
								  <th>Charged Amount</th>
								  <th></th>
							  </tr>
						  </thead>
						  <tbody>
						  <?php 
						      if (isset($transactions)) {
                                  $i = 1;
						  	      foreach($transactions as $k=>$v) {
						  ?>
							  	<tr>
							  		<td><?php echo $v->transaction_id;?></td>
							  		<td><?php echo $v->email;?></td>
							  		<td><?php echo $v->qrcode;?></td>
							  		<td><?php echo $v->count_sent;?></td>
							  		<td><?php echo $v->amount;?></td>
							  		<td>
										<a class="btn btn-info btn-sm" href='<?php echo base_url();?>admin/transaction/detail/<?php echo $v->id;?>'>
											<i class="icon-edit"></i> Detail
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
<script src="<?php echo HTTP_JS_PATH;?>admin/transaction.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>
