<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Promo Codes</li>
					  	<li class='active'>Add</li>
					</ol>
				</div><!--/row-->
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-ticket"></i><span class="break"></span>Promo Add</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/promo/save">
    								<fieldset>
    								    <input type="hidden" name="promo_id" value=""/>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Code</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="code" readonly class="form-control" placeholder="Code" value="<?php echo $promo_code;?>">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Bonus</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="bonus" class="form-control" placeholder="Bonus">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Start Date</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="start_date" class="form-control" placeholder="Start Date">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">End Date</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="end_date" class="form-control" placeholder="End Date">
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/promo.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>