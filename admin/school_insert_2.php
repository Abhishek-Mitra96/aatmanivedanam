<?php

session_start();
require_once '../include/config.php';

if(isset($_POST['submit']))
{
 
    $school_image="";

    if(file_exists($_FILES['school_image']['tmp_name']) && is_uploaded_file($_FILES['school_image']['tmp_name'])) 
    {
          
  
        // $dir="../assets/image/brand";
        $dir=$school_img_location;
        $myfile="school_image";
        $obj=upload_file($myfile, "../".$dir);
        // die ($msg." -> ".$name);
        if($obj->error==0)
            $school_image = $hostname.$dir.$obj->file_name;
        else
        {
             redirect_to("school_insert.php?status=failure&message=".$obj->message);
             die();
        }
    }
    
    
    $school_name= $_POST['school_name'];
    $status= $_POST['status'];
    
    $query="INSERT INTO `school` "
            . "(`name`, `logo`, `status`) "
            . "VALUES "
            . "('{$school_name}', '{$school_image}', '{$status}')";
            
            
    $result=mysqli_query($con,$query);

    $result_value=mysqli_affected_rows($con);
    if($result_value==1)
    {
                 redirect_to("school.php");


    }
    else
    {
       echo 1;
    }
}
?>