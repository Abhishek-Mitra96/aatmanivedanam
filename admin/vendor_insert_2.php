<?php

require_once '../include/config.php';

if(isset($_POST['submit'])){
        

        $vendor_name= $_POST['vendor_name'];
        $vendor_mobile= $_POST['vendor_mobile'];
        $vendor_email= $_POST['vendor_email'];
        $registered_on=date("Y-m-d");
        $country_id = $_POST['country_id'];
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
        
        echo $query="INSERT INTO `vendor` "
                . "(`name`, `email`, `mobile`,`registered_on`,`country_id`, `org_name`, `work_email`, `personal_email`, `landline`, `bank_name`, `ac_no`, `ifsc`, `swift_code`, `branch_name`, `account_type`, `pan`, `iec`) "
                . "VALUES "
                . "('{$vendor_name}', '{$vendor_email}', '{$vendor_mobile}', '{$registered_on}', '{$country_id}', '{$org_name}', '{$work_email}', '{$personal_email}', '{$landline}', '{$bank_name}', '{$ac_no}', '{$ifsc_code}',  '{$swift_code}', '{$branch_name}', '{$ac_type}',  '{$pan_no}', '{$iec}')";
                
        $result=mysqli_query($con,$query);
    
        $result_value=mysqli_affected_rows($con);
        if($result_value==1)
        {
            redirect_to("vendor.php");
        }
        else
        {
           echo 1;
        }

        
        
        
}
?>