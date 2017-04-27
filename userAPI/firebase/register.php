<?php

require_once '../../include/config.php';
	 
//getting the request values 
if(isset($_REQUEST["user_id"]) && $_REQUEST["user_id"]!=""){
	$token = $_REQUEST['token'];
	$user_id  = numOnly($_REQUEST['user_id']);

	$query = "UPDATE `user` SET `firebaseid` = '".$token."' WHERE `user_id` = '".$user_id."'";
	if(mysqli_query($con,$query)){
		echo '{"status":"success", "remark":"successfully update firebase id"}';
	}else{
		echo '{"status":"failure", "remark":"Something is wrong with query"}';
	}
}else{
	echo '{"status":"failure", "remark":"Invalid or incomplete user id recieved"}';
}
mysqli_close($con);

?>