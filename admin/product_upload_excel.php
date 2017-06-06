
 <?php
 
 session_start();
 
//$val=1; //restriction upload product
// echo $_SESSION['no_of_products'] ;
// die();
 
 
 
    require_once ('../include/config.php');
    
    
     if(isset($_POST['submit'])&& !empty($_FILES)) 
     {
       include ("Classes/PHPExcel/IOFactory.php");
       $filename=$_FILES['excel']['name'];
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
       $objPHPExcel = PHPExcel_IOFactory::load($_FILES['excel']['tmp_name']);
       
       
       foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)   
       {  
            $highestRow = $worksheet->getHighestRow(); 
            
            // echo "Hey there.<BR>";

           $category=$worksheet->getCellByColumnAndRow(1, 1)->getValue();
           $brand=$worksheet->getCellByColumnAndRow(1, 2)->getValue();
           
           $query="select `id` from `category` where `category_name`='".$category."'";
           $result=mysqli_query($con,$query);
           $row=mysqli_fetch_array($result);
           $category_id=$row["id"];

           $query="select `brand_id` from `brand` where `brand_name`='".$brand."'";
           $result=mysqli_query($con,$query);
           $row=mysqli_fetch_array($result);
           $brand_id=$row["brand_id"];
              

            
            $query="";
            $count=0;
            for ($row=4; $row<=$highestRow; $row++)  
            {    
                
                if($row>303)   //not more than 300 rows are allowed
                  break;

                $product_name = rinse($worksheet->getCellByColumnAndRow(0, $row)->getValue());
                $visibility = rinse($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                $description = rinse($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $price = rinse($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $quantity = numOnly($worksheet->getCellByColumnAndRow(3, $row)->getValue());

                $visibility=($visibility=="Yes")?1:0;

                if($product_name=="")
                  break;

                $query.="('{$brand_id}','{$category_id}','{$product_name}','{$visibility}',"
                         . "'{$description}','{$price}','{$quantity}'),";
                $count++;
                 
            }
          }

              $query=substr($query, 0,strlen($query)-1);

                //check upload product limit start
              $result_2 = mysqli_query($con,"SELECT * FROM product");
                $num_rows = mysqli_num_rows($result_2);
            
                if(($num_rows+$count) <= $_SESSION['no_of_products'])
                {
                  //check upload product limit end 
                 $sql = "INSERT INTO product(`brand_id`,`cat_id`,`product_name`,`visibility`,`description`,`price`,`standard_packing`)"
                         . " VALUES ".$query;
                  mysqli_query($con, $sql);
                         // echo $sql."<br>";
                  header("Location:product.php");
            }
        else {
           redirect_to("product.php?msg= Your Product Upload Limit Exists");
             }
                  
            }
            
  // header('Location: product.php');
//mysqli_close($con);
//unset($sql);
// unset($_POST['submit_1']); 

?>