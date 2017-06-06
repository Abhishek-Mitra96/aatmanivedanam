 <?php
    require_once '../../include/config.php';
admincheck();

    $id = $_REQUEST['id'];
    
    
    $query1 =   "SELECT * FROM `product` WHERE `id` = {$id}";
    $result1    =   mysqli_query($con,$query1);
    $row    =  mysqli_fetch_array($result1);
    
    $img=$row["img_set1"];
    deleteImage($img);

    $img=$row["img_set2"];
    deleteImage($img);

    $img=$row["img_set3"];
    deleteImage($img);

    $img=$row["img_set4"];
    deleteImage($img);

    $img=$row["img_set5"];
    deleteImage($img);
    
    
    $query2="DELETE FROM `product` WHERE `id` = {$id}";
     $result2=mysqli_query($con,$query2);
     
    $query2="DELETE FROM `product_class` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `product_color` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `product_details` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `product_school` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `product_size` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    $query2="DELETE FROM `cart` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);

    $query2="DELETE FROM `wishlist` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);

    $query2="DELETE FROM `stock` WHERE `product_id` = {$id}";
     $result2=mysqli_query($con,$query2);
    
    // $output='{"status":"success","remark":"'.$img.'"}';
    $output='{"status":"success","remark":"Product deleted successfully"}';
    echo $output;

    mysqli_close($con);
 ?>
