<?php

 require_once '../../include/config.php';
 
 logincheck();

 if(isset($_REQUEST['mobile']) && isset($_REQUEST['oldpassword']) && isset($_REQUEST['newpassword']))
    {
        $mobile = $_REQUEST['mobile'];
        $oldPassword = md5($_REQUEST['oldpassword']);
        $newPassword = md5($_REQUEST['newpassword']);

        $query="select * from `user` where  `mobile`='".$_REQUEST['mobile']."'";
        $result=mysqli_query($con,$query);
        $row_count=mysqli_num_rows($result);
        if($row_count==1)
        {
            $row=mysqli_fetch_assoc($result);

            if($row['password'] == $oldPassword){

                mysqli_query($con,"update `user` set `password`='".$newPassword."' where mobile='".$mobile."'");
                $output='{"status":"success","remark":"Password changed successfully!"}';
            } 
            else{
                $output = '{"status":"failure","remark":"Password does not match"}';
            } 
        }
        else
        {
            $output='{"status":"failure","remark":"Your phone number is wrong!"}';
            error_log($query);
        }
    }
    else
    {
        $output='{"status":"failure","remark":"Please enter the required credentials!"}';
        
    }
    echo $output;
    mysqli_close($con);
?>