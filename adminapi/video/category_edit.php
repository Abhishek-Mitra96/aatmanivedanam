<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["category_id"]) && $_REQUEST["category_id"]!=""){
	if(isset($_REQUEST["name"]) && $_REQUEST["name"]!=""){
		if(isset($_REQUEST["description"]) && $_REQUEST["description"]!=""){
			if(isset($_REQUEST["status"]) && ( $_REQUEST["status"]=="0" or $_REQUEST["status"]=="1")){
				$category_id=numOnly($_REQUEST["category_id"]);
				$name=clean($_REQUEST["name"]);
				$description=clean($_REQUEST["description"]);
				$status=numOnly($_REQUEST["status"]);

				$query="update `category_video` set `name`='{$name}', `description`='{$description}', `status`='{$status}' where `category_id`=".$category_id;
				$result=mysqli_query($con,$query);
				if(mysqli_affected_rows($con)==1){
					$output='{"status":"success", "remark":"Successfully update the data"}';
				}else{
					$output='{"status":"failure", "remark":"Something is wrong with query"}';
				}
			}else{
				$output='{"status":"failure", "remark":"Invalid or incomplete status recieved"}';
			}
		}else{
			$output='{"status":"failure", "remark":"Invalid or incomplete description recieved"}';
		}
	}else{
		$output='{"status":"failure", "remark":"Invalid or incomplete name recieved"}';
	}
}else{
	$output='{"status":"failure", "remark":"Invalid or incomplete id recieved"}';
}
echo $output;

mysqli_close($con);
  
?>