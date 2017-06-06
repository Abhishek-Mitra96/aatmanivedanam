<?php

require_once '../../include/config.php';
admincheck();


    if(isset($_REQUEST["id"]))
    {
        $id=$_REQUEST["id"];
        $query="DELETE FROM `country` where `id`='".$id."'";
        if(mysqli_query($con,$query))
        {
            $output='{"status":"success","remark":"Country deleted successfully"}';
        }
        else
        {
            $output='{"status":"failure","remark":"Error deleting country"}';
        }
    }
    else
    {
        $output='{"status":"failure","remark":"Required parameters not set"}';
    }
    echo $output;
    mysqli_close($con);
?>