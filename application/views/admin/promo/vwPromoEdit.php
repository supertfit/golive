<?php
$this->load->view('admin/vwHeader_v');
?>
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Promo Codes</li>
			  	<li class='active'>Edit</li>
			</ol>
		</div><!--/row-->
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-ticket"></i><span class="break"></span>Promo Edit</h2>
					</div>
					<div class="box-content">
					    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/promo/save">
							<fieldset>
                                <input type="hidden" name="promo_id" value="<?php echo $data->id?>"/>

								<div class="form-group">
								    <label class="col-md-4 control-label">Code</label>  
								    <div class="col-md-5">
								        <input type="text" readonly name="code" class="form-control" placeholder="Code" value="<?php echo $data->code;?>">
								    </div>
								</div>

								<div class="form-group">
								    <label class="col-md-4 control-label">Bonus</label>  
								    <div class="col-md-5">
								        <input type="text" name="bonus" class="form-control" placeholder="Bonus" value="<?php echo $data->bonus;?>">
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
								    <label class="col-md-4 control-label">Used By</label>  
								    <div class="col-md-5">
								        <p class="form-control-static"><?php echo $data->email;?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Used On</label>  
								    <div class="col-md-5">
								        <p class="form-control-static"><?php echo $data->used_at;?></p>
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
								            <a href="<?php echo base_url();?>admin/promo">Back</a>
								        </button>
								        &nbsp;&nbsp;&nbsp;
								        <button class="btn btn-danger">
								            <a class="js-link" href="<?php echo base_url();?>admin/promo/delete/<?php echo $data->id;?>">Delete</a>
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