<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Buy Credits</li>
					  	<li class='active'>Add</li>
					</ol>
				</div><!--/row-->
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-money"></i><span class="break"></span>Buy Credit Add</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/buycredit/save">
    								<fieldset>
    								    <input type="hidden" name="buycredit_id" value=""/>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Offer Active</label>  
        								    <div class="col-md-5">
        								        <select class="form-control" name="is_active">
        								            <option value=0>No</option>
        								            <option value=1>Yes</option>
        								        </select>
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Offer Quantity</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="quantity" class="form-control" placeholder="Offer Quantity">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Discount %</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="discount" class="form-control" placeholder="Discount %">
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
        								            <a href="<?php echo base_url();?>admin/buycredit">Back</a>
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/buycredit.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>