<?php
include_once '../../include/config.php';

admincheck();

//url:http://localhost/ecommerce/admin/adminapi/product/product_view_by_category_id.php?cat_id=0
$query="select * from `user` ";

$q=mysqli_query($con,$query);

$count=mysqli_num_rows($q);

$users=array();
if($count>0)
{
   while($row=mysqli_fetch_assoc($q))
   {
     $users[]=$row;
   }

   echo '{"status":"success", "users": '.json_encode($users).'}';
}
else
{
	echo '["status":"error", "remarks":"tour not found"]';
}
?>