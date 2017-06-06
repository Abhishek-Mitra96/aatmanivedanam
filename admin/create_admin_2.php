<?php

include_once '../include/config.php';


if(isset($_POST['submit']))
{
 
    

$name=$_POST["name"];

$password = md5($_POST['password']);

$mobile=$_POST['mobile'];


//Add Admin   
    
$query="INSERT INTO `admin_user`"
        . " (`name`,`password`, `mobile`)"
        . " VALUES"
        . " ('{$name}', '{$password}','{$mobile}');";

        
  $result=mysqli_query($con,$query);
         $_SESSION['nadmin'] = 1;
  
         header('Location:view_admin.php');
}