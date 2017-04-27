<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["name"]) && $_REQUEST["name"]!=""){
	if(isset($_REQUEST["description"]) && $_REQUEST["description"]!=""){
		$name=clean($_REQUEST["name"]);
		$description=clean($_REQUEST["description"]);
		$status=1;

		$query="insert into `category_image` (`name`,`description`,`status`) values ('{$name}','{$description}','{$status}')";
		$result=mysqli_query($con,$query);
		if($result){
			$output='{"status":"success", "remark":"Successfully insert the data"}';
		}else{
			$output='{"status":"failure", "remark":"Something is wrong with query"}';
		}
	}else{
		$output='{"status":"failure", "remark":"Invalid or incomplete description recieved"}';
	}
}else{
	$output='{"status":"failure", "remark":"Invalid or incomplete name recieved"}';
}
echo $output;

mysqli_close($con);
  
?>