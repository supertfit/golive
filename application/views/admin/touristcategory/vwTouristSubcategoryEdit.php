<?php
$this->load->view('admin/vwHeader_v');
?>
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Sub Category</li>
			  	<li class='active'>Edit</li>
			</ol>
		</div><!--/row-->
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-rocket"></i><span class="break"></span>Category Edit</h2>
					</div>
					<div class="box-content">
					    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/touristcategory/sub_save">
							<fieldset>
							    <input type="hidden" name="category_id" value="<?php echo $cid;?>"/>
							    <input type="hidden" name="sub_category_id" value="<?php echo $data->id;?>"/>

								<div class="form-group">
								    <label class="col-md-4 control-label">Name</label>  
								    <div class="col-md-5">
								        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $data->name;?>">
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
								            <a href="<?php echo base_url();?>admin/touristcategory/edit/<?php echo $cid;?>">Back</a>
								        </button>
								        &nbsp;&nbsp;&nbsp;
								        <button class="btn btn-danger">
								            <a class="js-link" href="<?php echo base_url();?>admin/touristcategory/sub_delete/<?php echo $data->id;?>">Delete</a>
								        </button>
								    </div>
								</div>        								
							</fieldset>			
							<div class="clearfix"></div>
						</form>
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