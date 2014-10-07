<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11">
				<div class="row">
					<ol class="breadcrumb">
					  	<li>Support</li>
					  	<li class='active'>Edit</li>
					</ol>
				</div><!--/row-->

				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-comment"></i><span class="break"></span>Edit Support</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/support/save">
    								<fieldset>
    								    <input type="hidden" name="support_id" value="<?php echo $data->id;?>">
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Issue ID</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->issue_id;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Category</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->support_category_type;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Sub Category</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->support_category_name;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Issued On</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->issue_at;?></p>
        								    </div>
        								</div>        								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">User E-mail</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->email;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Note</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->note;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">QR Code</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->qrcode;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Status</label>  
        								    <div class="col-md-5">
        								        <select class="form-control" name="status">
        								            <?php foreach ($status as $k => $v) {?>
        								                <option value="<?php echo $k;?>" <?php echo ($k == $data->status) ? 'selected' : '';?>><?php echo $v;?></option>
        								            <?php } ?>
        								        </select>
        								    </div>
        								</div>        		
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Priority</label>  
        								    <div class="col-md-5">
        								        <select class="form-control" name="priority">
        								            <?php foreach ($priority as $k => $v) {?>
        								                <option value="<?php echo $k;?>" <?php echo ($k == $data->priority) ? 'selected' : '';?>><?php echo $v;?></option>
        								            <?php } ?>
        								        </select>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Device</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->device;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">OS Version</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->os_version;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Payment Method</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->payment_method;?></p>
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
        								            <a href="<?php echo base_url();?>admin/support">Back</a>
        								        </button>
        								        &nbsp;&nbsp;&nbsp;
        								        <button class="btn btn-danger">
        								            <a class="js-link" href="<?php echo base_url();?>admin/support/delete/<?php echo $data->id;?>">Delete</a>
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/support.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>