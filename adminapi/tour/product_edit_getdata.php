<?php 
 require_once '../../include/config.php';
 $id=$_REQUEST['id'];
 $query="select * from `product` where `id`='".$id."'";
 $q=mysqli_query($con,$query);
 $product=array();
 $count=mysqli_num_rows($q);
 while($row=mysqli_fetch_assoc($q))
 {
   $product[]=$row;
 }
 echo json_encode($product);
?>