<?php


require_once '../../include/config.php';
admincheck();

$id = $_REQUEST['id'];
    
$query="SELECT `blog_img` FROM `blog` WHERE `blog_id`={$id}";

$result    =   mysqli_query($con,$query);
$row   =  mysqli_fetch_array($result);

$img=$row["blog_image"];
deleteImage($img);




$query2="delete from `blog` WHERE `blog_id` = {$id}";
$result2=mysqli_query($con,$query2);
     
    if(mysqli_affected_rows($con)>0)
         {
        

            echo '{"status":"success"}';
        
         }
    else
        {
            echo '{"status":"failure"}';
            error_log(mysqli_error($con));
        }
?>