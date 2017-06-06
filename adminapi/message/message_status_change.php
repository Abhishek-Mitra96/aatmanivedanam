<?php

require_once '../../include/config.php';
admincheck();


    if(isset($_REQUEST["message_id"]))
    {
        $query="SELECT `status` FROM `messages` where `message_id`='".$_REQUEST["message_id"]."'";
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_array($result);

        $status=$row["status"];

        if($status==0)
        {
            $query="update `messages` set `status`=1 where `message_id`='".$_REQUEST["message_id"]."'";
        }
        else
        {
            $query="update `messages` set `status`=0 where `message_id`='".$_REQUEST["message_id"]."'";
        }
    
        $result=mysqli_query($con,$query);
        if($result)
        {
            $output='{"status":"success","remark":"Status updated successfully"}';
        }
        else
        {
            $output='{"status":"failure","remark":"Error updating status"}';
        }
    }
    else
    {
        $output='{"status":"failure","remark":"Required parameters not set"}';
    }
    echo $output;
    mysqli_close($con);
?>