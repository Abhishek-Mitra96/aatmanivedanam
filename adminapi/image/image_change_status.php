<?php
require_once '../../include/config.php';

if(isset($_REQUEST["image_id"]) && $_REQUEST["image_id"]!=""){
	$image_id=numOnly($_REQUEST["image_id"]);
	$query="SELECT `status` FROM `image` WHERE `image_id`={$image_id}";

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
	$query="UPDATE `image` SET `status` = '{$visibility}' WHERE `image_id` = {$image_id}";
	$result=mysqli_query($con,$query);
	     
	if($result){
	    echo '{"status":"success", "remark":"Successfully updated"}';
	}else{
	    echo '{"status":"failure", "remark":"Something is wrong with the query"}';
	}
}else echo '{"status":"failure", "remark":"Invalid or incomplete data recieved"}';

mysqli_close($con);
  
?>