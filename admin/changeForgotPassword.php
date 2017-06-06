<?php
	
	require_once '../include/config.php';

    $mobile=$_REQUEST["mobile"];
    $otp=$_REQUEST["otp"];
    $newPassword=md5($_REQUEST["newPassword"]);

    
    $con=mysqli_connect($server,$username,$password,$database) or die ("could not connect to mysql");
	
	$query ="SELECT `otp` from `admin_user` where `mobile`='".$mobile."'";
	$result=mysqli_query($con,$query);

	if(mysqli_num_rows($result))
	{
		$row=mysqli_fetch_array($result);

		if($otp===$row["otp"]) //match the password
		{

			$query="update `admin_user` set `password`='".$newPassword."' where `mobile`='".$mobile."'";
			mysqli_query($con,$query);   //update new password

			echo '[{"status":"success","remarks":"Password updated successfully"}]';
			
			$query="update `admin_user` set `otp`='' where `mobile`='".$mobile."'";
			mysqli_query($con,$query);   //clear OTP

		}
		else
		{
			echo '[{"status":"error","remarks":"Incorrect OTP Received"}]';

		}
	}
	else
	{
		echo '[{"status":"error","remarks":"Incorrect Mobile Number Received"}]';
	}
	mysqli_close($con);

?>