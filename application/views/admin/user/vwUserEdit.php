<?php
/********************************************************************************************
 * Page				: 
 * Author			: JENI
 * ------------------------------------------------------------------------------------------
 * File Name		: vwUserEdit.php
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
					  	<li class='active'>Edit</li>
					</ol>
				</div><!--/row-->

				<div class="row">	
					<div class="col-lg-12">
						<div class="box">
							<div class="box-header">
								<h2><i class="icon-hand-up"></i><span class="break"></span>Edit User</h2>
							</div>
							<div class="box-content">
							    <form class="form-horizontal" method="post" action="<?php echo base_url();?>admin/users/save">
    								<fieldset>
    								    <input type="hidden" name="user_id" value="<?php echo $data->id;?>">
    								    
        								<div class="form-group">
        								    <label class="col-md-4 control-label">First Name</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="first_name" class="form-control" value="<?php echo $data->first_name;?>" placeholder="First Name">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Last Name</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="last_name" class="form-control" value="<?php echo $data->last_name;?>" placeholder="Last Name">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Password</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="password" class="form-control" value="">
        								    </div>
        								    <span class="col-md-3" style="color: #AAA; font-size: 11px;">* Fill blank if you don't change password</span>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Email</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="email" class="form-control" value="<?php echo $data->email;?>" placeholder="Email Address">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Birthday</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="birthday" class="form-control" value="<?php echo $data->birthday;?>" placeholder="Birthday">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Gender</label>  
        								    <div class="col-md-5">
        								        <select class="form-control" name="gender">
        								            <option value='M' <?php echo ($data->gender == 'M') ? 'selected' : '';?>>Male</option>
        								            <option value='F' <?php echo ($data->gender == 'F') ? 'selected' : '';?>>Female</option>
        								        </select>
        								    </div>
        								</div>

        								<div class="form-group">
        								    <label class="col-md-4 control-label">Photo</label>  
        								    <div class="col-md-5">
        								        <img src="<?php echo HTTP_PROFILE_PATH.$data->photo;?>" style="width: 100px; height: 100px;">
        								    </div>
        								</div>        								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Address</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="address" class="form-control" value="<?php echo $data->address;?>" placeholder="Address">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">City</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="city" class="form-control" value="<?php echo $data->city;?>" placeholder="City">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">State</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="state" class="form-control" value="<?php echo $data->state;?>" placeholder="State">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Country</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="country" class="form-control" value="<?php echo $data->country;?>" placeholder="Country">
        								    </div>
        								</div>
        								        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Postal Code</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="postal_code" class="form-control" value="<?php echo $data->postal_code;?>" placeholder="Postal Code">
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Credits Balance</label>  
        								    <div class="col-md-5">
        								        <input type="text" name="credits" class="form-control" value="<?php echo $data->credits;?>" placeholder="Credits">
        								    </div>
        								</div>        								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Number Of Card Sent</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->count_card_sent;?></p>
        								    </div>
        								</div>        								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Visit Count</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->count_visit;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Last Visited On</label>  
        								    <div class="col-md-5">
        								        <p class="form-control-static"><?php echo $data->visited_at;?></p>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Active</label>
        								    <div class="col-md-5">
        								        <select name="is_active" class="form-control">
        								            <option <?php echo $data->is_active ? 'selected' : '';?> value=1>Yes</option>
        								            <option <?php echo $data->is_active ? '' : 'selected';?> value=0>No</option>
        								        </select>
        								    </div>
        								</div>          								
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Admin</label>  
        								    <div class="col-md-5">
        								        <select name="is_admin" class="form-control">
        								            <option <?php echo $data->is_admin ? 'selected' : '';?> value=1>Yes</option>
        								            <option <?php echo $data->is_admin ? '' : 'selected';?> value=0>No</option>
        								        </select>
        								    </div>
        								</div>
        								
        								<div class="form-group">
        								    <label class="col-md-4 control-label">Created On</label>  
        								    <div class="col-md-5">
        								        <input type="text" readonly class="form-control" value="<?php echo $data->created_at;?>">
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
        								        &nbsp;&nbsp;&nbsp;
        								        <button class="btn btn-danger">
        								            <a class="js-link" href="<?php echo base_url();?>admin/users/delete/<?php echo $data->id;?>">Delete</a>
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