<?php

    require_once '../../include/config.php';
admincheck();

    //$admin_id=$_REQUEST['admin_id'];
    $cat_id=$_REQUEST['cat_id'];
    $img_id=$_REQUEST['img_id'];
    $name=$_REQUEST['name'];
    $priority=$_REQUEST['priority'];
    $description=$_REQUEST['description'];
    $colors=$_REQUEST['colors'];
    $cod_avail=$_REQUEST['cod_avail'];
    $price=$_REQUEST['price'];
    $quantity=$_REQUEST['quantity'];
    $id=$_REQUEST['id'];

  $query="UPDATE `product` SET  `cat_id` = '{$cat_id}', `img_id` = '{$img_id}', `name` = '{$name}', `priority` = '{$priority}', `description` = '{$description}', `colors` = '{$colors}', `price` = '{$price}', `quantity` = '{$quantity}', `product_id` = '3' WHERE `id` = '{$id}'";


    if(mysqli_query($con,$query))
    {
       echo 1;
    }
    else
    {
       echo 2;
    }
?>