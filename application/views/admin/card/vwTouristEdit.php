<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Franchise Card</li>
					  	<li class='active'>Edit</li>
					</ol>
				</div><!--/row-->			
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-bar-chart"></i><span class="break"></span>Edit Franchise Card</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>admin/touristCard/save">
    								<fieldset>
    								    <input type="hidden" name="card_id" value='<?php echo $data->id;?>'/>
    								        								    
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Category</label>
        								    <div class="col-md-5">
        								        <select class="form-control" name="category_id" id="tourist_category_id">
        								            <option value="">Select the category.</option>
        								            <?php foreach($category as $item) { ?>
        								            <option value="<?php echo $item->id?>" <?php echo ($item->id == $data->tourist_category_id) ? ' selected' : '';?>><?php echo $item->name?></option>
        								            <?php } ?>
        								            
        								        </select>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Subcategory</label>
        								    <div class="col-md-5">
        								        <select class="form-control" name="sub_category_id" id="tourist_subcategory_id">
        								            <option value="">Select the subcategory.</option>
        								            <?php foreach($subcategory as $item) { ?>
        								            <option value="<?php echo $item->id?>" <?php echo ($item->id == $data->tourist_subcategory_id) ? ' selected' : '';?>><?php echo $item->name?></option>
        								            <?php } ?>
        								        </select>
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
        								            Download : 
        								            <a href="<?php echo HTTP_VIDEO_PATH.$data->prefilm_url;?>">
        								                <?php echo $data->prefilm_url;?>
        								            </a>
        								        </p>
        								    </div>
        								</div>
        								
        								<?php if ($data->played_at != '') {?>
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Played On</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->played_at;?></p>
        								    </div>
        								</div>
        								<?php } ?>        								
        								
        								<?php if ($data->assigned_at != '') {?>
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Video</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static">
        								            Download : 
        								            <a href="<?php echo HTTP_VIDEO_PATH.$data->video_url;?>">
        								                <?php echo $data->video_url;?>
        								            </a>
        								        </p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Added On</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->assigned_at;?></p>
        								    </div>
        								</div>        								        								
                                        <?php } ?>
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
        								            <a href="<?php echo base_url();?>admin/touristCard">Back</a>
        								        </button>
        								        &nbsp;&nbsp;&nbsp;
        								        <button class="btn btn-danger">
        								            <a class="js-link" href="<?php echo base_url();?>admin/touristCard/delete/<?php echo $data->id;?>">Delete</a>
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/card.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>