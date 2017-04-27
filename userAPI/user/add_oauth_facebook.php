<?php

require_once '../../include/config.php';

$name=rinse($_REQUEST["name"]) or die ('{"status":"error","remarks":"Name is missing"}');

$mobile=numOnly($_REQUEST["mobile"]) or die ('{"status":"error","remarks":"Mobile is missing"}');


if(isset($_REQUEST["companyname"]))
	$companyname=rinse($_REQUEST["companyname"]);
else
	$companyname=0;

if(isset($_REQUEST["email"]))
	$email=rinse($_REQUEST["email"]);
else
	$email="";

$social_id=rinse($_REQUEST["social_id"]);
  $security_token=securityToken();   //get random security token

//$con=mysqli_connect($server,$username,$password,$database) or die ("could not connect to mysql");

$otp=mt_rand(1000,9999);

$query="select * from `user` where `mobile`='".$mobile."'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==0)
{
    $status=checkAutoApprove();	
	$query="Insert into `user`(`name`, `security_token`,`mobile`, `email`, `otp`,`social_id_facebook`,`verified`,`status`) VALUES ('".$name."','".$security_token."','".$mobile."', '".$email."', '".$otp."','".$social_id."',0,'".$status."')";

	
	mysqli_query($con,$query);

	sendSMS("to=91".$mobile."&text=Your OTP is ".$otp,$route);  //send OTP to customer's mobile


	echo '{"status":"ok","remarks":"OTP sent"}';
}
else
{
	$query="update `user` set `social_id_facebook`='".$social_id."' where `mobile`='".$mobile."'";
	mysqli_query($con,$query);
	echo '{"status":"ok","remarks":"Social Id Added"}';
}

mysqli_close($con);

?>