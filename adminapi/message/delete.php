<?php

require_once '../../include/config.php';
admincheck();


    if(isset($_REQUEST["id"]))
    {
        $id=$_REQUEST["id"];
        $query="DELETE FROM `messages` where `message_id`='".$id."'";
        if(mysqli_query($con,$query))
        {
            $output='{"status":"success","remark":"Message deleted successfully"}';
        }
        else
        {
            $output='{"status":"failure","remark":"Error deleting message"}';
        }
    }
    else
    {
        $output='{"status":"failure","remark":"Required parameters not set"}';
    }
    echo $output;
    mysqli_close($con);
?>