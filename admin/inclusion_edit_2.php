<?php

require_once '../include/config.php';
  
if(isset($_POST['submit']))
{

      $id=$_POST['inclusion_id'];
      $inclusion_name= $_POST['inclusion_name'];

         
        $query="UPDATE `inclusion` SET `inc_name` = '{$inclusion_name}' WHERE `inc_id` = {$id}";
         
        mysqli_query($con,$query);
        
             
        
         $result_value = mysqli_affected_rows($con);
         
          if($result_value==1)
              {
              redirect_to("inclusion.php?success=true");
              }
          else
          {
            redirect_to("inclusion_edit.php?id=".$id."&success=false&message=".$obj->message);
            error_log($query);
          }
    
}
?>