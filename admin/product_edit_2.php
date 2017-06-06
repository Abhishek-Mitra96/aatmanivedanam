<?php

include_once '../include/config.php';


if(isset($_REQUEST['submit']))
{
 
  $id=$_REQUEST['id'];


  // $cat_id = $category_id;
	$school = $_REQUEST['School'];
	$oldSchool = $_REQUEST['old_school'];
  $brand_id = $_REQUEST['brand_id'];

  $product_name=$_REQUEST['product_name'];
  // $visibility=$_REQUEST['visibility'];
  $description=$_REQUEST['description'];
  // $colors=$_REQUEST['colors'];
  // $cod_availability=$_REQUEST['cod_availability'];
  $price=$_REQUEST['price'];
  $standard_packing=$_REQUEST['standard_packing'];
  $tax=$_REQUEST['tax'];
  $discount=$_REQUEST['discount'];
  $net_amount=netRate($price,$discount);
     
	
	$count = count($school);
	for($i=0; $i<=$count; $i++)
	{
		$x = explode("-", $oldSchool[$i]);
		if($school[$i] != $x[1])
		{
			$delete_query = "DELETE FROM product_school WHERE id=".$x[0];
			$del=mysqli_query($con,$delete_query);
		}	
	}
	
	
		
		
		
  $query="UPDATE `product` "
          . "SET "
          // . "`cat_id` = '{$cat_id}', "
          . "`brand_id` = '{$brand_id}', "
          // . "`product_image` = '{$product_image}', "
          // . "`img_set5` = '{$img_set5}', "
          . "`product_name` = '{$product_name}', "
          . "`description` = '{$description}', "
          // . "`colors` = '{$colors}', "
          // . "`cod_availability` = '{$cod_availability}', "
          . "`price` = '{$price}', "
          . "`tax` = '{$tax}', "
          . "`discount` = '{$discount}', "
          . "`net_amount` = '{$net_amount}', "
          . "`standard_packing` = '{$standard_packing}', ";
          // . "`visibility` = '{$visibility}' "
    
    if(isset($_REQUEST["stock"]))
      $query.="`stock`=".$_REQUEST["stock"].", ";


    $query1="select `img_set1`,`img_set2`,`img_set3`,`img_set4` from `product` where `id`=".$id;
    $result1=mysqli_query($con,$query1);
    $row1=mysqli_fetch_array($result1);

    for($i=1;$i<=4;$i++)
    {
      if(file_exists($_FILES['img_set'.$i]['tmp_name']) || is_uploaded_file($_FILES['img_set'.$i]['tmp_name']))
      {
          $dir=$product_img_location;
          $myfile = "img_set".$i;
          $obj= upload_file($myfile, "../".$dir);

          $img=$row1["img_set".$i];
          if($obj->error==0)
          {
            if($img!="")
            {
              $r=str_replace($hostname,"", $img);
              unlink("../".$r);
              // error_log($r);
            }
            
            $img_set = $hostname.$dir.$obj->file_name;
            $query.="`img_set{$i}` = '{$img_set}', "; 
          }
      }  
    }
    // if(file_exists($_FILES['img_set2']['tmp_name']) || is_uploaded_file($_FILES['img_set2']['tmp_name']))
    // {
    //     $img=$row1["img_set2"];
    //     if($img!="")
    //     {
    //       $r=str_replace($hostname,"", $img);
    //       unlink("../".$r);
    //       // error_log($r);
    //     }
    //     $dir=$product_img_location;
    //     $myfile = "img_set2";
    //     list($msg,$name)= upload_file($myfile, "../".$dir);
    //     $img_set2 = $hostname.$dir.$name;

    //     $query.="`img_set2` = '{$img_set2}', ";
    // }
    // if(file_exists($_FILES['img_set3']['tmp_name']) || is_uploaded_file($_FILES['img_set3']['tmp_name']))
    // {
    //     $img=$row1["img_set3"];
    //     if($img!="")
    //     {
    //       $r=str_replace($hostname,"", $img);
    //       unlink("../".$r);
    //       // error_log($r);
    //     }
    //     $dir=$product_img_location;
    //     $myfile = "img_set3";
    //     list($msg,$name)= upload_file($myfile, "../".$dir);
    //     $img_set3 = $hostname.$dir.$name;

    //     $query.="`img_set3` = '{$img_set3}', ";
    // }  
    // if(file_exists($_FILES['img_set4']['tmp_name']) || is_uploaded_file($_FILES['img_set4']['tmp_name']))
    // {
    //     $img=$row1["img_set4"];
    //     if($img!="")
    //     {
    //       $r=str_replace($hostname,"", $img);
    //       unlink("../".$r);
    //       // error_log($r);
    //     }
    //     $dir=$product_img_location;
    //     $myfile = "img_set4";
    //     list($msg,$name)= upload_file($myfile, "../".$dir);
    //     $img_set4 = $hostname.$dir.$name;

    //     $query.="`img_set4` = '{$img_set4}', ";
    // }  


$query=substr($query, 0,strlen($query)-2);

$query.=" WHERE `id` = {$id}";
          

//**************** search category id  start***************************************

// if(isset($_REQUEST['quaternary_category_id'])&& !empty($_REQUEST['quaternary_category_id']) && $_REQUEST['quaternary_category_id'] <> 'null'){  
//         $category_id=$_REQUEST['quaternary_category_id'] ;
// }
// elseif (isset($_REQUEST['tertiary_category_id'])&& !empty($_REQUEST['tertiary_category_id']) && $_REQUEST['tertiary_category_id'] <> 'null') {
//         $category_id=$_REQUEST['tertiary_category_id'] ;
// }
// elseif ( isset($_REQUEST['secondary_category_id'])&& !empty($_REQUEST['secondary_category_id'])&& $_REQUEST['secondary_category_id'] <> 'null' ) {
//          $category_id=$_REQUEST['secondary_category_id'] ;
// }
// elseif (isset($_REQUEST['primary_category_id'])&& !empty($_REQUEST['primary_category_id'])&& $_REQUEST['primary_category_id'] <> 'null') {
//             $category_id=$_REQUEST['primary_category_id'] ;
// }
//  else {
//     $category_id = 'NULL' ;
//     }
//echo  $category_id;


//**************** search category id  end***************************************


 
        
        
//      echo $query;
//      die();
      
        
    if(mysqli_query($con,$query))
    {
       
       // error_log($query);
       redirect_to("product.php?save=success");

    }
    else
    {
       redirect_to("product.php?save=failure");
       // echo 1;
    }       
}