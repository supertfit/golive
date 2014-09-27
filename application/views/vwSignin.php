<?php
/*
 * Created on Aug 8, 2014
 *
 * File Name	: vwSignin.php
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
    <title>SignIn</title>
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
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>wsapis/wsSignIn" id="submitForm">
	        <h2 class="form-signin-heading">Please sign in</h2>
	        <input type="text" class="form-control" placeholder="Email Address" name="email" autofocus>
	        <input type="password" class="form-control" placeholder="Password" name="password">
			        
	        <div class="btn btn-lg btn-primary btn-block" onclick="OnSubmitForm();">Sign In</div>
	        <div class="btn btn-lg btn-primary btn-block" onclick="OnSubmitFormReset();">Forget Password</div>
      </form>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    
    <script type="text/javascript">
    	function OnSubmitForm() {
    		$("#submitForm").ajaxSubmit({
    			success: function (data) {
    				var result = JSON.parse(data);
    				if (result.result == "success") {
						alert ("Logged In successfully.");
						location.href = "<?php echo base_url();?>home/go_thanks";				
    				} else {
    					alert ( result.error );
    				}
    				return false;
    			},
    			error: function () {
    				alert ("Failed to activate your code. Please try it again.");
    			}
    		});
    	}
    	
    	function OnSubmitFormReset() {
    		$("#submitForm").attr("action", "<?php echo base_url();?>wsapis/wsForgotPwd");
    		$("#submitForm").ajaxSubmit({
    			success: function (data) {
    				var result = JSON.parse(data);
    				if (result.result == "success") {
						alert ("Please check your email inbox.");	
						location.href = "<?php echo base_url();?>home/go_thanks";				
    				} else {
    					alert ( result.error );
    				}
    				return false;
    			},
    			error: function () {
    			}
    		});
    	}
    </script>
  </body>
</html>