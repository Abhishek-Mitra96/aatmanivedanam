<?php

function smsNotificationSettings()
{
    global $con;

    $query="select `setting_title`,`value` from `settings` where `setting_title` like '%sms_%' or `setting_title` like '%notification_%' or `setting_title`='admin_mobile'";
    $result=mysqli_query($con,$query);
    $output="{";
    while($r = mysqli_fetch_assoc($result)) 
    {
        $output.='"'.$r["setting_title"].'":"'.$r["value"].'",';
    }
    $output=substr($output,0,strlen($output)-1).'}';
    // return json_encode($rows);
    return $output;

/*Sample output

{"sms_balance":"100","sms_expiry":"2016-10-30","sms_new_order":"1","sms_process_order":"1","sms_dispatch_order":"1","sms_deliver_order":"1","sms_cancel_order":"1"}

*/
}

function shippingSettings()
{
    global $con;

    $query="select `setting_title`,`value` from `settings` where `setting_title` in ('min_purchase_amount','shipping_charge')";
    $result=mysqli_query($con,$query);
    $output="{";
    while($r = mysqli_fetch_assoc($result)) 
    {
        $output.='"'.$r["setting_title"].'":"'.$r["value"].'",';
    }
    $output=substr($output,0,strlen($output)-1).'}';

    return $output;


}

function templates()
{
    global $con;

    $query="select `setting_title`,`value` from `settings` where `setting_title` like '%_template%'";
    $result=mysqli_query($con,$query);
    $output="{";
    while($r = mysqli_fetch_assoc($result)) 
    {
        $output.='"'.$r["setting_title"].'":"'.$r["value"].'",';
    }
    $output=substr($output,0,strlen($output)-1).'}';
    // return json_encode($rows);
    return $output; 

}

function generalSettings()
{
    global $con;

    $query="select `setting_title`,`value` from `settings` where `setting_title` in ('auto_approve_user','screenshot_allowed','manage_inventory','cod_allowed','online_payment','tax_applicable','loyalty_management','loyalty_merchant_key')";
    $result=mysqli_query($con,$query);
    $output="{";
    while($r = mysqli_fetch_assoc($result)) 
    {
        $output.='"'.$r["setting_title"].'":"'.$r["value"].'",';
    }
    $output=substr($output,0,strlen($output)-1).'}';
    // return json_encode($rows);
    return $output; 

}

function appSettings()
{
    global $con,$multiple_add_cart;

    $query="select `setting_title`,`value` from `settings` where `setting_title` in ('screenshot_allowed','cod_allowed','online_payment')";
    $result=mysqli_query($con,$query);
    $output="{";
    while($r = mysqli_fetch_assoc($result)) 
    {
        $output.='"'.$r["setting_title"].'":"'.$r["value"].'",';
    }
    $output.='"multiple_add_to_cart":"'.$multiple_add_cart.'"}';
    // $output=substr($output,0,strlen($output)-1).'}';
    // return json_encode($rows);
    return $output; 

}

function manageInventory()
{
    global $con;

    $query="select `value` from `settings` where `setting_title`='manage_inventory'";
    $result=mysqli_query($con,$query);
    $r = mysqli_fetch_assoc($result);
    return ($r["value"]=="1")?"true":"false";

}

function isTaxApplicable()
{
    global $con;

    $query="select `value` from `settings` where `setting_title`='tax_applicable'";
    $result=mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);

    return $row["value"];
}
function checkAutoApprove()
{
    global $con;
    $query="select `value` from `settings` where `setting_title`='auto_approve_user'";
   $result = mysqli_query($con,$query);
   $rr=mysqli_fetch_array($result);

   if($rr["value"]==1)
      $status=1;
    else
      $status=0;

  return $status;
}

function shippingAmount($obj)
{
    global $con;

    $amount=$obj->amount;

    $query="select `setting_title`,`value` from `settings` where `setting_title` in ('shipping_charge','min_purchase_amount')";
    $result=mysqli_query($con,$query);

    while($r = mysqli_fetch_array($result)) 
    {
        if($r["setting_title"]=="shipping_charge")
            $shipping_charge=$r["value"];
        elseif ($r["setting_title"]=="min_purchase_amount") 
            $min_purchase_amount=$r["value"];
    }

    // return $shipping_charge." and shppoing amoutn is ".$min_purchase_amount;

    if($amount<$min_purchase_amount)
        return $shipping_charge;
    else
        return 0;

}

?>