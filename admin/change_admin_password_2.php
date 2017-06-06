<?php

require_once '../include/config.php';
  
if(isset($_POST['submit']))
{

      $id=$_POST['hid_id'];
      $password= md5($_POST['password']);
      //$status= $_POST['status'];

     /* if(!file_exists($_FILES['brand_image']['tmp_name']) || !is_uploaded_file($_FILES['brand_image']['tmp_name'])) 
      {
              $brand_image= $_REQUEST['brand_image_current'];
      }
      else
      {
            $dir=$brand_img_location;
            $myfile = "brand_image";
            // list($msg,$name)= upload_file($myfile, "../".$dir);
            $obj = upload_file($myfile, "../".$dir);

            $query="select `brand_image` from `brand` where `brand_id`=".$id;
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_array($result);
            // error_log($query);
            $img=$row["brand_image"];
            if($obj->error==0)
            {
              if($img!="")
              {
                $r=str_replace($hostname,"", $img);
                unlink("../".$r);
                // error_log($r);
              }
              $brand_image = $hostname.$dir.$obj->file_name;
            }
            else
            {
              redirect_to("brand_edit.php?id=".$id."&success=false&message=".$obj->message);
              die();
            }
            // echo $obj->message;

      }*/

         
        $query="UPDATE `admin_user` SET `password` = '{$password}' WHERE `id` = {$id}";
         
        mysqli_query($con,$query);
        
             
        
         $result_value = mysqli_affected_rows($con);
         
          if($result_value==1)
              {
              redirect_to("view_admin.php?success=true");
              }
          else
          {
            redirect_to("change_admin_password.php?id=".$id."&success=false&message=passworddidnotchange");
            error_log($query);
          }
    
}
?>