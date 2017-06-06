<?php

require_once '../include/config.php';
$con=mysqli_connect($server,$username,$password,$database) or die ("could not connect to mysql");

$flag=0;  // to check if SMS balance should be deducted from their account

if(isset($_REQUEST["mobile"]))
	$mobile=$_REQUEST["mobile"];
else
	$mobile=0;

$query="select `id` from `admin_user` where `mobile`='".$mobile."'";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==0)
		echo "0";
	else
	{
		$otp=mt_rand(1000,9999);

		$query="update `admin_user` set `otp`='".$otp."' where `mobile`='".$mobile."'";
		mysqli_query($con,$query);

		// if(customerSMSBalance()>0)    //does the customer have sufficient balance to send SMS
		// 	{
				$post="to=".$mobile."&text=Your OTP is ".$otp;
				sendSMS($post,$route);
			// 	deductSmsBalance(1);
			// }
	
		echo '1';

	}

	mysqli_close($con);

?>