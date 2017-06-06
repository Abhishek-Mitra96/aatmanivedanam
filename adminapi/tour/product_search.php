<?php
require_once '../../include/config.php';
require_once '../../include/function.php';


require_once '../../include/pagination.php';

$product = array();

if (isset($_REQUEST['key']) && !empty($_REQUEST['key']))
 {
  $key = $_REQUEST['key'];
  
  //start string cleaning
  
  $count=1;
  while($count!=0)
   $key=str_replace("  ", " ", $key,$count);
  $key=clean($key);

  //string is clean now

  $keywords=explode(" ", $key);
  
  $length=sizeof($keywords);

  if($length!=0)
    {
   
        /**************************** search  pagination query start *****************************************/  
        $query_1="SELECT COUNT(*) FROM product p 
               LEFT JOIN master_category c ON p.cat_id=c.id 
               LEFT JOIN admin_user a ON p.admin_id=a.id
               LEFT JOIN brand b ON p.brand_id = b.id 
               WHERE (";
            for($i=0;$i<$length;$i++)
            {
        $query_1.="p.product_name like '%".$keywords[$i]."%' OR b.brand_name like '%".$keywords[$i]."%' OR c.category_name like '%".$keywords[$i]."%') AND (";
            }
        $query_1=substr($query_1, 0,strlen($query_1)-5);  // remove the last AND( word
        
        $query.=" ORDER BY p.id DESC ";
        $val= get_total_row($query_1);
     /*******************************************search   pagination query end **********************************/         
            
            
        $query="SELECT p.id,a.name AS adminname,c.category_name,b.brand_name , p.product_name, 
               p.product_image,p.img_set1,p.img_set2,p.img_set3,p.img_set4,p.img_set5,
               p.visibility,p.description,p.colors,p.cod_availability,
               p.price,p.quantity 
               FROM product p 
               LEFT JOIN master_category c ON p.cat_id=c.id 
               LEFT JOIN admin_user a ON p.admin_id=a.id
               LEFT JOIN brand b ON p.brand_id = b.id 
               WHERE (";
            for($i=0;$i<$length;$i++)
            {
        $query.="p.product_name like '%".$keywords[$i]."%' OR b.brand_name like '%".$keywords[$i]."%' OR c.category_name like '%".$keywords[$i]."%') AND (";
            }
        $query=substr($query, 0,strlen($query)-5);  // remove the last AND( word
        
        $query.=" ORDER BY p.id DESC limit {$start}, {$last}";    
            
            
        $result = mysqli_query($con,$query);
   
            
        if(mysqli_num_rows($result) > 0)
            {

         while ($row = mysqli_fetch_assoc($result)) {
                $row['val']= $val;/***********search  data set for pagination ***********************/
                $product[] = $row;
                }
                
                echo json_encode($product);
            }
        else{
            echo "false";
            }
   }
  
}
  
  
 
 else{
     
    /****************************  pagination query start *****************************************/
        $query_1="SELECT COUNT(*) FROM product p LEFT JOIN master_category c ON p.cat_id=c.id LEFT JOIN admin_user a ON p.admin_id=a.id LEFT JOIN brand b ON p.brand_id = b.id";
        $val= get_total_row($query_1);
     /*******************************************  pagination query end **********************************/    
    
     
    
    $query="SELECT p.id,a.name AS adminname,c.category_name,b.brand_name , p.product_name, 
            p.product_image,p.img_set1,p.img_set2,p.img_set3,p.img_set4,p.img_set5,
            p.visibility,p.description,p.colors,p.cod_availability,
            p.price,p.quantity 
            FROM product p 
            LEFT JOIN master_category c ON p.cat_id=c.id 
            LEFT JOIN admin_user a ON p.admin_id=a.id
            LEFT JOIN brand b ON p.brand_id = b.id 
            ORDER BY p.id DESC limit {$start}, {$last}";


    
    $result=mysqli_query($con,$query);
    $product=array();
    if(!$result)
        {
        $output="[{'status':'false','remark':'Error while viewing product!'}]";
        echo $output;
        }
    else
        {
        while ($row=  mysqli_fetch_assoc($result))
            {  
            $row['val']= $val; /*********** data set for pagination ***********************/
            $product[]=$row;
            }
            echo json_encode($product);
           
        }

     
 }
 
 
 
 
 
 
 