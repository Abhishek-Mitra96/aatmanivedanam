<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php');
require_once ('theme/sidebar.php');

$coupon_id=$_REQUEST['id'];
if(!isset($coupon_id) || $coupon_id=="") $coupon_id=0;

$obj=new stdClass();
$obj->coupon_id=$coupon_id;
$result=couponDetails($obj);
$arr=json_decode($result);

?>
<script>
	console.log('<?=$result?>');
</script>
<style>
.coupon_code_style{
	width: 50%;
   padding: 10px;
   border: 3px dashed #ccc;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Coupon Details<a href="coupon_edit.php?id=<?=$coupon_id?>" class="btn btn-info pull-right" role="button">Edit</a></h1>
	</section>

	<!-- Main content -->
	<section class="content">
	<!-- Default box -->
		<div class="box box-primary">
			<div class="box-body">
	            <div class="form-horizontal">
	                <div class="divide20"></div>
	                <div class="row">
	                	<?php
	                		if($arr->coupon[0]->status=="1") echo '<h5 style="color:green">ACTIVE</h5>';
	                		else echo '<h5 style="color:red">INACTIVE</h5>';
	                	?>
	                </div>
	                <div class="divide20"></div>
	                <div class="row">
		                <div class="col-md-6">
		                    <center><h2 class="coupon_code_style"><?=$arr->coupon[0]->coupon_code?></h2></center>
		                    <h5><?=$arr->coupon[0]->coupon_detail?></h5>
		                </div>
		                <div class="col-md-5">
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Valid From</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->valid_from?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Valid Till</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->valid_till?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Minimum Booking Quantity</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->min_quantity?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Minimum Booking Amount</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><i class="fa fa-inr"></i>&nbsp;<?=$arr->coupon[0]->min_amount?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Discount Type</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->discount_type?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Discount</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->discount?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Maximum Discount</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><i class="fa fa-inr"></i>&nbsp;<?=$arr->coupon[0]->max_discount?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Minimum Booking Amount</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><i class="fa fa-usd"></i>&nbsp;<?=$arr->coupon[0]->min_amount_usd?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Discount Type USD</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->discount_type_usd?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Discount USD</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->discount_usd?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Maximum Discount USD</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><i class="fa fa-usd"></i>&nbsp;<?=$arr->coupon[0]->max_discount_usd?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Maximum Usage</b><br>(for each user)</h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->max_use?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>Maximum Usage</b><br>(for this coupon)</h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><?=$arr->coupon[0]->max_use_global?></h5>
		                		</div>
		                	</div>
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<h5 class="pull-left"><b>First Purchase Only</b></h5>
		                		</div>
		                		<div class="col-sm-6">
		                			<h5 class="pull-left">Yes</h5>
		                		</div>
		                	</div>
		
		                </div>
	            	</div>  <hr>
	            	<div class="divide10"></div>
	            	<div class="row">
	            		<div class="col-sm-3">
	            			<h5><b>Category</b></h5>
	            			<p>
	            			<?php
	            				if(sizeof($arr->category)>0){
	            					//print list
	            					for($i=0;$i<sizeof($arr->category);$i++)
	            						echo '<span class="label label-info">'.$arr->category[$i]->category_name.'</span>&nbsp;';
	            				}else{
	            					//print this is for all category
	            					echo '<span class="label label-primary">For All</span>';
	            				}
	            			?>
	            			</p>
	            		</div>
	            		<div class="col-sm-3">
	            			<h5><b>Tour</b></h5>
	            			<p>
	            			<?php
	            				if(sizeof($arr->tour)>0){
	            					//print list
	            					for($i=0;$i<sizeof($arr->tour);$i++)
	            						echo '<span class="label label-info">'.$arr->tour[$i]->tour_name.'</span>&nbsp;';
	            				}else{
	            					//print this is for all category
	            					echo '<span class="label label-primary">For All</span>';
	            				}
	            			?>
	            			</p>
	            		</div>
	            		<div class="col-sm-3">
	            			<h5><b>User</b></h5>
	            			<p>
	            			<?php
	            				if(sizeof($arr->user)>0){
	            					//print list
	            					for($i=0;$i<sizeof($arr->user);$i++)
	            						echo '<span class="label label-info">'.$arr->user[$i]->fname." ".$arr->user[$i]->lname.'</span>&nbsp;';
	            				}else{
	            					//print this is for all category
	            					echo '<span class="label label-primary">For All</span>';
	            				}
	            			?>
	            			</p>
	            		</div>
	            		<div class="col-sm-3">
	            			<h5><b>Not User</b></h5>
	            			<p>
	            			<?php
	            				if(sizeof($arr->user_not)>0){
	            					//print list
	            					for($i=0;$i<sizeof($arr->user_not);$i++)
	            						echo '<span class="label label-info">'.$arr->user_not[$i]->fname." ".$arr->user_not[$i]->lname.'</span>&nbsp;';
	            				}else{
	            					//print this is for all category
	            					echo '<span class="label label-primary">For All</span>';
	            				}
	            			?>
	            			</p>
	            		</div>
	            	</div>
	            </div><!-- /.box-body -->
			</div>   
	    </div>
		<!-- /.box -->
	   
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once ('theme/footer.php');?>