<?php

require_once '../include/config.php';

if(isset($_POST['submit'])){
        
        
        $inclusion_name= $_POST['inclusion_name'];
        
        $query="INSERT INTO `inclusion` "
                . "(`inc_name`) "
                . "VALUES "
                . "('{$inclusion_name}')";
                
                
        $result=mysqli_query($con,$query);
    
        $result_value=mysqli_affected_rows($con);
        if($result_value==1)
        {
                     redirect_to("inclusion.php?success=true");


        }
        else
        {
            redirect_to("inclusion.php?success=false");
           // echo 1;
        }

        
        
        
}
?>