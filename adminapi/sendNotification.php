<?php

require_once '../include/config.php';

$title=$_REQUEST["title"];
$body=$_REQUEST["body"];
$users=$_REQUEST["users"];

$query="select `firebaseid` as token from `user` where `firebaseid`!='' and ";

if($users!="-2")
{
	$query.=" `status`={$users} and ";
}
$query.=" 1";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==0)
	die('{"success":"0"}');
while($row=mysqli_fetch_assoc($result))
{
	$r[]=$row["token"];
}

$message=new stdClass();
$message->title=$title;
$message->body=$body;
$message->registration_ids=$r;

// print_r($r);

$response=send_all_notification($message);
echo $response;
// echo mysqli_num_rows($result);

mysqli_close($con);
?>