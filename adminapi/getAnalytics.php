<?php

require_once '../include/config.php';

$output="";


// get number of admins

$query="select count(*) as count from `admin_user`";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$count=$row["count"];

$output.='{"admins":"'.$count.'",';



//get statistics of users

$query="SELECT count(*) as count, `status` FROM `user` group by `status`";
$result=mysqli_query($con,$query);
while ($row=mysqli_fetch_array($result)) {
	switch ($row["status"]) {
		case 0:
			$output.='"unverified_users":"'.$row["count"].'",';
			break;
		case 1:
			$output.='"verified_users":"'.$row["count"].'",';
			break;
		case -1:
			$output.='"blocked_users":"'.$row["count"].'",';
			break;
	}
}


// get today's order statistics

$today=date("Y-m-d");

$query="select count(*) as count,`order_status` as status from `order_management` where `order_date` like '".$today."%' group by `order_status`";
$result=mysqli_query($con,$query);
$count=0;

while ($row=mysqli_fetch_array($result)) {
	switch ($row["status"]) {
		case 0:
			$output.='"today_new_order":"'.$row["count"].'",';
			break;
		case 1:
			$output.='"today_processed_order":"'.$row["count"].'",';
			break;
		case 2:
			$output.='"today_dispatched_order":"'.$row["count"].'",';
			break;
		case 3:
			$output.='"today_delivered_order":"'.$row["count"].'",';
			break;
		case -1:
			$output.='"today_cancelled_order":"'.$row["count"].'",';
			break;
	}
	$count+=$row["count"];
}

$output.='"total_today_orders":"'.$count.'",';

//get total order statistics

$count=0;
$query="select count(*) as count,`order_status` as status from `order_management` group by `order_status`";
$result=mysqli_query($con,$query);

while ($row=mysqli_fetch_array($result)) {
	switch ($row["status"]) {
		case 0:
			$output.='"total_new_order":"'.$row["count"].'",';
			break;
		case 1:
			$output.='"total_processed_order":"'.$row["count"].'",';
			break;
		case 2:
			$output.='"total_dispatched_order":"'.$row["count"].'",';
			break;
		case 3:
			$output.='"total_delivered_order":"'.$row["count"].'",';
			break;
		case -1:
			$output.='"total_cancelled_order":"'.$row["count"].'",';
			break;
	}
	$count+=$row["count"];
}

$output.='"total_orders":"'.$count.'",';

//get last 10 days order for the graph

$date_earlier=date("Y-m-d",strtotime($today." -10 days"));
$date_next=date("Y-m-d",strtotime($today." +1 days"));
$query="SELECT count(*) as count, `order_date` FROM `order_management` WHERE `order_date`>='{$date_earlier}' and `order_date`<='{$date_next}' group by DATE(`order_date`)";

$result=mysqli_query($con,$query);
while($row=mysqli_fetch_assoc($result))
{
	$row["order_date"]=date("d-M-y",strtotime($row["order_date"]));
	$r[]=$row;
}

$output.='"statistics":';
$output.=json_encode($r);
// $output=substr($output, 0,strlen($output)-1);
$output.="}";
mysqli_close($con);
echo $output;

?>