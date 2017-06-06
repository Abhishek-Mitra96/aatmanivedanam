<?php

require_once '../include/config.php';
  
if(isset($_POST['submit']))
{
      $id=$_POST['vendor_id'];
      $vendor_name= $_POST['vendor_name'];
      $vendor_mobile= $_POST['vendor_mobile'];
      $vendor_email= $_POST['vendor_email'];
      $country_id=$_POST["country_id"];
      // $status= $_POST['status'];
	 	$org_name = rinse($_POST['organization_name']);
		$work_email = rinse($_POST['work_email']);
		$personal_email = rinse($_POST['personal_email']);
		$landline = rinse($_POST['landline']);
		$bank_name = rinse($_POST['bank_name']);
		$ac_no = rinse($_POST['ac_no']);
		$ifsc_code = rinse($_POST['ifsc_code']);
		$swift_code = rinse($_POST['swift_code']);
		$branch_name = rinse($_POST['branch_name']);
		$ac_type = rinse($_POST['ac_type']);
		$pan_no = rinse($_POST['pan_no']);
		$iec = rinse($_POST['iec']);
         
        $query="UPDATE `vendor` SET `name` = '{$vendor_name}', `mobile` = '{$vendor_mobile}',`email` = '{$vendor_email}',`country_id`='{$country_id}' ,`org_name`='{$org_name}',`work_email`='{$work_email}',`personal_email`='{$personal_email}',`landline`='{$landline}',`bank_name`='{$bank_name}',`ac_no`='{$ac_no}',`ifsc`='{$ifsc_code}',`swift_code`='{$swift_code}',`branch_name`='{$branch_name}',`account_type`='{$ac_type}',`pan`='{$pan_no}',`iec`='{$iec}' WHERE `vendor_id` = {$id}";
         
        mysqli_query($con,$query);
        
             
        
         $result_value = mysqli_affected_rows($con);
         
          if($result_value==1)
              {
              redirect_to("vendor.php?success=true");
              }
          else
          {
            redirect_to("vendor_edit.php?id=".$id."&success=false&message=".$obj->message);
            error_log($query);
          }
    
}
?>