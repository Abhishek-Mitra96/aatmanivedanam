<?php

require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["mobile"]) && $_REQUEST["mobile"]!="" && strlen($_REQUEST["mobile"])==10 && strlen(numOnly($_REQUEST['mobile']))==10){
  //correct mobile recieved
  if(isset($_REQUEST['otp']) && $_REQUEST["otp"]!="" && strlen($_REQUEST["otp"])==4){
    $mobile = numOnly($_REQUEST['mobile']);
    $otp = numOnly($_REQUEST['otp']);
  
    $query="select * from `user` where `otp`='{$otp}' and `mobile`='{$mobile}'";
    $result=mysqli_query($con,$query);
    $row_count=mysqli_num_rows($result);
    if($row_count==1){
        $row=mysqli_fetch_assoc($result);
        $user_id=$row["user_id"];
        $user_status=$row["status"];
        $verified=$row["verified"];
        $registered_on=date("Y-m-d H:i:s");

        if($verified==0){
            //user not verified now
            $query="UPDATE `user` SET `verified`='1' WHERE `user_id`=".$user_id;
            mysqli_query($con,$query);
            
            $status=checkAutoApprove();
            if($status==0 && $user_status==0)
            {
                $resp=json_decode(smsNotificationSettings());
                $admin_mobile=$resp->admin_mobile;
                if(strlen($admin_mobile)==10)
                {
                    $message="New user registered. Please check online for approval.";
                    sendSMS("to=91".$admin_mobile."&text=".$message,$route);  //send SMS to admin to approve user
                    /*$size=smsSize($message);
                    if(customerSMSBalance()>=$size)
                    {
                        sendSMS("to=91".$admin_mobile."&text=".$message,$route);  //send SMS to admin to approve user
                        deductSmsBalance($size);
                    }*/
                }
            }
            $output='{"status":"ok","remarks":"You are now successfully verified, Please login now"}';
        }else{
            //user already verified
            $output='{"status":"failure","remarks":"You are already Verified"}';
        }
    }else{
        $output='{"status":"failure","remarks":"OTP did not match!"}';
    }
  }else{
    $output='{"status":"failure","remarks":"Invalid or Incomplete otp recieved"}';
  }
}else{
  $output='{"status":"failure","remarks":"Invalid or Incomplete mobile recieved"}';
}
echo $output;
mysqli_close($con);

?>