
 <?php
 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
 
 
 
    require_once ('../include/config.php');
    
    
     if(isset($_POST['submit_1'])&& !empty($_FILES)) 
     {
        $length=0;
       $file=fopen($_FILES['csv']['tmp_name'],"r");
       
       $arr=fgetcsv($file);
        $category=$arr[1];
       $arr=fgetcsv($file);
       $brand=$arr[1];
       // $arr=fgetcsv($file);   // to omit the new line
       fgetcsv($file);   // to omit the header

       echo $category."<br>";
       echo $brand."<br>";

       $query="select `id` from `category` where `category_name`='".$category."'";
       $result=mysqli_query($con,$query);
       $row=mysqli_fetch_array($result);
       $category_id=$row["id"];
       echo $category_id."<br>";
       $query="select `brand_id` from `brand` where `brand_name`='".$brand."'";
       $result=mysqli_query($con,$query);
       $row=mysqli_fetch_array($result);
       $brand_id=$row["brand_id"];
       echo $brand_id."<br>";

       $query="INSERT INTO `product`(`brand_id`, `cat_id`, `product_name`, `description`, `price`, `visibility`, `standard_packing`) VALUES ";
       echo $query."<br>";
       // while(! feof($file))
       // {
       $i=1;
       while ($i<=10) 
       {
        // echo "Entered loop";
            // $arr=fgetcsv($file);
        // print_r(fgetcsv($file));
        echo fgets($file);
            
            // if($arr[4]=="Yes")
            //     $status=1;
            // else
            //     $status=0;

            // if($arr[0]=="")
            //     break;

            // echo $arr[0];

            // $query.="('{$brand_id}','{$category_id}','{$arr[0]}','{$arr[1]}','{$arr[2]}','{$status}','{$arr[3]}'),";
            $length++;
            $i++;
        }
            // $category=$arr[1];
        // }
        // $query=substr($query,0,strlen($query)-1);
        // echo $query;
        // if($length==0)
        //     die();
       fclose($file);

       // $objPHPExcel = PHPExcel_IOFactory::load($_FILES['csv']['tmp_name']);
       
       
       //  $dir="../assets/image/product";
       
       // foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)   
       // {  
       //      $highestRow = $worksheet->getHighestRow(); 
            
            
              

            
            
       //      for ($row=2; $row<=$highestRow; $row++)  
       //      {    
       //          $brand_id = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());       
       //          $cat_id = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());

       //          // start file upload
                
       //          $product_img = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
       //          $product_img_name = time().basename($product_img);
       //          file_put_contents("{$dir}/{$product_img_name}", file_get_contents($product_img));
                                  
       //          $img_set1 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
       //          $img_set1_name = time().basename($img_set1);
       //          file_put_contents("{$dir}/{$img_set1_name}", file_get_contents($img_set1));
                 
       //          $img_set2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
       //          $img_set2_name = time().basename($img_set2);
       //          file_put_contents("{$dir}/{$img_set2_name}", file_get_contents($img_set2));
                
       //          $img_set3 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
       //          $img_set3_name = time().basename($img_set3);
       //          file_put_contents("{$dir}/{$img_set3_name}", file_get_contents($img_set3));
                
       //          $img_set4 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
       //          $img_set4_name = time().basename($img_set4);
       //          file_put_contents("{$dir}/{$img_set4_name}", file_get_contents($img_set4));
                
       //          $img_set5 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
       //          $img_set5_name = time().basename($img_set5);
       //          file_put_contents("{$dir}/{$img_set5_name}", file_get_contents($img_set5));
                
       //          // end file upload
                
       //          $product_name = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
       //          $visibility = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
       //          $description = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
       //          $price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
       //          $quantity = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());

                 
       //          //check upload product limit start
       //      $result_2 = mysqli_query($con,"SELECT * FROM product");
       //      $num_rows = mysqli_num_rows($result_2);
       //      if($num_rows < $_SESSION['no_of_products']){
       //      //check upload product limit end 
                
                
             
       //           $sql = "INSERT INTO product(admin_id,brand_id,cat_id,product_image,img_set1,img_set2,img_set3,img_set4,img_set5,product_name,visibility,description,price,quantity)"
       //                   . " VALUES ('{$admin_id}','{$brand_id}','{$cat_id}','{$product_img_name}','{$img_set1_name}','{$img_set2_name}',"
       //                   . "'{$img_set3_name}','{$img_set4_name}','{$img_set5_name}','{$product_name}','{$visibility}',"
       //                   . "'{$description}','{$colors}','{$cod_availability}','{$price}','{$quantity}')";  
       //            mysqli_query($con, $sql);
                  
                
              
       //      }
       //  else {
       //     redirect_to("product.php?msg= Your Product Upload Limit Exists");
       //       }
                  
       //      }
            
           
           
                    
       // } 
 
  }
  
  // header('Location: product.php');
//mysqli_close($con);
//unset($sql);
// unset($_POST['submit_1']); 

?>