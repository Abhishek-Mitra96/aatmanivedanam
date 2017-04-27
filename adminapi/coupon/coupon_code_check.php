<?php
include_once '../../include/config.php';

admincheck();

$coupon_code=$_POST["coupon_code"];

$query="SELECT * FROM `coupon_management` where `coupon_code`='".$coupon_code."'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==0){
	//return 0, means this coupon can be added, so avability true
	echo 1;
}else{
	echo 0;
}

?>