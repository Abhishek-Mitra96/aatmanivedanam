<?php
session_start();
require_once '../../include/config.php';
if(isset($_POST['username']) && isset($_POST['password']))
{
    //$name=mysql_real_escape_string(strip_tags($_POST['username']));
   // $password=md5(mysql_real_escape_string(strip_tags($_POST['password'])));
     

	$name=strip_tags($_POST['username']);
    $password=md5($_POST['password']);	 
        

	$query="select * from `admin_user` where `name`='".$name."' and `password`='".$password."'";
	$res=mysqli_query($con,$query);

	$count=mysqli_num_rows($res);
	if($count==1)
	{
		$row=mysqli_fetch_assoc($res);
		if($row['name']==$name && $row['password']==$password)
		{
			
                  
                // $result_url="http://dna.goyalsoftwares.com/getSettings.php?company_id={$company_id}";
                // $ch = curl_init();  
                // curl_setopt($ch,CURLOPT_URL,$result_url);
                // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
                // curl_setopt($ch,CURLOPT_HEADER, false); 
                // $result=curl_exec($ch);
                // curl_close($ch);

                // $val= json_decode($result);
                    
                // $_SESSION['wishlist']=$val->wishlist;
                // $_SESSION['inventory']=$val->inventory;
                // $_SESSION['reviews']=$val->reviews;
                // $_SESSION['pincode']=$val->pincode;
                // $_SESSION['payment']=$val->payment;
                // $_SESSION['shipping']=$val->shipping;
                // $_SESSION['order']=$val->order_set;
                // $_SESSION['cart']=$val->cart;
                // $_SESSION['user']=$val->user;
                // $_SESSION['no_of_products']=$val->no_of_products;

             //    
                 
                $_SESSION["user_type"]="admin";
                 
                $_SESSION['id']=$row['id'];
                $_SESSION['sess_user']=$row['name'];
			
                        
                        
                        
                        echo 1;
		}
	}
	else
	{
		echo 'Sorry ! Your name or password did not match';
	}
}
?>