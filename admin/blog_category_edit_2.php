<?php

include_once '../include/config.php';

    $id=$_POST['cat_id'];

    $query="select `category_image` from `blog_category` where `blog_cat_id`=".$id;
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    // error_log($query);
    $img=$row["category_image"];

    if(!file_exists($_FILES['category_image']['tmp_name']) || !is_uploaded_file($_FILES['category_image']['tmp_name'])) 
    {
        $category_image= $img;  
    }
    else
    {

             //upload new image
            $dir=$blog_cat_img_location;
            $myfile="category_image";

            $obj= upload_file($myfile,"../".$dir);

            //remove current image
            if($obj->error==0)
            {
                if($img!="")
                {
                  $r=str_replace($hostname,"", $img);
                  unlink("../".$r);
                  // error_log($r);
                }
                $category_image = $hostname.$dir.$obj->file_name ;   
            }
            else
            {
              redirect_to("blog_category_edit.php?id={$id}&success=false&message=".$obj->message);
              die();
            }

            
    }
    
            
            
            
        if(isset($_POST['submit'])){


// $id=$_POST['id'];
// $parent_id=$_POST['parent_id'];
$category_name=$_POST['category_name'];
//$small_description=$_POST['small_description'];
//$full_description=$_POST['full_description'];
//$category_image=$_POST['category_image'];
//$category_icon=$_POST['category_icon'];
//$url=$_POST['url'];
// $url=str_replace(' ', '-', $category_name);


//$category_priority=$_POST['category_priority'];
$status=$_POST['status'];

    
    $query="UPDATE `blog_category` SET "
            . "`category_name` = '{$category_name}', "
            . "`category_image` = '{$category_image}', "
            . "`status` = '{$status}' "
            . "WHERE "
            . "`blog_cat_id` = {$id};";
    
//    echo $query;
//    die();
    
    $result = mysqli_query($con,$query);
    
    $result_value=mysqli_affected_rows($con);
    if($result_value==1)
        {
        redirect_to("blog_category.php?success=true");
        }
    else
    {
        error_log($query);
      redirect_to("blog_category_edit.php?id={$id}&success=false");
    }

}

mysqli_close($con);
?>