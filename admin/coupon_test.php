<?php 
require_once '../include/config.php';
// object list : coupon_code, total_amount, total_quantity, user_id, tour_id
$obj=(object)$_REQUEST;

echo $result=couponApply($obj);

?>
