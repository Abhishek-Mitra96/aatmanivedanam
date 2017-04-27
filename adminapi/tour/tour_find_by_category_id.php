<?php
include_once '../../include/config.php';

admincheck();

//url:http://localhost/ecommerce/admin/adminapi/product/product_view_by_category_id.php?cat_id=0
$category_id=$_REQUEST['category_id'];
$query="select * from `tour` ";
if($category_id!=0) $query.="where `cat_id`='{$category_id}'";

$q=mysqli_query($con,$query);

$count=mysqli_num_rows($q);

$tours=array();
if($count>0)
{
   while($row=mysqli_fetch_assoc($q))
   {
     $tours[]=$row;
   }

   echo '{"status":"success", "tours": '.json_encode($tours).'}';
}
else
{
	echo '["status":"error", "remarks":"tour not found"]';
}
?>