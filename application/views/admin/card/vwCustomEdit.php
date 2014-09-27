<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Custom Card</li>
					  	<li class='active'>Edit</li>
					</ol>
				</div><!--/row-->
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>Custom Card Edit</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>admin/customCard/save">
    								<fieldset>
    								    <input type="hidden" name="card_id" value="<?php echo $data->id?>"/> 								        								    

        								<div class="form-group">
        								    <label class="col-md-4 control-label">QR Code</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->qrcode;?></p>
        								    </div>
        								    <span class="col-md-3" style="color: #AAA; font-size: 11px;padding-top: 7px;">* goLiveCard ID</span>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>  
        								    <div class="col-md-5">
        								        <img src="<?php echo HTTP_QRCODE_PATH.$data->qrcode_link;?>" style="width: 250px; height: 250px;"/>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Postal Address</label>  
        								    <div class="col-md-5">
        								    <input type="text" name="postal_address" class="form-control" value="<?php echo $data->postal_address;?>">
        								    </div>
        								</div>        								

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Postal Code</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="postal_code" class="form-control" value="<?php echo $data->postal_code;?>">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Receipt City</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="receipt_city" class="form-control" value="<?php echo $data->receipt_city;?>">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Receipt State</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="receipt_state" class="form-control" value="<?php echo $data->receipt_state;?>">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Receipt Country</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="receipt_country" class="form-control" value="<?php echo $data->receipt_country;?>">
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Note</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="note" class="form-control" value="<?php echo $data->note;?>">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Target Id</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->target_id;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Target Rate</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->target_rate;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Target Type</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $arr_target_type[$data->target_type];?></p>
        								    </div>
        								</div>
        								
        								<!-- div class="form-group">
        								    <label class="col-md-4 control-label">Metadata</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->metadata;?></p>
        								    </div>
        								</div -->

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Cover Image</label>
        								    <div class="col-md-4">
        								        <input name="coverImage" class="input-file" type="file">
        								        <input name="cover_photo_url" type="hidden" value='<?php echo $data->cover_photo_url;?>'>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>  
        								    <div class="col-md-5">
        								        <img src="<?php echo HTTP_MARKER_PATH.$data->cover_photo_url;?>" style="width: 100%;"/>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static">
        								            Download : 
        								            <a href="<?php echo HTTP_MARKER_PATH.$data->cover_photo_url;?>">
        								                <?php echo $data->cover_photo_url;?>
        								            </a>
        								        </p>
        								    </div>
        								</div>        								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Video</label>  
        								    <div class="col-md-5">
        								        <input name="uploadVideo" class="input-file" type="file">
        								        <input name="video_url" type="hidden" value='<?php echo $data->video_url;?>'>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label"></label>  
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
        								    <label class="col-md-4 control-label">Sender Name</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->first_name." ".$data->last_name;?></p>
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Sender Email</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->email;?></p>
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
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Created On</label>  
        								    <div class="col-md-5">
        								        <p class="form-control"><?php echo $data->created_at;?></p>
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">&nbsp;</label>  
        								    <div class="col-md-5">
        								        <button class="btn btn-primary" type="submit" onclick='return onConfirm();'>
        								            Save
        								        </button>
        								        &nbsp;&nbsp;&nbsp;        								    
        								        <button class="btn btn-success">
        								            <a href="<?php echo base_url();?>admin/customCard">Back</a>
        								        </button>
        								        &nbsp;&nbsp;&nbsp;
        								        <button class="btn btn-danger">
        								            <a class="js-link" href="<?php echo base_url();?>admin/customCard/delete/<?php echo $data->id;?>">Delete</a>
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/card.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>