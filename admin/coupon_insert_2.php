<?php
include_once '../include/config.php';
admincheck();

if(isset($_POST['submit'])){
    $coupon_code=strtoupper($_POST["coupon_code"]);
    $coupon_detail=$_POST['coupon_detail'];

    $valid_from_date=date("Y-m-d",strtotime($_POST['valid_from_date']));
    $valid_from_time=date("H:i:s",strtotime($_POST['valid_from_time']));
    $valid_till_date=date("Y-m-d",strtotime($_POST['valid_till_date']));
    $valid_till_time=date("H:i:s",strtotime($_POST['valid_till_time']));
    
    $min_quantity=$_POST['min_quantity'];

    $min_amount=$_POST['min_amount'];  
    $discount_type=$_POST['discount_type'];
    $discount=$_POST["discount"];
    $max_discount=$_POST['max_discount'];

    $min_amount_usd=$_POST['min_amount_usd'];  
    $discount_type_usd=$_POST['discount_type_usd'];
    $discount_usd=$_POST["discount_usd"];
    $max_discount_usd=$_POST['max_discount_usd'];

    $max_use=$_POST['max_use'];
    $max_use_global=$_POST['max_use_global'];

    $first_purchase_only=$_POST['first_purchase_only'];
    $status=1;

    $category_list=array();
    $tour_list=array();
    $user_list=array();
    $not_user_list=array();

    $category_for_all=$_POST["category_for_all"];
    $category_list=$_POST["category_list"];

    $tour_for_all=$_POST["tour_for_all"];
    $tour_list=$_POST["tour_list"];

    $user_for_all=$_POST["user_for_all"];
    $user_list=$_POST["user_list"];  
    $not_user_list=$_POST["not_user_list"];

    $query="SELECT * FROM `coupon_management` where `coupon_code`='".$coupon_code."'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==0){
        //code code is not present then, do all things
        $query="INSERT INTO `coupon_management`"

                . "( `coupon_code`, `coupon_detail`, `valid_from_date`, `valid_from_time`, `valid_till_date`, `valid_till_time`, `min_quantity`, `min_amount`, `discount_type`, `discount`, `max_discount`, `min_amount_usd`, `discount_type_usd`, `discount_usd`, `max_discount_usd`, `max_use`, `max_use_global`, `first_purchase_only`, `status` )"

                . " VALUES"

                . " ('{$coupon_code}', '{$coupon_detail}', '{$valid_from_date}', '{$valid_from_time}', '{$valid_till_date}', '{$valid_till_time}', '{$min_quantity}', '{$min_amount}', '{$discount_type}', '{$discount}', '{$max_discount}', '{$min_amount_usd}', '{$discount_type_usd}', '{$discount_usd}', '{$max_discount_usd}', '{$max_use}', '{$max_use_global}', '{$first_purchase_only}', '{$status}' );";
        
        $result=mysqli_query($con,$query);
        $coupon_id=mysqli_insert_id($con);

        //insert into coupon_category
        if($category_for_all=="1"){
            //nothing happen
        }else{
            //means admin choose selected category list
            if(sizeof($category_list)==0){
                //admin not choose any list, return error
                //return header('Location: coupon_insert.php?error=1');
            }else{
                //good, now insert every category in coupon_category table
                for($i=0;$i<sizeof($category_list);$i++){
                    $query='iNSERT INTO `coupon_category` ( `coupon_id`, `category_id`) VALUES ('.$coupon_id.', '.$category_list[$i].') ';
                    mysqli_query($con,$query);
                }
            }
        }

        //insert into coupon_tour
        if($tour_for_all=="1"){
            //nothing happen
        }else{
            //means admin choose selected tour list
            if(sizeof($tour_list)==0){
                //admin not choose any list, return error
                //return header('Location: coupon_insert.php?error=2');
            }else{
                //good, now insert every tour in coupon_tour table
                for($i=0;$i<sizeof($tour_list);$i++){
                    $query='iNSERT INTO `coupon_tour` ( `coupon_id`, `tour_id`) VALUES ('.$coupon_id.', '.$tour_list[$i].') ';
                    mysqli_query($con,$query);
                }
            }
        }

        //insert into coupon_user
        if($user_for_all=="1"){
            //nothing happen
            //echo "yes";
        }else{
            //means admin choose selected user list
            if(sizeof($user_list)==0){
                //admin not choose any list, return error
                //return header('Location: coupon_insert.php?error=3');
            }else{
                //good, now insert every user in coupon_user table
                for($i=0;$i<sizeof($user_list);$i++){
                    $query='iNSERT INTO `coupon_user` ( `coupon_id`, `user_id`) VALUES ('.$coupon_id.', '.$user_list[$i].') ';
                    mysqli_query($con,$query);
                }
            }
        }

        //insert into coupon_not_user
        if(sizeof($not_user_list)==0){
            //admin not choose any list, return error
            //echo "select ".$not_user_list;
        }else{
            //good, now insert every not_user in coupon_not_user table
            //echo "good".$not_user_list;
            for($i=0;$i<sizeof($not_user_list);$i++){
                $query='iNSERT INTO `coupon_user_not` ( `coupon_id`, `user_id`) VALUES ('.$coupon_id.', '.$not_user_list[$i].') ';
                mysqli_query($con,$query);
            }
        }
        //echo 1;
        return header('Location: coupon.php');
    }else{
        //coupon_code present , send an error
        return header('Location: coupon_insert.php?error=0');
    }

}

?>