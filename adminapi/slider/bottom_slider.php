<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["id"]) && $_REQUEST["id"]!=""){
	$values = explode(",", $_REQUEST["id"]);
	//print count($values) . " values passed.";
	//echo $values[0];
	for($i=0;$i<count($values);$i++){
		$status=1;
		$x=$values[$i];
		//echo $x." ";
		$query="insert into `slider_bottom` (`img_id`,`status`) values ('{$x}','{$status}')";
		$result=mysqli_query($con,$query);
		if($result){
		$output='{"status":"success", "remark":"Successfully inserted the data"}';
		}
		else{
		$output='{"status":"failure", "remark":"Something is wrong with query"}';
		}
		
	}
	echo $output;
	
}