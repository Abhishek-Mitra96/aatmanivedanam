<?php

require_once '../include/config.php';

if(isset($_POST['submit'])){
        
        
        $country= $_POST['country'];
        $isd_code= $_POST['isd_code'];
        
        $query="INSERT INTO `country` "
                . "(`country`, `isd_code`) "
                . "VALUES "
                . "('{$country}', '{$isd_code}')";
                
                
        $result=mysqli_query($con,$query);
    
        $result_value=mysqli_affected_rows($con);
        if($result_value==1)
        {
                     redirect_to("country.php");


        }
        else
        {
           echo 1;
        }

        
        
        
}
?>