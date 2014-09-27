<?php
$this->load->view('admin/vwHeader_v');
?>
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Franchise Category</li>
			  	<li class='active'>Edit</li>
			</ol>
		</div><!--/row-->
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-rocket"></i><span class="break"></span>Franchise Category Edit</h2>
					</div>
					<div class="box-content">
					    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/touristcategory/save">
							<fieldset>
                                <input type="hidden" name="category_id" value="<?php echo $data->id?>"/>

								<div class="form-group">
								    <label class="col-md-4 control-label">Name</label>  
								    <div class="col-md-5">
								        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $data->name;?>">
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Count</label>  
								    <div class="col-md-5">
								        <p class="form-control-static"><?php echo $data->cnt;?></p>
								    </div>
								</div>								
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Created On</label>  
								    <div class="col-md-5">
								        <p class="form-control-static"><?php echo $data->created_at;?></p>
								    </div>
								</div>								
								
								<div class="form-group">
								    <label class="col-md-4 control-label">&nbsp;</label>  
								    <div class="col-md-5">
								        <button class="btn btn-primary" type="submit" onclick='return onValidate();'>
								            Save
								        </button>
								        &nbsp;&nbsp;&nbsp;
								        <button class="btn btn-success">
								            <a href="<?php echo base_url();?>admin/touristcategory">Back</a>
								        </button>
								        &nbsp;&nbsp;&nbsp;
								        <button class="btn btn-danger">
								            <a class="js-link" href="<?php echo base_url();?>admin/touristcategory/delete/<?php echo $data->id;?>">Delete</a>
								        </button>
								    </div>
								</div>        								
							</fieldset>			
							<div class="clearfix"></div>
						</form>
						<hr/>
						
                    <div class="box">
    					<div class="box-header">
    						<h2><i class="icon-rocket"></i><span class="break"></span>Sub Category List</h2>
    						<div class="pull-right areaBtnAdd">
    							<a class="btn btn-success" href='<?php echo base_url();?>admin/touristcategory/sub_add/<?php echo $data->id?>'>
    							    <i class="icon-plus"></i> Add
    							</a>
    							<!-- a class="btn btn-primary" href='<?php echo base_url();?>admin/touristcategory/sub_csv/<?php echo $data->id?>'>
    							    <i class="icon-table"></i> Export CSV
    							</a -->
    						</div>
    					</div>
    					
    					<div class="box-content">
    						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tblTourstcategoryList">
    						  <thead>
    							  <tr>
    								  <th>ID</th>
    								  <th>Name</th>
    								  <th>Created On</th>
    								  <th></th>
    							  </tr>
    						  </thead>
    						  <tbody>
    						  <?php 
    						      if (isset($subcategories)) {
                                      $i = 1;
    						  	      foreach($subcategories as $k=>$v) {
    						  ?>
    							  	<tr>
    							  		<td><?php echo $v->id;?></td>
    							  		<td>
    							  		    <?php echo $v->name;?>
    							  		</td>
    							  		<td>
    								  		<?php echo $v->created_at;?>
    							  		</td>		  									  		
    							  		<td>
    										<a class="btn btn-info btn-sm" href='<?php echo base_url();?>admin/touristcategory/sub_edit/<?php echo $v->id;?>'>
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
						
						
					</div>	
				</div>	
			</div><!--/col-->
		</div><!--/row-->
	</div>
	<!-- end: Content -->
<script src="<?php echo HTTP_JS_PATH;?>admin/touristcategory.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>