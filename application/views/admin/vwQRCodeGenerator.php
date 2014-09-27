<?php
/********************************************************************************************
 * Page				:
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: vwQRCodeGenerator.php
 * Description		: 
 * Date				: Aug 21, 2014 2:28:10 AM
 * Version			: 1.0
 ********************************************************************************************/
$this->load->view('admin/vwHeader_v');
?>

<script type="text/javascript" src="<?php echo HTTP_JS_PATH?>jquery.form.js"></script>	
<script type="text/javascript">
function onClickSubmit () {
	$("img#imgQRCode").hide();
	$("#formQRGenerator").ajaxSubmit({
		success: function( data ) {
			var result = JSON.parse(data);
			if (result.result == 'failed') {
				alert (result.error);
				return;
			} else {
				$("img#imgQRCode").attr('src', "<?php echo HTTP_QRCODE_PATH;?>" + result.filename);
				$("img#imgQRCode").show();
			}
		}
	});
}
</script>
<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li><a href="#">QR Code Genrator</a></li>
					</ol>
	
				</div><!--/row-->
				
				<div class="row">	
					<div class="col-lg-6">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>QR Code Genrator</h2>
							</div>
							<div class="box-content">
								<form class="form-horizontal" id="formQRGenerator" method="post" action="<?php echo base_url();?>qrgenerator/index.php">
								<fieldset>
								
								<!-- Form Name -->
								<legend>Generator</legend>
								
								<!-- Text input-->
								<div class="control-group">
								  <label class="control-label col-md-2" for="data">Data</label>
								  <div class="controls col-md-10">
								    <input id="sdata" name="sdata" placeholder="Data" class="form-control" required="" type="text">
								    <p class="help-block">Input alphabetic letters </p>
								  </div>
								</div>
								<!-- Button -->
								<div class="control-group">
								  <label class="control-label" for="submit"></label>
								  <div class="controls">
								    <div id="submitButton" class="btn btn-success" onclick="onClickSubmit();">Generate</div>
								  </div>
								</div>
								
								</fieldset>
								</form>
								<div style="text-align: center;width: 100%">
									<img src="" id="imgQRCode" style="display: none; width: 235px;" >
								</div>							
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