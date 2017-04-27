<?php

    require_once '../../include/config.php';

  admincheck();

    $name=$_SESSION['sess_user'];

    if(isset($_REQUEST["oldpassword"]) && isset($_REQUEST["newpassword"]))

    {  
        $query="select `password` from `admin_user` where `name`='".$name."'";
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_array($result);
        $oldpassword=$row["password"];

        if($oldpassword==md5($_REQUEST["oldpassword"]))
        {
          $query="update `admin_user` set `password`='".md5($_REQUEST["newpassword"])."'
          where `name`='".$name."'";
          mysqli_query($con,$query);
          echo 1;
        }
        else
        {
          echo 2;
        }
    }

      
    mysqli_close($con);

?>