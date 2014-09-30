<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Default Categories</li>
					  	<li class='active'>Edit</li>
					</ol>
				</div><!--/row-->			
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>Edit Default Categories</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>admin/category/save">
    								<fieldset>
    								    <input type="hidden" name="category_id" value='<?php echo $data->id;?>'/>
    								        								    
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Name</label>  
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" name="name" value='<?php echo $data->name;?>' placeholder="Name"/>
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">goLiveCard ID</label>  
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" readonly name="qrcode" value='<?php echo $data->qrcode;?>' placeholder="goLiveCard ID"/>
        								    </div>
        								    <span class="col-md-3" style="color: #AAA; font-size: 11px;">* goLiveCard ID</span>
        								</div>
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>  
        								    <div class="col-md-5">
        								        <img src="<?php echo HTTP_QRCODE_PATH.$data->qrcode_link;?>" style="width: 250px;"/>
        								    </div>
        								</div>
        								
        							    <div class="form-group">
        								    <label class="col-md-4 control-label">Used Counter</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->cnt;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Target Id</label>  
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" readonly name="target_id" value='<?php echo $data->target_id;?>'/>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Target Rate</label>  
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" readonly name="target_rate" value='<?php echo $data->target_rate;?>'/>
        								    </div>
        								</div>        								

        								<input type="hidden" class="form-control" name="target_type" value="1"/>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Cover Image</label>
        								    <div class="col-md-4">
        								        <input name="coverImage" class="input-file" type="file">
        								        <input name="cover_photo_url" type="hidden" value='<?php echo $data->cover_photo_url;?>'>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>
        								    <div class="col-md-4">
        								        <img src="<?php echo HTTP_MARKER_PATH.$data->cover_photo_url;?>" style="width: 100%;"/>
        								    </div>
        								</div>        								

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Prefilm Video</label>
        								    <div class="col-md-4">
        								        <input name="prefilmVideo" class="input-file" type="file">
        								        <input name="prefilm_url" type="hidden" value='<?php echo $data->prefilm_url;?>'>
        								    </div>
        								</div>
        								<div class="form-group">
        								    <label class="col-md-4 control-label">&nbsp;</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static">
        								            <a href="<?php echo HTTP_VIDEO_PATH.$data->prefilm_url;?>">
        								                <?php echo $data->prefilm_url;?>
        								            </a>
        								        </p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Position</label>
        								    <div class="col-md-5">
        								        <input type="text" class="form-control" name="position" placeholder="Position" value="<?php echo $data->position;?>"/>
        								    </div>
        								</div>        								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Icon Image</label>
        								    <div class="col-md-4">
        								        <input name="iconImage" class="input-file" type="file">
        								        <input name="icon_url" type="hidden" value='<?php echo $data->icon_url;?>'>
        								    </div>
        								</div>
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>
        								    <div class="col-md-4">
        								        <img src="<?php echo HTTP_ICON_PATH.$data->icon_url;?>" style="width: 100%;"/>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Icon Hover Image</label>
        								    <div class="col-md-4">
        								        <input name="iconHoverImage" class="input-file" type="file">
        								        <input name="icon_hover_url" type="hidden" value='<?php echo $data->icon_hover_url;?>'>
        								    </div>
        								</div>
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>
        								    <div class="col-md-4">
        								        <img src="<?php echo HTTP_ICON_PATH.$data->icon_hover_url;?>" style="width: 100%;"/>
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
        								            <a href="<?php echo base_url();?>admin/category">Back</a>
        								        </button>
        								        &nbsp;&nbsp;&nbsp;
        								        <button class="btn btn-danger">
        								            <a class="js-link" href="<?php echo base_url();?>admin/category/delete/<?php echo $data->id;?>">Delete</a>
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