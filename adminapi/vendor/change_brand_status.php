<?php


require_once '../../include/config.php';
admincheck();


$id = $_REQUEST['id'];
    
$query="SELECT `status` FROM `brand` WHERE `brand_id`={$id}";

$result    =   mysqli_query($con,$query);
$row   =  mysqli_fetch_assoc($result);



$status =$row['status'];

$new_status="";

switch ($status) {
    case "1":
       
        $new_status="0";
        break;
    default:
        $new_status="1";
        
        break;

}

//echo $id.'-'.$s;
//die();


$query2="UPDATE `brand` SET `status` = '{$new_status}' WHERE `brand_id` = {$id}";
$result2=mysqli_query($con,$query2);
     
    if(mysqli_affected_rows($con)>0)
         {
        
            $output='{"status":"success","remark":"Done"}';
        
         }
    else
        {
            $output='{"status":"failure","remark":"Something went wrong"}';
        }
            echo $output;   
    mysqli_close($con);
?>