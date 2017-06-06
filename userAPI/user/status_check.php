<?php

    /*

    Status:

    1: Approved
    0: Not approved yet
    -1: Blocked by Admin



    */
    require_once '../../include/config.php';

    if(isset($_REQUEST["user_id"]))
    {  
        
        $query="select `status` from `user` where `id`='".$_REQUEST["user_id"]."'";
        $result=mysqli_query($con,$query);
        $rowcount=mysqli_num_rows($result);
        if($rowcount==1)
        {
          $row=mysqli_fetch_assoc($result);

          if($row["status"]==1)
          {
            // $q="select `value` from `settings` where `setting_title`='screenshot_allowed'";
            // $re=mysqli_query($con,$q);
            // $rr=mysqli_fetch_array($re);
            // $output = '{"status":"success","remark":"Access granted","screenshot_allowed":"'.$rr["value"].'","online_payment":"1"}';
            $output = '{"status":"success","remark":"Access granted","settings":'.appSettings().'}';
          }
          elseif($row["status"]==0)
          {
            $output='{"status":"failure","remark":"Your account has not been approved by Admin yet!"}';
          }
          else
          {
            $output='{"status":"failure","remark":"You have been blocked by Admin!"}';

          }
        }
      else
      {
        $output='{"status":"failure","remark":"Incorrect user id!"}';
      }
    }
    else
    {
        $output='{"status":"success","remark":"User id not set!","settings":'.appSettings().'}';
    }
        echo $output;
    mysqli_close($con);
?>