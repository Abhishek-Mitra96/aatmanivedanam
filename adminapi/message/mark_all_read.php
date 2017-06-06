<?php

require_once '../../include/config.php';
admincheck();


    
        
        $query="update `messages` set `status`=1 where `status`=0";
        
        $result=mysqli_query($con,$query);
        if($result)
        {
            $output='{"status":"success"}';
        }
        else
        {
            $output='{"status":"failure"}';
        }
    echo $output;
    mysqli_close($con);
?>