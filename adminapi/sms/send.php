<?php


require_once '../../include/config.php';
admincheck();

$mobile=$_REQUEST["mobile"] or die('{"status":"failure","remark":"Mobile number is missing"}');
$message=$_REQUEST["message"] or die('{"status":"failure","remark":"Message is missing"}');

$size=smsSize($message);
if(customerSMSBalance()>=$size && $size>0)    //does customer have sufficient balance and SMS size is more than 1
{
    $post="to=91".$mobile."&text=".$message;
    // $resp=sendSMS($post,$route);
    sendSMS($post,$route);
    deductSmsBalance($size);
}

// echo '{"status":"success","remark":"'.$resp.'"}';
echo '{"status":"success","remark":"Message sent"}';

mysqli_close($con);
?>