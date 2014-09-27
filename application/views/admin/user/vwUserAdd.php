<?php
/********************************************************************************************
 * Page				: 
 * Author			: JENI
 * ------------------------------------------------------------------------------------------
 * File Name		: vwUserAdd.php
 * Description		: 
 * Date				: Sep 14
 * Version			: 1.0
 ********************************************************************************************/
?>
<?php
$this->load->view('admin/vwHeader_v');
?>
			<!-- start: Content -->
			<div id="content" class="col-lg-10 col-sm-11 ">
				<div class="row ">
					<ol class="breadcrumb">
					  	<li>User Management</li>
					  	<li class='active'>Add</li>
					</ol>
				</div><!--/row-->

				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>Add User</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/users/save">
    								<fieldset>
    								    <input type="hidden" name="user_id">
        								<div class="form-group">
        								    <label class="col-md-4 control-label">First Name</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="first_name" class="form-control" placeholder="First Name">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Last Name</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Password</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="password" class="form-control" value="" placeholder="Password">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Email Address</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="email" class="form-control" placeholder="Email Address">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Birthday</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="birthday" class="form-control" placeholder="Birthday">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Gender</label>  
        								    <div class="col-md-5">
        								        <select class="form-control" name="gender">
        								            <option value='M'>Male</option>
        								            <option value='F'>Female</option>
        								        </select>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Address</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="address" class="form-control" placeholder="Address">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">City</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="city" class="form-control" placeholder="City">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">State</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="state" class="form-control" placeholder="State">
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Country</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="country" class="form-control" placeholder="Country">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Postal Code</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Admin</label>  
        								    <div class="col-md-5">
        								        <select name="is_admin" class="form-control">
        								            <option value=1>Yes</option>
        								            <option value=0>No</option>
        								        </select>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Active</label>  
        								    <div class="col-md-5">
        								        <select name="is_active" class="form-control">
        								            <option value=1>Yes</option>
        								            <option value=0>No</option>
        								        </select>
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
        								            <a href="<?php echo base_url();?>admin/users">Back</a>
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
    <script src="<?php echo HTTP_JS_PATH;?>admin/user.js"></script>			
<?php
$this->load->view('admin/vwFooter');
?>