<?php
/********************************************************************************************
 * Page				:
 * Author			: KCH
 * ------------------------------------------------------------------------------------------
 * File Name		: vwAddPromotion.php
 * Description		: 
 * Date				: Aug 12, 2014 10:27:46 PM
 * Version			: 1.0
 ********************************************************************************************/
 ?>
 <?php
$this->load->view('admin/vwHeader');
?>

<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
<link href="<?php echo HTTP_CSS_PATH; ?>signin.css" rel="stylesheet"> 
    <div class="container">
        <?php if (isset($pgtype) && $pgtype == 'edit') {?>
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>admin/promotions/update/<?php echo $pid;?>">
        	<?php if (isset($error) && $error != '') { echo "<span class='has-error'>".$error."</span>"; } ?>
        	<h3>Edit Promotion</h3>
        	<input type="text" class="form-control" placeholder="Title" name="proTitle" autofocus value="<?php echo isset($proTitle)?$proTitle:'';?>">
        	<textarea name="proContent" style="min-width: 298px;min-height: 200px;margin-top: 5px;" placeholder="Content"><?php echo isset($proContent)?$proContent:'';?></textarea>
        	<button class="btn btn-small btn-primary btn-block" type="submit" style="margin-top: 10px;">Submit</button>
      	</form>
        <?php } else {?>
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>admin/promotions/add_new">
        	<?php if (isset($error) && $error != '') { echo "<span class='has-error'>".$error."</span>"; } ?>
        	<h3>Add New Promotion</h3>
        	<input type="text" class="form-control" placeholder="Title" name="proTitle" autofocus>
        	<textarea name="proContent" style="min-width: 298px;min-height: 200px;margin-top: 5px;" placeholder="Content"></textarea>
        	<button class="btn btn-small btn-primary btn-block" type="submit" style="margin-top: 10px;">Submit</button>
      	</form>
 		<?php }?>
    </div><!-- /.container -->
     <hr>
<?php
$this->load->view('admin/vwFooter');
?>