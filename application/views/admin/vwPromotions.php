<?php
/********************************************************************************************
 * Page				:
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: vwPromotions.php
 * Description		: 
 * Date				: Aug 12, 2014 5:24:19 PM
 * Version			: 1.0
 ********************************************************************************************/
 ?>
 <?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li><a href="#">Users</a></li>
					  	<li class='active'><a href="#">UserList</a></li>
					</ol>
	
				</div><!--/row-->
				
				<div class="row">	
					<div class="col-lg-12">
					<div class="box">
						<div class="box-header" data-original-title>
							<h2><i class="icon-edit"></i><span class="break"></span>Promotions</h2>
							<div class="box-icon">
								<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
								<a href="#" class="btn-close"><i class="icon-remove"></i></a>
							</div>
						</div>
						<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
							  <thead>
								  <tr>
									  <th>#</th>
									  <th>Title</th>
									  <th>Actions</th>
								  </tr>
							  </thead>   
							  <tbody>
							  <?php
					          if (isset($promotions) ) {
					          	$i = 1;
					          	foreach($promotions as $row=>$col) {  
					          ?>
								<tr>
									<td><?php echo $i;?></td>
									<td><a href='<?php echo base_url();?>admin/promotions/go_editpromotion/<?php echo $col->id;?>' title="Edit"><?php echo $col->title;?></a></td>
									<td>
										<a class="btn btn-danger" href='<?php echo base_url();?>admin/promotions/delete_promotion/<?php echo $col->id;?>'>
											<i class="icon-trash "></i> 
										</a>
									</td>
								</tr>
								<?php
						            $i ++;
						          	}
						          } else {?>
						          	<tr>
						          		<td>
						          			There is no user.
						          		</td>
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
		<script src="<?php echo GENIUS_JS_PATH;?>pages/table.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>