<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["mobile"]) && $_REQUEST["mobile"]!="" && strlen($_REQUEST["mobile"])==10 && strlen(numOnly($_REQUEST['mobile']))==10){
  //correct mobile recieved
  if(isset($_REQUEST['password']) && $_REQUEST["password"]!="" && strlen($_REQUEST["password"])>=6){
    //correct password recieved
    if(isset($_REQUEST['name']) && $_REQUEST["name"]!=""){
      //correct name recieved
      //start the game

      $mobile = numOnly($_REQUEST['mobile']);
      $password = md5($_REQUEST['password']);
      $name = rinse($_REQUEST['name']);
      
      if(isset($_REQUEST["email"]))
        $email = rinse($_REQUEST['email']);
      else
        $email="";

      $security_token=securityToken();   //get random security token

      $query="select * from `user` where `mobile`='".$mobile."'";
      $result=mysqli_query($con,$query);
      $row_count=mysqli_num_rows($result);

      if($row_count == 0){           
        $status=checkAutoApprove();
        $verified=0; //user not verified now
        $registered_on=date("Y-m-d H:i:s");
        $otp=mt_rand(1000,9999);
              
        $message="Your OTP is ".$otp;
        sendSMS("to=91".$mobile."&text=".$message,$route);
        /*$size=smsSize($message);
        if(customerSMSBalance()>=$size)
        {
            sendSMS("to=91".$mobile."&text=".$message,$route);
            deductSmsBalance($size);
        }*/

        $query="INSERT INTO `user`(`name`,`mobile`,`password`,`email`,`security_token`,`verified`,`otp`,`registered_on`,`status`) VALUES ('{$name}','{$mobile}','{$password}','{$email}','{$security_token}','{$verified}','{$otp}', '{$registered_on}', '{$status}')";

        $result = mysqli_query($con,$query);
        if($result){
          $output='{"status":"success","remark":"OTP is sent to your given mobile"}';
        }else{
          $output='{"status":"failure","remark":"Something is wrong with query"}';
        }
      }else{
        $output='{"status":"failure","remark":"Mobile Number already exists!"}';
      }
    }else{
      $output='{"status":"failure","remark":"Invalid or Incomplete name recieved"}';
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