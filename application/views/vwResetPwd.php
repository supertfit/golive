<?php
/*
 * Created on Aug 8, 2014
 *
 * File Name	: vwResetPwd.php
 * Created By	: KCH
 */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reset Password</title>
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
	<?php echo $str_activecode;?>
    <div class="container">
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>wsapis/wsResetPwd" id="submitForm">
	        <h2 class="form-signin-heading">Please sign in</h2>
	        <input type="text" class="form-control" placeholder="New Password" name="password" id="txtPwd" autofocus>
	        <input type="password" class="form-control" placeholder="Confirm Password" name="confpassword" id="txtConfPwd">
			        
	        <div class="btn btn-lg btn-primary btn-block" onclick="OnSubmitForm();">Submit</div>
      </form>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    
    <script type="text/javascript">
    	function OnSubmitForm() {
    		var str_pwd = $("#txtPwd").val();
    		var str_confpwd = $("#txtConfPwd").val();
    		if (str_pwd != str_confpwd) {
    			alert ( "Invalid password!" );
    			return;
    		}
    		$("#submitForm").ajaxSubmit({
    			success: function (data) {
    				var result = JSON.parse(data);
    				if (result.result == "success") {
						alert ("Password changed successfully.");
    				} else {
    					alert ( result.error );
    				}
    				return false;
    			},
    			error: function () {
    				alert ("Failed to change your password. Please try it again.");
    			}
    		});
    	}
    </script>
  </body>
</html>