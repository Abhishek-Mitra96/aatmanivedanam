<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["image_id"]) && $_REQUEST["image_id"]!=""){
	if(isset($_REQUEST["name"]) && $_REQUEST["name"]!=""){
		if(isset($_REQUEST["description"]) && $_REQUEST["description"]!=""){
			if(isset($_REQUEST["url"]) && $_REQUEST["url"]!=""){
				if(isset($_REQUEST["status"]) && ( $_REQUEST["status"]=="0" or $_REQUEST["status"]=="1")){
					$image_id=numOnly($_REQUEST["image_id"]);
					$name=clean($_REQUEST["name"]);
					$description=clean($_REQUEST["description"]);
					$url=$_REQUEST["url"];
					$status=numOnly($_REQUEST["status"]);

					$query="update `image` set `name`='{$name}', `description`='{$description}', `url`='{$url}', `status`='{$status}' where `image_id`=".$image_id;
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
				$output='{"status":"failure", "remark":"Invalid or incomplete url recieved"}';
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