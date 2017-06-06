<?php

include_once '../include/config.php';

    $id=$_POST['blog_id'];

    $query="select `blog_image` from `blog` where `blog_id`=".$id;
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    // error_log($query);
    $img=$row["blog_image"];

    if(!file_exists($_FILES['img1']['tmp_name']) || !is_uploaded_file($_FILES['img1']['tmp_name'])) 
    {
        $blog_image= $img;  
    }
    else
    {

             //upload new image
            $dir=$blog_img_location;
            $myfile="blog_image";

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
                $blog_image = $hostname.$dir.$obj->file_name ;   
            }
            else
            {
              redirect_to("blog_edit.php?id={$id}&success=false&message=".$obj->message);
              die();
            }

            
    }
    
            
            
            
        if(isset($_POST['submit'])){


// $id=$_POST['id'];
// $parent_id=$_POST['parent_id'];
$blog_title=$_POST['blog_title'];
$cat_id=$_POST['cat_id'];
$description=$_POST['description'];
//$full_description=$_POST['full_description'];
//$category_image=$_POST['category_image'];
//$category_icon=$_POST['category_icon'];
//$url=$_POST['url'];
// $url=str_replace(' ', '-', $category_name);


//$category_priority=$_POST['category_priority'];
$status=$_POST['visibility'];

    
    $query="UPDATE `blog` SET "
            . "`title` = '{$blog_title}', "
            . "`blog_image` = '{$blog_image}', "
            . "`blog_cat_id` = '{$cat_id}', "
            . "`description` = '{$description}', "
            . "`status` = '{$status}' "
            . "WHERE "
            . "`blog_id` = {$id};";
    
//    echo $query;
//    die();
    
    $result = mysqli_query($con,$query);
    
    echo $query;

    $result_value=mysqli_affected_rows($con);
    if($result_value==1)
        {
        redirect_to("blog.php?success=true");
        }
    else
    {
        error_log($query);
      redirect_to("blog_edit.php?id={$id}&success=false");
    }

}

mysqli_close($con);
?>