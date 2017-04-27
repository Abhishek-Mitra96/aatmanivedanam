<?php
require_once '../../include/config.php';

if(isset($_REQUEST["event_id"]) && $_REQUEST["event_id"]!=""){
	$event_id=numOnly($_REQUEST["event_id"]);
	$query="SELECT `status` FROM `event` WHERE `event_id`={$event_id}";

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
	$query="UPDATE `event` SET `status` = '{$visibility}' WHERE `event_id` = {$event_id}";
	$result=mysqli_query($con,$query);
	     
	if($result){
	    echo '{"status":"success", "remark":"Successfully updated"}';
	}else{
	    echo '{"status":"failure", "remark":"Something is wrong with the query"}';
	}
}else echo '{"status":"failure", "remark":"Invalid or incomplete data recieved"}';

mysqli_close($con);
  
?>