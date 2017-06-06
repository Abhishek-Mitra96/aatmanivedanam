<?php
require_once '../../include/config.php';
admincheck();

$orderNo=$_REQUEST["orderNo"];
$now=date("Y-m-d h:i:s");

$query="UPDATE `payment_details` set `payment_method`=0, `payment_status`=1, `payment_date`='".$now."' WHERE `orderNo`='".$orderNo."'";


  $result = mysqli_query($con,$query);
   
            
    if(mysqli_affected_rows($con) > 0)
    {
      $output='{"status":"success","remark":"Updated successfully"}';
    }
    else
    {
      $output='{"status":"failure","remark":"Error updating"}';
      error_log($query);
      error_log(mysqli_error($con));
   }
  
  echo $output;
mysqli_close($con);
?>