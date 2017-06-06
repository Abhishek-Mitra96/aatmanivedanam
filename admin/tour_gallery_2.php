<?php

include_once '../include/config.php';

admincheck();

if(isset($_POST['submit']))
{
	$tour_id=numOnly($_POST["tour_id"]);

	// echo sizeof($_FILES);
	
	$query = '';	
	$query="INSERT INTO `gallery_pics`(`tour_id`, `image`) VALUES ";
	
	for($i=0;$i<count($_FILES['images']['tmp_name']);$i++)
	{
	    $img[$i]= "";
	    if(is_uploaded_file($_FILES["images"]["tmp_name"][$i]))
	    {
	        $dir=$tour_img_location;
	        $myfile_1="images";
	        $obj= upload_file_modified($myfile_1, "../".$dir,614400,$i); // set max file size limit to 600 KB;

			if($obj->error==0)
	        {
				
	            $img[$i]= $hostname.$dir.$obj->file_name;
	            $query.=" ('".$tour_id."','".$img[$i]."'),";
	        }
	    }
	}

	$query=substr($query,0,strlen($query)-1);

	mysqli_query($con,$query);
	//redirect_to("dashboard.php"); update by nazish on 3feb
	redirect_to("tour.php");
}
mysqli_close($con);
?>