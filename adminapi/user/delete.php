 <?php
    require_once '../../include/config.php';
admincheck();

    $id = $_REQUEST['id'];
    
    $query2="DELETE FROM `address` WHERE `user_id` = {$id}";
     $result2=mysqli_query($con,$query2);
     
    $query2="DELETE FROM `cart` WHERE `user_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `messages` WHERE `user_id` = {$id}";
     $result2=mysqli_query($con,$query2);

    $query2="DELETE p FROM payment_details p left join order_management o on p.orderNo=o.orderNo where o.user_id = {$id}";
     $result2=mysqli_query($con,$query2);

     $query2="DELETE s FROM shipping_details s left join order_management o on s.orderNo=o.orderNo where o.user_id = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `order_management` WHERE `user_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `user` WHERE `id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `wishlist` WHERE `user_id` = {$id}";
     $result2=mysqli_query($con,$query2);

    // $output='{"status":"success","remark":"'.$img.'"}';
    $output='{"status":"success","remark":"User deleted successfully"}';
    echo $output;

    mysqli_close($con);
 ?>
