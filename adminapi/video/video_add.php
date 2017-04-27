<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["name"]) && $_REQUEST["name"]!=""){
	if(isset($_REQUEST["url"]) && $_REQUEST["url"]!=""){
		if(isset($_REQUEST["description"]) && $_REQUEST["description"]!=""){
			if(isset($_REQUEST["category_id"]) && $_REQUEST["category_id"]!=""){
				$name=rinse($_REQUEST["name"]);
				$url=$_REQUEST["url"];
				$description=rinse($_REQUEST["description"]);
				$category_id=numOnly($_REQUEST["category_id"]);
				$status=1;

				$query="select * from `category_video` where `category_id`=".$category_id;
				$result=mysqli_query($con,$query);
				if(mysqli_num_rows($result)==1){
					$query="insert into `video` (`category_id`,`name`,`url`,`description`,`status`) values ('{$category_id}', '{$name}', '{$url}', '{$description}','{$status}')";
					$result=mysqli_query($con,$query);
					if($result){
						$output='{"status":"success", "remark":"Successfully insert the data"}';
					}else{
						$output='{"status":"failure", "remark":"Something is wrong with query"}';
					}
				}else{
					$output='{"status":"failure", "remark":"Sorry, This category doesnt exist"}';
				}
			}else{
				$output='{"status":"failure", "remark":"Invalid or incomplete category recieved"}';
			}
		}else{
			$output='{"status":"failure", "remark":"Invalid or incomplete description recieved"}';
		}
	}else{
		$output='{"status":"failure", "remark":"Invalid or incomplete url recieved"}';
	}
}else{
	$output='{"status":"failure", "remark":"Invalid or incomplete name recieved"}';
}
echo $output;

mysqli_close($con);
  
?>