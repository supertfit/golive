<?php
/*
 * Created on Aug 8, 2014
 *
 * File Name	: vwActivateUser.php
 * Created By	: KCH
 */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="goLive - Activate User">
    <meta name="author" content="goLive">
    <title>Activate User</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo HTTP_CSS_PATH; ?>signin.css" rel="stylesheet">
    
    <script src="<?php echo HTTP_JS_PATH; ?>jquery.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>custom/jquery.form.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>wsapis/activate_user" id="submitForm">
        	<h4 class="form-signin-heading">Please enter your activation code.</h4><h6>( You can get it from your email inbox. )</h6>
        	<br>
        	<input type="text" class="form-control" placeholder="Activation Code" name="activecode" autofocus>
        	<br>
	        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="OnActivateBtnClick();">Activate</button>
      	</form>
    </div> <!-- /container -->
    <script type="text/javascript">
    	function OnActivateBtnClick() {
    		$("#submitForm").ajaxSubmit({
    			success: function (data) {
    				var result = JSON.parse(data);
    				if (result.result == "success") {
						alert ("Activated successfully.\nPlease try to login with your app.");
						location.href = "<?php echo base_url();?>";					
    				} else {
    					alert ( result.error );
    				}
    				
    			},
    			error: function () {
    				alert ("Failed to activate your code. Please try it again.");
    			}
    		});
    	}
    </script>
  </body>
</html>