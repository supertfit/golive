<?php
/********************************************************************************************
 * Page				: 
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: vwAddTouristCard.php
 * Description		: 
 * Date				: Sep 1, 2014 3:39:13 PM
 * Version			: 1.0
 ********************************************************************************************/
 
?>
<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>Add New Tourist Card</h2>
							</div>
							<div class="box-content">
								<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>wsapis/wsAddNewTouristCard">
									<fieldset>
									
									<!-- File Button --> 
									<div class="form-group">
									  <label class="col-md-4 control-label" for="coverPhoto">Cover Image</label>
									  <div class="col-md-4">
									    <input id="coverImage" name="coverImage" class="input-file" type="file">
									  </div>
									</div>
									
									<!-- File Button --> 
									<div class="form-group">
									  <label class="col-md-4 control-label" for="videoFile">Pre-Filmed Video</label>
									  <div class="col-md-4">
									    <input id="videoFile" name="videoFile" class="input-file" type="file">
									  </div>
									</div>
									
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="note">Note</label>  
									  <div class="col-md-5">
									  <input id="note" name="note" type="text" placeholder="Note" class="form-control input-md" required="">
									  </div>
									</div>
									
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="postalAddress">Postal Address</label>  
									  <div class="col-md-5">
									  <input id="postalAddress" name="postalAddress" type="text" placeholder="Postal Address" class="form-control input-md" required="">
									  </div>
									</div>
									
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="postalCode">Postal Code</label>  
									  <div class="col-md-5">
									  <input id="postalCode" name="postalCode" type="text" placeholder="Postal Code" class="form-control input-md" required="">
									  </div>
									</div>
									
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="receiptCity">Receipt City</label>  
									  <div class="col-md-5">
									  <input id="receiptCity" name="receiptCity" type="text" placeholder="Receipt City" class="form-control input-md" required="">
									  </div>
									</div>
									
									<!-- Text input-->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="receiptCountry">Receipt Country</label>  
									  <div class="col-md-5">
									  <input id="receiptCountry" name="receiptCountry" type="text" placeholder="Receipt Country " class="form-control input-md" required="">
									  </div>
									</div>
									
									<!-- Button -->
									<div class="form-group">
									  <label class="col-md-4 control-label" for="btnSubmit">Submit</label>
									  <div class="col-md-4">
									    <button id="btnSubmit" name="btnSubmit" class="btn btn-success">Add New</button>
									  </div>
									</div>
									<input type="hidden" value="1" name="cardType">
									</fieldset>
								</form>
																	
								<div class="clearfix"></div>
							</div>	
						</div>	
					</div><!--/col-->
				</div><!--/row-->
			</div>
			<!-- end: Content -->
				
		</div><!--/row-->	
<?php
$this->load->view('admin/vwFooter');
?>