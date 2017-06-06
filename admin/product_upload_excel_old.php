
 <?php
 
 session_start();
 
//$val=1; //restriction upload product
// echo $_SESSION['no_of_products'] ;
// die();
 
 
 
    require_once ('../include/config.php');
    
    
     if(isset($_POST['submit_1'])&& !empty($_FILES)) 
     {
       include ("Classes/PHPExcel/IOFactory.php");
       $filename=$_FILES['csv']['name'];
       $objPHPExcel = PHPExcel_IOFactory::load($_FILES['csv']['tmp_name']);
       
       
        $dir="../assets/image/product";
       
       foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)   
       {  
            $highestRow = $worksheet->getHighestRow(); 
            
            
              

            
            
            for ($row=2; $row<=$highestRow; $row++)  
            {    
                $brand_id = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());       
                $cat_id = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());

                // start file upload
                
                $product_img = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $product_img_name = time().basename($product_img);
                file_put_contents("{$dir}/{$product_img_name}", file_get_contents($product_img));
                                  
                $img_set1 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                $img_set1_name = time().basename($img_set1);
                file_put_contents("{$dir}/{$img_set1_name}", file_get_contents($img_set1));
                 
                $img_set2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                $img_set2_name = time().basename($img_set2);
                file_put_contents("{$dir}/{$img_set2_name}", file_get_contents($img_set2));
                
                $img_set3 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                $img_set3_name = time().basename($img_set3);
                file_put_contents("{$dir}/{$img_set3_name}", file_get_contents($img_set3));
                
                $img_set4 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                $img_set4_name = time().basename($img_set4);
                file_put_contents("{$dir}/{$img_set4_name}", file_get_contents($img_set4));
                
                $img_set5 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                $img_set5_name = time().basename($img_set5);
                file_put_contents("{$dir}/{$img_set5_name}", file_get_contents($img_set5));
                
                // end file upload
                
                $product_name = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                $visibility = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                $description = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                $price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                $quantity = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());

                 
                //check upload product limit start
            $result_2 = mysqli_query($con,"SELECT * FROM product");
            $num_rows = mysqli_num_rows($result_2);
            if($num_rows < $_SESSION['no_of_products']){
            //check upload product limit end 
                
                
             
                 $sql = "INSERT INTO product(admin_id,brand_id,cat_id,product_image,img_set1,img_set2,img_set3,img_set4,img_set5,product_name,visibility,description,price,quantity)"
                         . " VALUES ('{$admin_id}','{$brand_id}','{$cat_id}','{$product_img_name}','{$img_set1_name}','{$img_set2_name}',"
                         . "'{$img_set3_name}','{$img_set4_name}','{$img_set5_name}','{$product_name}','{$visibility}',"
                         . "'{$description}','{$colors}','{$cod_availability}','{$price}','{$quantity}')";  
                  mysqli_query($con, $sql);
                  
                
              
            }
        else {
           redirect_to("product.php?msg= Your Product Upload Limit Exists");
             }
                  
            }
            
           
           
                    
       } 
 
  }
  
  header('Location: product.php');
//mysqli_close($con);
//unset($sql);
// unset($_POST['submit_1']); 

?>