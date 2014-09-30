<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Default Categories</li>
					  	<li class='active'>Add</li>
					</ol>
				</div><!--/row-->			
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>Add Default Categories</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>admin/category/save">
    								<fieldset>
    								    <input type="hidden" name="category_id" value=''/>
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Name</label>
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" name="name" placeholder="Name"/>
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">goLiveCard ID</label>  
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" readonly name="qrcode" placeholder="goLiveCard ID" value="<?php echo $qrcode;?>"/>
        								    </div>
        								    <span class="col-md-3" style="color: #AAA; font-size: 11px;">* goLiveCard ID</span>
        								</div>

        								<input type="hidden" class="form-control" name="target_type" value="1"/>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Cover Image</label>
        								    <div class="col-md-4">
        								        <input name="coverImage" class="input-file" type="file">
        								        <input name="cover_photo_link" type="hidden">
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Prefilm Video</label>
        								    <div class="col-md-4">
        								        <input name="prefilmVideo" class="input-file" type="file">
        								        <input name="video_url" type="hidden">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Position</label>
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" name="position" placeholder="Position"/>
        								    </div>
        								</div>        								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Icon Image</label>
        								    <div class="col-md-4">
        								        <input name="iconImage" class="input-file" type="file">
        								        <input name="icon_url" type="hidden">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Icon Hover Image</label>
        								    <div class="col-md-4">
        								        <input name="iconHoverImage" class="input-file" type="file">
        								        <input name="icon_hover_url" type="hidden">
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
        								            <a href="<?php echo base_url();?>admin/category">Back</a>
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/category.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>