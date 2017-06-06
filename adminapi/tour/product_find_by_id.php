 <?php
 
    require_once '../../include/config.php';
    $id = $_REQUEST['id'];
    $query="select * from `product` where id='{$id}'";
 

     $q=mysqli_query($con,$query);
    
    if(!$q)
         {
            $output="[{'status':'false','remark':'product could not be removed'}]";
            echo $output;
         }
    else
        {
            
       while($row=mysqli_fetch_assoc($q))
       {
         $products[]=$row;
       }

       echo json_encode($products);
  
        }

 ?>
