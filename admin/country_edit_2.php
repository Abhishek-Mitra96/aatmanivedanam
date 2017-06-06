<?php

require_once '../include/config.php';
  
if(isset($_POST['submit']))
{

      $id=$_POST['id'];
      $country= $_POST['country'];
      $isd_code= $_POST['isd_code'];

         
      $query="UPDATE `country` SET `country` = '{$country}', `isd_code` = '{$isd_code}' WHERE `id` = {$id}";
      mysqli_query($con,$query);

      
       $result_value = mysqli_affected_rows($con);
       
        if($result_value==1)
            {
            redirect_to("country.php?success=true");
            }
        else
        {
          redirect_to("country_edit.php?id=".$id."&success=false&message=".$obj->message);
          error_log($query);
        }
    
}
?>