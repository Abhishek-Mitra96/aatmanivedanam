<?php
require_once '../../include/config.php';

if(isset($_REQUEST["category_id"]) && $_REQUEST["category_id"]!=""){
	$category_id=numOnly($_REQUEST["category_id"]);
	$query="SELECT `status` FROM `category_image` WHERE `category_id`={$category_id}";

	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($result);

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
	$query="UPDATE `category_image` SET `status` = '{$visibility}' WHERE `category_id` = {$category_id}";
	$result=mysqli_query($con,$query);
	     
	if($result){
	    echo '{"status":"success", "remark":"Successfully updated"}';
	}else{
	    echo '{"status":"failure", "remark":"Something is wrong with the query"}';
	}
}else echo '{"status":"failure", "remark":"Invalid or incomplete data recieved"}';

mysqli_close($con);
  
?>