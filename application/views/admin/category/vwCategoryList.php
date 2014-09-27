<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li><a href="#">Default Categories</a></li>
					</ol>
				</div><!--/row-->			
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-tags"></i><span class="break"></span>List</h2>
    							<div class="pull-right areaBtnAdd">
    								<a class="btn btn-success" href='<?php echo base_url();?>admin/category/add'>
    								    <i class="icon-plus"></i> Add
    								</a>
								
    								<a class="btn btn-primary" href='<?php echo base_url();?>admin/category/csv'>
    								    <i class="icon-table"></i> Export CSV
    								</a>    								
    							</div>
							</div>
							<div class="box-content">
								<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblCategoryList">
								  <thead>
									  <tr>
										  <th>ID</th>
										  <th>Name</th>
										  <th>QR Code</th>
                                          <th>Prefilm</th>
										  <th>Cover Image</th>
										  <th></th>
									  </tr>
								  </thead>   
								  <tbody>
								  <?php 
								  if (isset($categories)) {
								  	  foreach($categories as $k=>$v) {
								  ?>
    								 <tr>
    								 	<td><?php echo $v->id;?></td>
    								 	<td><?php echo $v->name; ?></td>
    								 	<td><a href="<?php echo HTTP_QRCODE_PATH.$v->qrcode_link;?>" title="<?php echo HTTP_QRCODE_PATH.$v->qrcode_link;?>"><?php echo $v->qrcode;?></a></td>								  		
    								 	<td>
    								 	    <a href="<?php echo HTTP_VIDEO_PATH.$v->prefilm_url;?>"><?php echo $v->prefilm_url;?></a>
    								 	</td>
    								 	<td>
    								 	    <a href="<?php echo HTTP_MARKER_PATH.$v->cover_photo_url;?>" title="<?php echo HTTP_MARKER_PATH.$v->cover_photo_url;?>"><?php echo $v->cover_photo_url;?></a>
    								 	</td>
    								 	<td>
    										<a class="btn btn-info btn-sm" href='<?php echo base_url();?>admin/category/edit/<?php echo $v->id;?>'>
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
        <script src="<?php echo HTTP_JS_PATH;?>admin/category.js"></script>
<?php
$this->load->view('admin/vwFooter');
?>
