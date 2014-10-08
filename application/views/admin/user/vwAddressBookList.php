<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Address Book</li>
					</ol>
				</div><!--/row-->
				
				<div class="row">	
					<div class="col-lg-12">
					<div class="box">
						<div class="box-header" data-original-title>
							<h2><i class="icon-user"></i><span class="break"></span>Address Book List</h2>
							<div class="pull-right areaBtnAdd">
								<a class="btn btn-primary" href='<?php echo base_url();?>admin/users/csv_address_book/<?php echo $user_id;?>'>
								    <i class="icon-table"></i> Export CSV
								</a>
							</div>
						</div>
						<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblUserList">
							  <thead>
								  <tr>
									  <th>Name</th>
									  <th>Address</th>
									  <th>City</th>
									  <th>State</th>
									  <th>Country</th>
									  <th>Postal Code</th>
								  </tr>
							  </thead>
							  <tbody>
							  <?php
					          if (isset($addressBooks) ) {
					          	foreach($addressBooks as $row=>$col) {  
					          ?>
								<tr>
								    <td><?php echo $col->fullname;?></td>
									<td><?php echo $col->address;?></td>
									<td><?php echo $col->city;?></td>
									<td><?php echo $col->state;?></td>
									<td><?php echo $col->country;?></td>
									<td><?php echo $col->postal_code;?></td>
								</tr>
								<?php
						          	}
						        }?>
							  </tbody>
						  </table>            
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
		<script src="<?php echo HTTP_JS_PATH;?>admin/user.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>