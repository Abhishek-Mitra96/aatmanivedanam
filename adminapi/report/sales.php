<?php

require_once '../../include/config.php';
admincheck();

if(isset($_REQUEST['date_start']) && isset($_REQUEST['date_stop']))
{
	$arr=Array();
	$total_sale=0;

	$date_start=date("Y-m-d",strtotime($_REQUEST["date_start"]));
	$date_stop=date("Y-m-d",strtotime($_REQUEST["date_stop"]));
	
	$query="SELECT `order_date` as `date`,sum(`amount`) as amount FROM `order_management` where DATE(`order_date`)>='".$date_start."' and DATE(`order_date`)<='".$date_stop."' group by DATE(`order_date`) ORDER BY DATE(`order_date`) desc";
	$result=mysqli_query($con,$query);

	if(mysqli_num_rows($result)==0){
		echo '{"status":"failure","remarks":"No transactions within this date range"}';
	}
	else{
		$output='{"status":"success","summary":';
		while($row=mysqli_fetch_assoc($result))
		{
			$row["date"]=date("d-M-y",strtotime($row["date"]));
			$arr[]=$row;
			$total_sale+=$row["amount"];
		}
		$output.=json_encode($arr);
		unset($arr);

		$output.=',"total_sale":"'.$total_sale.'"}';
		echo $output;

	}
}
else
{
	echo '{"status":"failure","remarks":"Incorrect post response received"}';
}
	mysqli_close($con);

?>