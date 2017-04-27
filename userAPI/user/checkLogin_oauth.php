<?php

require_once '../../include/config.php';
$output="";

if(isset($_REQUEST['social_id']))
{
	$social_id=$_REQUEST["social_id"];
	//$con=mysqli_connect($server,$username,$password,$database) or die ("could not connect to mysql");
	$query="SELECT * FROM `user` where `social_id_facebook`='".$social_id."' or `social_id_google`='".$social_id."'";
	$result=mysqli_query($con,$query);

	//Step 2 : check if social id exists or not

	if(mysqli_num_rows($result)==1)  
	{
		$row=mysqli_fetch_assoc($result);
		$user_id=$row["user_id"];
    	$security_token=$row["security_token"];   //get random security token

		
		$output.='{"status":"ok","user_id":"'.$user_id.'","mobile":"'.$row["mobile"].'","security_token":"'.$security_token.'"}'; //login successful

	}

	//step 3: Incorrect mobile and password combination
	else
	{
		$output.='{"status":"error","remarks":"Incorrect social id received"}'; //login failed
	}


}
else
{
		$output.='{"status":"error","remarks":"Social id is missing"}'; 
}

echo $output;
mysqli_close($con);

// error_log($social_id,0);
?>