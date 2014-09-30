<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Franchise Card</li>
					  	<li class='active'>Add</li>
					</ol>
				</div><!--/row-->
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-bar-chart"></i><span class="break"></span>Franchise Card Add</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>admin/touristCard/save">
    								<fieldset>
    								    <input type="hidden" name="card_id" value=""/>    	
    								    
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Category</label>
        								    <div class="col-md-5">
        								        <select class="form-control" name="category_id" id="tourist_category_id">
        								            <option value="">Select the category.</option>
        								            <?php foreach($category as $item) { ?>
        								            <option value="<?php echo $item->id?>"><?php echo $item->name?></option>
        								            <?php } ?>
        								            
        								        </select>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Subcategory</label>
        								    <div class="col-md-5">
        								        <select class="form-control" name="sub_category_id" id="tourist_subcategory_id">
        								            <option value="">Select the subcategory.</option>
        								        </select>
        								    </div>
        								</div>        															    								    							    

        								<div class="form-group">
        								    <label class="col-md-4 control-label">goLiveCard ID</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="qrcode" class="form-control" readonly value='<?php echo $qrcode;?>'>
        								    </div>
        								    <span class="col-md-3" style="color: #AAA; font-size: 11px;padding-top: 7px;">* goLiveCard ID</span>
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
        								    <label class="col-md-4 control-label">&nbsp;</label>
        								    <div class="col-md-5">
        								        <button class="btn btn-primary" type="submit" onclick='return onValidate();'>
        								            Save
        								        </button>
        								        &nbsp;&nbsp;&nbsp;
        								        <button class="btn btn-success">
        								            <a href="<?php echo base_url();?>admin/touristCard">Back</a>
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