<?php

include_once '../include/config.php';

admincheck();

if(isset($_POST['submit']))
{
 
    
// for($i=1;$i<=1;$i++)
// {
//     $img_set[$i]= "";
//     if(is_uploaded_file($_FILES["img_set_".$i]["tmp_name"]))
//     {
//         $dir=$tour_img_location;
//         $myfile_1="img_set_".$i;
//         $obj= upload_file($myfile_1, "../".$dir);
//         if($obj->error==0)
//         {
//             $img_set[$i]= $hostname.$dir.$obj->file_name;
//         }
//     }
// }

    $img1= "";
    if(is_uploaded_file($_FILES["img1"]["tmp_name"]))
    {
        $dir=$blog_img_location;
        $myfile_1="img1";
        $obj= upload_file($myfile_1, "../".$dir);
        if($obj->error==0)
        {
            $img1= $hostname.$dir.$obj->file_name;
        }
    }

$cat_id=$_POST["category_id"];

// $vendor_id = $_POST['vendor_id'];
// $country_id = $_POST['country_id'];

$blog_title=$_POST['blog_title'];
$visibility=$_POST['visibility'];
$description=$_POST['description'];
// $itinerary=$_POST['itinerary'];
// $faq=$_POST['faq'];
// $details=$_POST['details'];
// $start_location=$_POST['start_location'];
$blog_date = date("Y-m-d");
//echo $img1."image<br>";
// $net_amount=netRate($price,$discount);


//check upload tour limit end   
    
$query="INSERT INTO `blog`"
        . " (`blog_cat_id`, `blog_image`, "
        . "`title`, `status`, `date`, `description`)"
        . " VALUES"
        . " ('{$cat_id}', '{$img1}',"
        . " '{$blog_title}', '{$visibility}', '{$blog_date}', '{$description}');";

        
  $result=mysqli_query($con,$query);
//echo $query;
// $tour_id=mysqli_insert_id($con);

// if(isset($_POST["inclusions"]) && sizeof($_POST["inclusions"])!=0)
// {
//     $inclusions=$_POST["inclusions"];
//     $query="INSERT INTO `tour_inclusion`(`tour_id`, `inc_id`,`status`) VALUES ";
    
//     for($i=0;$i<sizeof($inclusions);$i++) 
//     {
//         $query.='("'.$tour_id.'","'.$inclusions[$i].'","1"),';
//     }
//     $query=substr($query, 0,strlen($query)-1);
//     mysqli_query($con,$query);
//     // echo $query;
// }

// if(isset($_POST["exclusions"]) && sizeof($_POST["exclusions"])!=0)
// {
//     $exclusions=$_POST["exclusions"];
//     $query="INSERT INTO `tour_inclusion`(`tour_id`, `inc_id`,`status`) VALUES ";
    
//     for($i=0;$i<sizeof($exclusions);$i++) 
//     {
//         $query.='("'.$tour_id.'","'.$exclusions[$i].'","0"),';
//     }
//     $query=substr($query, 0,strlen($query)-1);
//     mysqli_query($con,$query);
//     // echo $query;
// }


// //insert blank stock now

// $obj=new stdClass();
// $obj->tour_id=$tour_id;

// addStock($obj);

// //blank stock entry close


// // add additional attribute data

// $arr=categoryAttributes($cat_id);


// if(sizeof($arr)!=0)
// {
//     $query="INSERT INTO `tour_details`(`tour_id`, `attribute`, `detail`) VALUES ";
//     $count=0;
//     for($i=0;$i<sizeof($arr);$i++)
//     {
//         $x=$arr[$i]["attribute"];
//         if($x=="Size" || $x=="School" || $x=="Color" || $x=="Class");
//         else
//         {
//             $count++;
//             $query.='("'.$tour_id.'","'.$x.'","'.$_POST[$x].'"),';
//         }
//     }
//     $query=substr($query, 0,strlen($query)-1);
//     if($count)
//         mysqli_query($con,$query);
// }

         // header('Location: ' . $_SERVER['HTTP_REFERER']);
         header('Location: blog.php');
}