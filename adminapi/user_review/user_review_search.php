<?php
require_once '../../include/config.php';
require_once '../../include/function.php';

require_once '../../include/pagination.php';


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
    $query1 = "SELECT COUNT(*) FROM `user_review` r "
              . "LEFT JOIN user u ON r.user_id=u.id "
              . "LEFT JOIN product p ON r.product_id=p.id WHERE (";
 
   
            for($i=0;$i<$length;$i++)
            {
                    $query1.=" u.name like '%{$keywords[$i]}%' OR p.product_name like '%{$keywords[$i]}%') AND (";
            }
   $query=substr($query1, 0,strlen($query1)-5);  // remove the last AND( word
            $query1.=" ORDER BY r.id DESC ";
    $val= get_total_row($query1);
            
   /*******************************************search   pagination query end **********************************/ 
    
      
      $query = "SELECT r.id ,u.name AS UserName , "
              . "p.product_name, r.content ,"
              . "r.visibility FROM `user_review` r "
              . "LEFT JOIN user u ON r.user_id=u.id "
              . "LEFT JOIN product p ON r.product_id=p.id WHERE (";
 
   
            for($i=0;$i<$length;$i++)
            {
                    $query.=" u.name like '%{$keywords[$i]}%' OR p.product_name like '%{$keywords[$i]}%') AND (";
            }
   $query=substr($query, 0,strlen($query)-5);  // remove the last AND( word
            $query.=" ORDER BY r.id DESC limit {$start}, {$last}";
            
            $result = mysqli_query($con,$query);
   
            
    if(mysqli_num_rows($result) > 0){
         $product = array();
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
         $query_1 = "SELECT COUNT(*) FROM `user_review` r LEFT JOIN user u ON r.user_id=u.id LEFT JOIN product p ON r.product_id=p.id ORDER BY r.id DESC";
        $val= get_total_row($query_1);
     /*******************************************  pagination query end **********************************/    
    
    
    $query = "SELECT r.id ,u.name AS UserName , p.product_name, r.content ,r.visibility FROM `user_review` r LEFT JOIN user u ON r.user_id=u.id LEFT JOIN product p ON r.product_id=p.id ORDER BY r.id DESC limit {$start}, {$last}";

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
 
 
 
 
 
 
 