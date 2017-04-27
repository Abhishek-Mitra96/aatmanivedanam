<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["mobile"]) && $_REQUEST["mobile"]!="" && strlen($_REQUEST["mobile"])==10 && strlen(numOnly($_REQUEST['mobile']))==10){
  //correct mobile recieved
  $mobile=numOnly($_REQUEST["mobile"]);
  $query="select * from `user` where `mobile`='".$mobile."'";
  $result=mysqli_query($con,$query);
  $rowcount=mysqli_num_rows($result);
  if($rowcount==1){
    //one correct data recieved
    $row=mysqli_fetch_assoc($result);
    $user_id=$row["user_id"];

    $otp=mt_rand(1000,9999);
    $query="update `user` set otp='".$otp."' where `user_id`='".$user_id."'";
   
    mysqli_query($con,$query);

    $message="Your OTP is {$otp}";
    sendSMS("to=".$mobile."&text=".$message,$route);
    /*$size=smsSize($message);
    if(customerSMSBalance()>=$size)    //does the customer have sufficient balance to send SMS
    {
      $post="to=".$mobile."&text=".$message;
      // echo $post;
      sendSMS($post,$route);
      deductSmsBalance($size);
    }*/
    $output='{"status":"success","remark":"OTP sent successfully!"}';

  }else{
     $output='{"status":"failure","remark":"Incorrect mobile number"}';
  }
}else{
    $output='{"status":"failure","remark":"Invalid or Incomplete mobile recieved"}';
}
echo $output;
mysqli_close($con);
?>