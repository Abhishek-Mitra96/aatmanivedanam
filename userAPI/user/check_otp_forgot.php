<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["mobile"]) && $_REQUEST["mobile"]!="" && strlen($_REQUEST["mobile"])==10 && strlen(numOnly($_REQUEST['mobile']))==10){
  //correct mobile recieved
  if(isset($_REQUEST['newpassword']) && $_REQUEST["newpassword"]!="" && strlen($_REQUEST["newpassword"])>=6){
    //correct password recieved
    if(isset($_REQUEST['otp']) && $_REQUEST["otp"]!="" && strlen($_REQUEST["otp"])==4){
        //everything recieved
        $otp=numOnly($_REQUEST["otp"]);
        $password=md5($_REQUEST["newpassword"]);
        $mobile=numOnly($_REQUEST["mobile"]);

        $query="select * from `user` where `otp`='".$otp."' and `mobile`='".$mobile."' ";
        $result=mysqli_query($con,$query);
        $row_count=mysqli_num_rows($result);

        if($row_count==1){
            $row=mysqli_fetch_assoc($result);
            $user_id=$row["user_id"];
            $query="update `user` set `password`='".$password."' where `user_id`='".$user_id."'";
            mysqli_query($con,$query);
            $output='{"status":"success","remarks":"Password changed successfully!"}';
        }else{
            $output='{"status":"failure","remarks":"Mobile number or otp is Incorrect!"}';
        }
    }else{
      $output='{"status":"failure","remarks":"Invalid or Incomplete OTP recieved"}';
    }
  }else{
    $output='{"status":"failure","remarks":"Invalid or Incomplete password recieved"}';
  }
}else{
  $output='{"status":"failure","remarks":"Invalid or Incomplete mobile recieved"}';
}
/*
if(isset($_REQUEST['otp']) && isset($_REQUEST['mobile']) && isset($_REQUEST['newpassword']))
{
    $otp=$_REQUEST["otp"];
    $newPassword=md5($_REQUEST["newpassword"]);
    $detail=$_REQUEST["mobile"];

    $query="select * from `user` where `otp`='".$otp."' and (`mobile`='".$detail."' or `student_id`='".$detail."')";
    $result=mysqli_query($con,$query);
    $row_count=mysqli_num_rows($result);
    if($row_count==1)
    {
        $row=mysqli_fetch_array($result);
        $mobile=$row["mobile"];
        mysqli_query($con,"update `user` set `password`='".$newPassword."' where mobile='".$mobile."'");
        $output='{"status":"success","remarks":"Password changed successfully!"}';
        
    }
    else
    {
        $output='{"status":"failure","remarks":"Your phone number or otp is wrong!"}';

        
    }
    $q = "UPDATE `user` SET `otp`='' WHERE `mobile`='".$mobile."'";
    $res = mysqli_query($con,$q);
}
else
{
    $output='{"status":"failure","remarks":"Please enter the required credentials!"}';

    
}*/
echo $output;

mysqli_close($con);
?>