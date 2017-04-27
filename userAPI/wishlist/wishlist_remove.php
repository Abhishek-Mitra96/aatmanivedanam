<?php

require_once '../../include/config.php';
logincheck();

$user_id=numOnly($_REQUEST["user_id"]);
$video_id=0;
$audio_id=0;
$image_id=0;
$event_id=0;

$count=0;

if(isset($_REQUEST["video_id"]) && $_REQUEST["video_id"]!="" && $_REQUEST["video_id"]!=0){
	$video_id=$_REQUEST["video_id"];
	$count+=1;
}
if(isset($_REQUEST["audio_id"]) && $_REQUEST["audio_id"]!="" && $_REQUEST["audio_id"]!=0){
	$audio_id=$_REQUEST["audio_id"];
	$count+=1;
}
if(isset($_REQUEST["image_id"]) && $_REQUEST["image_id"]!="" && $_REQUEST["image_id"]!=0){
	$image_id=$_REQUEST["image_id"];
	$count+=1;
}
if(isset($_REQUEST["event_id"]) && $_REQUEST["event_id"]!="" && $_REQUEST["event_id"]!=0){
	$event_id=$_REQUEST["event_id"];
	$count+=1;
}
if($count==1){
	$query="select * from `wishlist` where `user_id`='{$user_id}' and `video_id`='{$video_id}' and `audio_id`='{$audio_id}' and `image_id`='{$image_id}' and `event_id`='{$event_id}' ";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1){
		//we can add this data to wishlist
		$row=mysqli_fetch_assoc($result);
		$wishlist_id=$row["wishlist_id"];

		$query="delete from `wishlist` where `wishlist_id`='".$wishlist_id."'";
		$result=mysqli_query($con,$query);
		if($result){
			$output='{"status":"success", "remark":"successfully removed from wishlist"}';
		}else{
			$output='{"status":"failure", "remark":"Sorry, query has some problem"}';
		}
	}else{
		$output='{"status":"failure", "remark":"Sorry, This is not in wishlist"}';
	}
}else{
	$output='{"status":"failure", "remark":"Invalid or incomplete parameter recieved"}';
}

echo $output;
mysqli_close($con);

?>