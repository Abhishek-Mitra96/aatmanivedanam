<?php
	
require_once '../../include/function.php';
       
//url:http://localhost/ecommerce/admin/adminapi/product/product_view_by_category_id.php?cat_id=0
        $cat_id=$_REQUEST['cat_id'];
	$query="select * from `product` where `cat_id`='{$cat_id}'";

        $q=mysqli_query($con,$query);
        $count=mysqli_num_rows($q);
	if($count>=1)
    {
       while($row=mysqli_fetch_assoc($q))
       {
         $products[]=$row;
       }

       echo json_encode($products);
    }
    else
    {
       $output="[{'status':'error','remark':'Product not available!'}]";
      echo $output;
    }
?>