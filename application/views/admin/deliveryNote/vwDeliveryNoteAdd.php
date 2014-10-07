<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>Delivery Note</li>
					  	<li class='active'>Add</li>
					</ol>
				</div><!--/row-->

				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-flat"></i><span class="break"></span>Add Delivery Note</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/deliveryNote/save">
    								<fieldset>
    								    <input type="hidden" name="delivery_note_id">
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Country</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="country" class="form-control" placeholder="Country">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Note</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="note" class="form-control" placeholder="Note">
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
        								            <a href="<?php echo base_url();?>admin/deliveryNote">Back</a>
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/deliveryNote.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>