<?php
require_once '../../include/config.php';

   $id = $_REQUEST['id'];
   
   $query="DELETE FROM `user_review` WHERE `id` = {$id}";
   
   $result= mysqli_query($con, $query);
   
   if(mysqli_affected_rows($con)>0)
       {
//       $output="[{'status':'true','remark':'user review details!'}]";
//        echo $output;
        header("Location:../../admin/user_review.php");
        }
   else{
        $output="[{'status':'false','remark':'Error while delete user review!'}]";
        echo $output;
        }