<?php

 require_once '../../include/config.php';
 
 logincheck();

 $user_id=numOnly($_REQUEST["user_id"]);

 if(isset($_REQUEST["name"]))
    $name=rinse($_REQUEST["name"]);

else
{
    die('{"status":"failure","remark":"Your phone number is wrong!"}');
}

 $query="update `user` set `name`='".$name."' where id='".$user_id."'";

 $result=mysqli_query($con,$query);

if($result)
{
    $output='{"status":"success","remark":"Profile updated successfully!"}';
} 
else
{
    $output = '{"status":"failure","remark":"Error updating profile"}';
} 
        
    echo $output;
    mysqli_close($con);
?>