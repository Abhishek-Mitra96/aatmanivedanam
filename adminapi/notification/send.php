<?php


require_once '../../include/config.php';
admincheck();

$uid=$_REQUEST["uid"] or die('{"status":"failure","remark":"User is missing"}');
$message=$_REQUEST["message"] or die('{"status":"failure","remark":"Message is missing"}');
$title=rinse($_REQUEST["title"]);
$message=rinse($message);
$size=strlen($message);

$query="select `firebaseid` from `user` where `id`='".$uid."'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);

$firebaseid=$row["firebaseid"];


if($size>0 && strlen($firebaseid)>0)    // if size is more than 1
{
    $obj=new stdClass();
    $obj->title=$title;
    $obj->body=$message;
    $obj->token=$firebaseid;
    $resp=send_notification($obj);
	echo '{"status":"success","remark":"'.$resp.'"}';
}
else
{
	echo '{"status":"success","remark":"Message  not sent '.$query.'"}';

}


mysqli_close($con);
?>