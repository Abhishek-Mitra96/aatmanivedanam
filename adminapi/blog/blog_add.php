<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["name"]) && $_REQUEST["name"]!=""){
	//if(isset($_REQUEST["file"]) && $_REQUEST["file"]!=""){
		if(isset($_REQUEST["description"]) && $_REQUEST["description"]!=""){
			// if(isset($_REQUEST["category_id"]) && $_REQUEST["category_id"]!=""){
				$name=rinse($_REQUEST["name"]);
				$description=rinse($_REQUEST["description"]);
				// $category_id=numOnly($_REQUEST["category_id"]);
				$status=1;
				$blog_date = date("Y-m-d");
				if(isset($_REQUEST["pos"]) && $_REQUEST["pos"]!="")
				{
					$pos = $_REQUEST["pos"];
				}
				else
				{
					$pos = 0;
				}
				// $query="select * from `category_image` where `category_id`=".$category_id;
				// $result=mysqli_query($con,$query);

				// if(mysqli_num_rows($result)==1){
					// if(is_uploaded_file($_FILES["url"]["tmp_name"])){
				 //        $dir="../../".$image_location;
				 //        $myfile="url";
				 //        $obj= upload_file($myfile,$dir);
				        // if($obj->error==0)
				        // {
				            // $url= $obj->file_name;
							$url = "no_url";
				            $query="insert into `blog` (`blog_title`,`blog_description`,`blog_img`,`blog_pos`,`status`,`blog_date`) values ('{$name}', '{$description}', '{$url}', '{$pos}','{$status}','{$blog_date}')";
							$result=mysqli_query($con,$query);
							if($result){
								$output='{"status":"success", "remark":"Successfully insert the data"}';
							}else{
								$output='{"status":"failure", "remark":"Something is wrong with query", "query":"'.$query.'"}';
							}
				        // }else{
				        // 	$output='{"status":"failure", "remark":"'.$obj->message.'"}';
				        // }
				    // }else{
				    // 	$output='{"status":"failure", "remark":"Something wrong with file"}';
				    // }
				// }else{
				// 	$output='{"status":"failure", "remark":"Sorry, This category doesnt exist"}';
				// }
			// }else{
			// 	$output='{"status":"failure", "remark":"Invalid or incomplete category recieved"}';
			// }
		}else{
			$output='{"status":"failure", "remark":"Invalid or incomplete description recieved"}';
		}
	//}else{
	//	$output='{"status":"failure", "remark":"Invalid or incomplete file recieved"}';
	//}
}else{
	$output='{"status":"failure", "remark":"Invalid or incomplete name recieved"}';
}
echo $output;

mysqli_close($con);
  
?>