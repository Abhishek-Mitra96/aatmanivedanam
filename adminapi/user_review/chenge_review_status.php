<?php


require_once '../../include/config.php';
 require_once '../../include/function.php'; 
$id = $_REQUEST['id'];
    


$query="SELECT `visibility` FROM `user_review` WHERE `id`={$id}";

$result    =   mysqli_query($con,$query);
$row   =  mysqli_fetch_assoc($result);



$status =$row['visibility'];

$visibility="";

switch ($status) {
    case "Active":
       
        $visibility="Inactive";
        break;
    case "Inactive":
        $visibility="Active";
        
        break;

}

//echo $id.'-'.$s;
//die();


$query2="UPDATE `user_review` SET `visibility` = '{$visibility}' WHERE `id` = {$id}";
$result2=mysqli_query($con,$query2);
     
    if(mysqli_affected_rows($con)>0)
         {
            
        header("Location:../../admin/user_review.php");
        
         }
    else
        {
            $output="[{'status':'false','remark':'user_review could not be Updated'}]";
            echo $output;	
        }
