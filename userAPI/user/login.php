<?php

  /*
    Status:

    1: Approved
    0: Not approved yet
    -1: Blocked by Admin
*/
require_once '../../include/config.php';
$output="";

if(isset($_REQUEST["mobile"]) && $_REQUEST["mobile"]!="" && strlen($_REQUEST["mobile"])==10 && strlen(numOnly($_REQUEST['mobile']))==10){
  //correct mobile recieved
  if(isset($_REQUEST['password']) && $_REQUEST["password"]!="" && strlen($_REQUEST["password"])>=6){
    $mobile=numOnly($_REQUEST["mobile"]);
    $password=md5($_REQUEST["password"]);
    $query="select * from `user` where `mobile`='".$mobile."' and `password`='".$password."'";
    $result=mysqli_query($con,$query);
    $row_count=mysqli_num_rows($result);
    if($row_count==1){
      //got a correct user data
      $row=mysqli_fetch_assoc($result);
      $user_id=$row["user_id"];
      $status=$row["status"];
      $verified=$row["verified"];
      $security_token=securityToken();   //get random security token

      if($status==1){
        //user is active
        if($verified==1){
          //user is verified
          $query="update `user` set `security_token`='".$security_token."' where `user_id`=".$user_id;
          if(mysqli_query($con,$query)){
            $output = '{"status":"success","remark":"User Credentials Verified","user_id":"'.$row['user_id'].'","contact_person":"'.$row["name"].'","security_token":"'.$security_token.'","email":"'.$row["email"].'"}';
            $_SESSION["user_id"]=$row["user_id"];
          }else{
            $output='{"status":"failure","remark":"Something is wrong with the query"}';
          }
        }else{
          //user is not verified, so user need to verify
          $otp=mt_rand(1000,9999);
          $query="UPDATE `user` SET `otp`='".$otp."' where `user_id`='".$user_id."'";
          if(mysqli_query($con,$query)){
            $output='{"status":"failure","type":"otp","remark":"Your account has not been verified yet. Please enter OTP"}';

            $message="Your OTP is ".$otp;
            sendSMS("to=91".$mobile."&text=".$message,$route);
          }else{
            $output='{"status":"failure","remark":"Something is wrong with the query"}';
          }
          /*$size=smsSize($message);
          if(customerSMSBalance()>=$size){
              sendSMS("to=91".$detail."&text=".$message,$route);
              deductSmsBalance($size);
          }*/
        }
      }elseif($status==0){
        $resp=json_decode(smsNotificationSettings());
        $admin_mobile=$resp->admin_mobile;
        $message="New user try to login. Please check online for approval.";
        sendSMS("to=91".$admin_mobile."&text=".$message,$route);
        /*if(strlen($admin_mobile)==10)
        {
            $message="New user try to login. Please check online for approval.";
            sendSMS("to=91".$admin_mobile."&text=".$message,$route);  //send SMS to admin to approve user
            $size=smsSize($message);
            if(customerSMSBalance()>=$size)
            {
                sendSMS("to=91".$admin_mobile."&text=".$message,$route);  //send SMS to admin to approve user
                deductSmsBalance($size);
            }
        }*/
        $output='{"status":"failure","remark":"Your account has not been approved by Admin yet!"}';
      }else{
        $output='{"status":"failure","remark":"You have been blocked by Admin!"}';
      }
    }else{
      $output='{"status":"failure","remark":"Mobile or Password is invalid"}';
    }
  }else{
    $output='{"status":"failure","remark":"Invalid or Incomplete password recieved"}';
  }
}else{
  $output='{"status":"failure","remark":"Invalid or Incomplete mobile recieved"}';
}
echo $output;
mysqli_close($con);
?>