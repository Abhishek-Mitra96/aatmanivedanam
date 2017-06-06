<?php


require_once '../../include/config.php';
admincheck();

$id = $_REQUEST['id'];
    
$query="SELECT `status` FROM `blog` WHERE `blog_id`={$id}";

$result    =   mysqli_query($con,$query);
$row   =  mysqli_fetch_array($result);



$status =$row['status'];

$visibility="";

switch ($status) {
    case "1":
       
        $visibility="0";
        break;
    case "0":
        $visibility="1";
        
        break;

}

//echo $id.'-'.$s;
//die();


$query2="UPDATE `blog` SET `status` = '{$visibility}' WHERE `blog_id` = {$id}";
$result2=mysqli_query($con,$query2);
     
    if(mysqli_affected_rows($con)>0)
         {
        
        // header("Location:../../admin/tour.php");
            echo '{"status":"success"}';
        
         }
    else
        {
            echo '{"status":"failure"}';
            error_log(mysqli_error($con));
            // error_log($query);
        }
?>