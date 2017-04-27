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
        $dir=$tour_img_location;
        $myfile_1="img1";
        $obj= upload_file($myfile_1, "../".$dir);
        if($obj->error==0)
        {
            $img1= $hostname.$dir.$obj->file_name;
        }
    }

$cat_id=$_POST["category_id"];

$vendor_id = $_POST['vendor_id'];
$country_id = $_POST['country_id'];

$tour_name=$_POST['tour_name'];

/*change by nazish on 3feb*/
$video_url=$_POST['video_url'];
$tour_tag=$_POST['tour_tag'];
$start_date=date("Y-m-d",strtotime($_POST['start_date'])); 
$price=$_POST['price'];
$discount=$_POST['discount'];
$price_usd=$_POST['price_usd'];
$discount_usd=$_POST['discount_usd'];
$stock=$_POST['stock'];
$status=1;
/*upto this part*/

$visibility=$_POST['visibility'];
$description=$_POST['description'];
$itinerary=$_POST['itinerary'];
$faq=$_POST['faq'];
$details=$_POST['details'];
$start_location=$_POST['start_location'];

$net_amount=netRate($price,$discount);
$net_amount_usd=netRate($price_usd,$discount_usd);


//check upload tour limit end   

$query="INSERT INTO `tour`"
        . " (`vendor_id`,`cat_id`, `img1`, "
        . "`tour_name`, `start_date`, `price`, `discount`, `net_amount`, `price_usd`, `discount_usd`, `net_amount_usd`, `stock`, `status`, `visibility`, `description`, `country_id`, `itinerary`,`faq`,`details`,`start_location`)"
        . " VALUES"
        . " ('{$vendor_id}', '{$cat_id}', '{$img1}',"
        . " '{$tour_name}', '{$start_date}', '{$price}', '{$discount}', '{$net_amount}', '{$price_usd}', '{$discount_usd}', '{$net_amount_usd}', '{$stock}', '{$status}', '{$visibility}', '{$description}', '{$country_id}', '{$itinerary}','{$faq}','{$details}','{$start_location}');";
/*    
$query="INSERT INTO `tour`"
        . " (`vendor_id`,`cat_id`, `img1`, "
        . "`tour_name`, `visibility`, `description`, `country_id`, `itinerary`,`faq`,`details`,`start_location`)"
        . " VALUES"
        . " ('{$vendor_id}', '{$cat_id}', '{$img1}',"
        . " '{$tour_name}', '{$visibility}', '{$description}', '{$country_id}', '{$itinerary}','{$faq}','{$details}','{$start_location}');";
*/
        
  $result=mysqli_query($con,$query);

$tour_id=mysqli_insert_id($con);

//after get the tour id, insert the video url into video table
$query="INSERT INTO `gallery_video` (`tour_id`,`url`) VALUES ('".$tour_id."', '".$video_url."')";
mysqli_query($con,$query);

//add tour_tag into tour_tag table
$tour_tag_arr=split(',',$tour_tag);
$query="INSERT INTO `tour_tag`(`tour_id`, `tour_tag`) VALUES ";
    
    for($i=0;$i<sizeof($tour_tag_arr);$i++) 
    {
        $query.='("'.$tour_id.'","'.clean($tour_tag_arr[$i]).'"),';
    }
    $query=substr($query, 0,strlen($query)-1);
    mysqli_query($con,$query);

if(isset($_POST["inclusions"]) && sizeof($_POST["inclusions"])!=0)
{
    $inclusions=$_POST["inclusions"];
    $query="INSERT INTO `tour_inclusion`(`tour_id`, `inc_id`,`status`) VALUES ";
    
    for($i=0;$i<sizeof($inclusions);$i++) 
    {
        $query.='("'.$tour_id.'","'.$inclusions[$i].'","1"),';
    }
    $query=substr($query, 0,strlen($query)-1);
    mysqli_query($con,$query);
    // echo $query;
}

if(isset($_POST["exclusions"]) && sizeof($_POST["exclusions"])!=0)
{
    $exclusions=$_POST["exclusions"];
    $query="INSERT INTO `tour_inclusion`(`tour_id`, `inc_id`,`status`) VALUES ";
    
    for($i=0;$i<sizeof($exclusions);$i++) 
    {
        $query.='("'.$tour_id.'","'.$exclusions[$i].'","0"),';
    }
    $query=substr($query, 0,strlen($query)-1);
    mysqli_query($con,$query);
    // echo $query;
}


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
         header('Location: tour_gallery.php?id='.$tour_id);
}