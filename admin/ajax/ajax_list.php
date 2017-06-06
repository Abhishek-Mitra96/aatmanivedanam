<?php
require_once '../../include/config.php';
//mysqli_close($con);


if($_POST['tag'] == 'category')
{
	if($_POST['status'] != 3)
	{
		$query = "select * from category where status = ".$_POST['status'];
		$category_query = mysqli_query($con,$query); 
		while($category_details = mysqli_fetch_assoc($category_query))
		{
			$details[] = $category_details;	
		}
	}
	else
	{
		$query = "select * from category";
		$category_query = mysqli_query($con,$query); 
		while($category_details = mysqli_fetch_assoc($category_query))
		{
			$details[] = $category_details;	
		}
	}
    $output.=json_encode($details);
	$return='{"status":"success","categories":'.$output."}";
	echo $return;
	die();
	return $return;
	
}
  
 ?>