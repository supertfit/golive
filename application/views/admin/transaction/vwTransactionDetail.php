<?php
$this->load->view('admin/vwHeader_v');
?>
	<div id="content" class="col-lg-10 col-sm-11 ">
		<div class="row ">
			<ol class="breadcrumb">
			  	<li>Invoices</li>
			  	<li class='active'>Detail</li>
			</ol>
		</div><!--/row-->
		<div class="row">	
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h2><i class="icon-print"></i><span class="break"></span>Invoices Detail</h2>
					</div>
					<div class="box-content">
					    <div class="form-horizontal">
							<fieldset>
								<div class="form-group">
								    <label class="col-md-4 control-label">Transaction ID</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo $data->transaction_id?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Transaction Date</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo $data->transaction_at?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Sender Email</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo $data->email?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">goLiveCard ID</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo $data->qrcode;?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label"># of Card Sent</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo $data->count_sent;?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Charge Method</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo $data->method;?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Charged Amount</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo $data->amount;?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Shipment Confirmation</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo ($data->is_ship_confirmed) ? 'Yes' : 'No';?></p>
								    </div>
								</div>
								
								<div class="form-group">
								    <label class="col-md-4 control-label">Email Confirmation</label>  
								    <div class="col-md-5">
								        <p class="form-control"><?php echo ($data->is_email_confirmed) ? 'Yes' : 'No';?></p>
								    </div>
								</div>								
			
								
								<div class="form-group">
								    <label class="col-md-4 control-label">&nbsp;</label>  
								    <div class="col-md-5">							        
								        <button class="btn btn-success">
								            <a href="<?php echo base_url();?>admin/transaction">Back</a>
								        </button>
								    </div>
								</div>        								
							</fieldset>			
							<div class="clearfix"></div>
						</div>
					</div>	
				</div>	
			</div><!--/col-->
		</div><!--/row-->
	</div>
	<!-- end: Content -->			
<?php
$this->load->view('admin/vwFooter');
?>
