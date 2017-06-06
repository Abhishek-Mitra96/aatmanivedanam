<?php


require_once '../../include/config.php';
admincheck();

$id = $_REQUEST['id'];
    
$query="SELECT `status` FROM `blog_category` WHERE `blog_cat_id`={$id}";

$result    =   mysqli_query($con,$query);
$row   =  mysqli_fetch_assoc($result);



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


$query2="UPDATE `blog_category` SET `status` = '{$visibility}' WHERE `blog_cat_id` = {$id}";
$result2=mysqli_query($con,$query2);
     
if(mysqli_affected_rows($con)>0)
 {
    echo '{"status":"success"}';
 }
else
{
    echo '{"status":"failure"}';
}
?>