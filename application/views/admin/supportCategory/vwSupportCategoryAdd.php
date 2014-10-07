<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Support Category</li>
					  	<li class='active'>Add</li>
					</ol>
				</div><!--/row-->

				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-flat"></i><span class="break"></span>Add Support Category</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/supportCategory/save">
    								<fieldset>
    								    <input type="hidden" name="support_category_id">
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Type</label>  
        								    <div class="col-md-5">
        								        <select class="form-control" name="type">
        								        <?php
        								        foreach ($type as $k => $v) {
                                                    echo "<option value='$k'>$v</option>";
                                                }
        								        ?>
        								        </select>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Name</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="name" class="form-control" placeholder="Name">
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
        								            <a href="<?php echo base_url();?>admin/supportCategory">Back</a>
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
				
		</div><!--/row-->
    <script src="<?php echo HTTP_JS_PATH;?>admin/supportCategory.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>