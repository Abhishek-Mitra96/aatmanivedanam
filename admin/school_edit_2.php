<?php

require_once '../include/config.php';
  
if(isset($_POST['submit']))
{

      $id=$_POST['school_id'];
      $school_name= $_POST['school_name'];
      $status= $_POST['status'];

      if(!file_exists($_FILES['school_image']['tmp_name']) || !is_uploaded_file($_FILES['school_image']['tmp_name'])) 
      {
              $school_image= $_REQUEST['school_image_current'];
      }
      else
      {
            $dir=$school_img_location;
            $myfile = "school_image";
            // list($msg,$name)= upload_file($myfile, "../".$dir);
            $obj = upload_file($myfile, "../".$dir);

            $query="select `logo` from `school` where `school_id`=".$id;
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_array($result);
            // error_log($query);
            $img=$row["logo"];
            if($obj->error==0)
            {
              if($img!="")
              {
                $r=str_replace($hostname,"", $img);
                unlink("../".$r);
                // error_log($r);
              }
              $school_image = $hostname.$dir.$obj->file_name;
            }
            else
            {
              redirect_to("school_edit.php?id=".$id."&success=false&message=".$obj->message);
              die();
            }
            // echo $obj->message;

      }

         
        $query="UPDATE `school` SET `name` = '{$school_name}', `logo` = '{$school_image}',`status` = '{$status}' WHERE `school_id` = {$id}";
         
        mysqli_query($con,$query);
        
             
        
         $result_value = mysqli_affected_rows($con);
         
          if($result_value==1)
              {
              redirect_to("school.php?success=true");
              }
          else
          {
            redirect_to("school_edit.php?id=".$id."&success=false&message=".$obj->message);
            error_log($query);
          }
    
}
?>