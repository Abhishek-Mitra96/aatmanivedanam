<?php
// session_start();
include_once '../include/config.php';


if(isset($_POST['submit']))
{
    $error=0;
    $message="";
    if(is_uploaded_file($_FILES["category_image"]["tmp_name"]))
    {
        $dir=$category_img_location;
        $myfile="category_image";
        $obj= upload_file($myfile, "../".$dir);
        $category_image = $hostname.$dir.$obj->file_name ;
        $error=$obj->error;
        $message=$obj->message;
    }
    else
        $category_image="";

    if($error==1)
    {
         redirect_to("category_insert.php?status=failure&message=".$message);
         die();

    }

     //**************** search parent category id ***************************************

if (isset($_POST['primary_category_id']) && $_POST['primary_category_id'] <> 'null') 
{
        $parent_id=$_POST['primary_category_id'] ;
}
 else {
    $parent_id = 0 ;
    }
//echo  $category_id;


//**************** search parent category id  end***************************************
        
        
$category_name=$_POST['category_name'];
$small_description=$_POST['small_description'];
$full_description=$_POST['full_description'];
$status=$_POST['status'];

$query="select max(`position`) as pos from `category` where `parent_id`=".$parent_id;
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);

$pos=$row["pos"];

if($pos==null)
    $pos=1;
else
    $pos+=1;

$query="INSERT ignore INTO `category` "
        . "(`parent_id`, `category_name`, `category_image`,"
        . " `status`,`position`,`small_description`,`full_description`) "
        . "VALUES "
        . "('{$parent_id}', '{$category_name}', '{$category_image}',"
        . "'{$status}',{$pos},'{$small_description}','{$full_description}');";


//echo $query;
//die();
        
        
 $result=mysqli_query($con,$query);
    

//insert the attributes for the category which were checked - Ex- Size, Color, etc.

// $q="select `id` from `category` where `category_name`='".$category_name."'";
// $result=mysqli_query($con,$q);
// $row=mysqli_fetch_array($result);
// $category_id=$row["id"];

// $count_attribute=0;
// if(sizeof($_POST["check_list"])!=0)
// {
//     $query="INSERT INTO `category_attributes`(`cat_id`, `attribute`) VALUES ";
//     foreach($_POST['check_list'] as $check) 
//         {
//             $query.="('".$category_id."','".$check."'),";
//             $count_attribute++;
//         }
// }


//additional attributes

// if($_POST["attributes"]!="")
// {
//     $data=explode(",",$_POST["attributes"]);

//     foreach ($data as $check) 
//     {
//         $query.="('".$category_id."','".$check."'),";
//         $count_attribute++;
//     }
// }
// $query=substr($query, 0,strlen($query)-1);


// execute the query only if more than one attributes are set

// if($count_attribute>0)
// {
//     $result=mysqli_query($con,$query);
//     $result_value=mysqli_affected_rows($con);
// }
    mysqli_close($con);

    // if($result_value>0)
    // {
         redirect_to("category.php?status=success");
    // }
    // else
    // {
    //    // echo 1;
    //      redirect_to("category_insert.php?status=failure");

    // }
}


?>