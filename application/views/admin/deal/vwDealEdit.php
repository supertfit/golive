<?php
$this->load->view('admin/vwHeader_v');
?>
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Deals</li>
			  	<li class='active'>Edit</li>
			</ol>
		</div><!--/row-->
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-rocket"></i><span class="break"></span>Deal Edit</h2>
					</div>
					<div class="box-content">
					    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/deal/save">
							<fieldset>
                                <input type="hidden" name="deal_id" value="<?php echo $data->id?>"/>
								<div class="form-group">
								    <label class="col-md-4 control-label">Type</label>  
								    <div class="col-md-5">
								        <select class="form-control" name="type" id="type">
								            <option value="0">Please Select Deal Type.</option>
    								        <?php foreach ($arr_deal_type as $key => $value) { ?>
								            <option value="<?php echo $key?>" <?php echo ($key == $data->type) ? 'selected' : ''; ?>><?php echo $value?></option>
								            <?php } ?>
							            </select>
							        </div>
							    </div>
							    
								<div class="form-group">
								    <label class="col-md-4 control-label">Deal Reach</label>  
								    <div class="col-md-5">
								        <select class="form-control" name="is_reach">
								            <option value="1" <?php echo ($data->is_reach)? 'selected' : '';?>>Yes</option>
								            <option value="0" <?php echo ($data->is_reach)? '' : 'selected';?>>No</option>
								        </select>
								    </div>
								</div>							    

								<div class="form-group">
								    <label class="col-md-4 control-label">Name</label>  
								    <div class="col-md-5">
								        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $data->name;?>">
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Deal Amount</label>  
								    <div class="col-md-5">
								        <input type="text" name="amount" class="form-control" placeholder="Amount" value="<?php echo $data->amount;?>">
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">List Quantity</label>  
								    <div class="col-md-5">
								        <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="<?php echo $data->quantity;?>">
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">List Price</label>  
								    <div class="col-md-5">
								        <input type="text" name="price" class="form-control" placeholder="Price" value="<?php echo $data->price;?>">
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Start Date</label>  
								    <div class="col-md-5">
								        <input type="text" name="start_date" class="form-control" placeholder="Start Date" value="<?php echo $data->start_date;?>">
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">End Date</label>  
								    <div class="col-md-5">
								        <input type="text" name="end_date" class="form-control" placeholder="End Date" value="<?php echo $data->end_date;?>">
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
								        <button class="btn btn-info">
								            <a href="<?php echo base_url();?>admin/deal/usage/<?php echo $data->id;?>">Track</a>
								        </button>
								        &nbsp;&nbsp;&nbsp;								        
								        <button class="btn btn-success">
								            <a href="<?php echo base_url();?>admin/deal">Back</a>
								        </button>
								        &nbsp;&nbsp;&nbsp;
								        <button class="btn btn-danger">
								            <a class="js-link" href="<?php echo base_url();?>admin/deal/delete/<?php echo $data->id;?>">Delete</a>
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
<script src="<?php echo HTTP_JS_PATH;?>admin/deal.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>