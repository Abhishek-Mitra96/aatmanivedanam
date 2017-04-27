<?php
    session_start();
    
    $server="localhost";
    $username="aatma";
    $password="aatma123";
    $database="aatma";

     //sms related variables

    $sms_username="gs_software";
    $sms_password="gs_software123";
    $sender_id="GOYALS";
    $route="Informative";
       
    date_default_timezone_set('Asia/Kolkata');
    $con=mysqli_connect($server,$username,$password,$database) or die ("could not connect to mysql");
        
    // $company_id=1;
        
    $company_name="Aatmanivedanam";
    $company_vat_no="";
    $company_email="info@aatmanivedanam.com";

    $hostname="http://aatma.goyalsoftwares.com/";
    $image_location="assets/image/";
    $audio_location="assets/audio/";
    $event_image_location="assets/image/event/";

    require_once 'function.php';
    require_once 'sms.php';
    require_once 'settings.php';
?>