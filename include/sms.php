<?php

function sendSMS($post,$route)
{
    //$post format will be "to=1234567890&text=Hello"

    //only mobile number and text required in $post
    global $sms_username,$sms_password,$sender_id;
    $param = array(
        'username' => $sms_username,
        'password' => $sms_password,
        'senderid' => $sender_id,
        'route' => $route,
        'type' => 'text',
    );
    $p1=$post;
    foreach ($param as $key => $val) {
        $p1 .= '&' . $key . '=' . rawurlencode($val);
    }
    $p1=str_replace("%0D","",$p1);  // remove carriage return from new line which was resulting in one extra character count
    $url = "https://sms.salert.co.in/new/api/api_http.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $p1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Connection: close"));
    $result = curl_exec($ch);
    if(curl_errno($ch)) {
        $result = "cURL ERROR: " . curl_errno($ch) . " " . curl_error($ch);
    } else {
        $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        switch($returnCode) {
            case 200 :
                break;
            default :
                $result = "HTTP ERROR: " . $returnCode;
        }
    }
    curl_close($ch);
    return $result;
}


//get the sms balance of our company account

function ourSMSBalance($route)
{
    global $sms_username,$sms_password;
    $url="http://sms.salert.co.in/new/api/api_http_balance.php?username=".$sms_username."&password=".$sms_password."&route=".$route;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Connection: close"));
    $result = curl_exec($ch);
    $data=json_decode($result,true);
    return $data[0]['balance'];
}

// get No. of SMS that would be consumed

function smsSize($message)
{
    $chars=strlen($message);
    $length=0;
    if($chars==0)
        $length=0;
    elseif($chars>0 && $chars<=160)
        $length=1;
    elseif ($chars>160 && $chars<=306)
        $length=2;
    elseif($chars>306 && $chars<=459)
        $length=3;
    elseif($chars>459 && $chars<=612)
        $length=4;
    elseif($chars>612 && $chars<=765)
        $length=5;
    else
        $length=6;

    return $length;
}

function deductSmsBalance($value)
{
    global $con;
    $q1="UPDATE `settings` SET `value`=`value`-".$value." where `setting_title`='sms_balance'";
    mysqli_query($con,$q1);
}

?>