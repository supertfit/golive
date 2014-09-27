<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Deal Management</li>
					</ol>
				</div><!--/row-->
				
				<div class="row">	
					<div class="col-lg-12">
					<div class="box">
						<div class="box-header" data-original-title>
							<h2><i class="icon-user"></i><span class="break"></span>Deal User List</h2>
							<div class="pull-right areaBtnAdd">								
								<!-- a class="btn btn-primary" href='<?php echo base_url();?>admin/users/csv'>
								    <i class="icon-table"></i> Export CSV
								</a -->								
							</div>
						</div>
						<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblUserList">
							  <thead>
								  <tr>
									  <th>ID</th>
									  <th>Name</th>
									  <th>Email</th>
									  <th>Admin</th>
									  <th>Status</th>
									  <th>Created At</th>
									  <th></th>
								  </tr>
							  </thead>
							  <tbody>
							  <?php
					          if (isset($users) ) {
					          	$i = 1;
					          	foreach($users as $row=>$col) {  
					          ?>
								<tr>
								    <td><?php echo $col->id;?></td>
									<td><?php echo $col->first_name." ".$col->last_name;?></td>
									<td><?php echo $col->email;?></td>
									<td><?php echo $col->is_admin ? 'Yes' : 'No';?></td>
									<td><?php echo $col->is_active ? 'Yes' : 'No';?></td>
									<td><?php echo $col->created_at;?></td>
									<td></td>
								</tr>
								<?php
						            $i ++;
						          	}
						          } else {?>
						          	<tr>
						          		<td></td>
						          		<td>There is no Deal Users.</td>
						          		<td></td>
						          		<td></td>
						          		<td></td>
						          		<td></td>
						          		<td></td>
						            </tr>
						          <?php }?>
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