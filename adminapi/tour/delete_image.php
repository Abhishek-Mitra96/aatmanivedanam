<?php

include_once '../../include/config.php';
admincheck();


if(isset($_REQUEST['id']))
{
 
  $id=$_REQUEST['id'];
  $set=$_REQUEST["set"];
  // $error=0;

        
  $query="UPDATE `product` SET "
          . "`img_set{$set}` = '' WHERE `id` = {$id}";     

    $query1="select `img_set{$set}` as img from `product` where `id`=".$id;
    $result1=mysqli_query($con,$query1);
    $row1=mysqli_fetch_array($result1);

    $img=$row1["img"];
    
    deleteImage($img);
        
    if(mysqli_query($con,$query))
    {
      $output='{"status":"success","remark":"Image Deleted successfully"}';

    }
    else
    {
       $output='{"status":"failure","remark":"Unknown error occured"}';
      // $error=1;
      error_log($query);
      error_log(mysqli_error($con));

    }
}
else
{
  $output='{"status":"failure","remark":"Insufficient parameters provided"}';
}

echo $output;
mysqli_close($con);

?>