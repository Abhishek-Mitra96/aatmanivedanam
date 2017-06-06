
 <?php
 
    require_once ('../include/config.php');
    include ("Classes/PHPExcel/IOFactory.php");
    include ("Classes/PHPExcel.php");
    
    if(isset($_REQUEST['brand_name']) && $_REQUEST['brand_name']!="null" && isset($_REQUEST['primary_category_id']) && $_REQUEST["primary_category_id"]!="null")
    {
        $brand=$_REQUEST["brand_name"];
        if(isset($_REQUEST['secondary_category_id']) && $_REQUEST["secondary_category_id"]!="")
        {
           $category=$_REQUEST["secondary_category_id"];
        }
        else
        {
           $category=$_REQUEST["primary_category_id"];
        }

        $query="select `category_name` from `category` where `id`=".$category;
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_array($result);

        $category=$row["category_name"];
        $objPHPExcel = new PHPExcel;
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        // set default font
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
        // set default font size
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(14);
        // create the writer
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");

        // writer already created the first sheet for us, let's get it
        $objSheet = $objPHPExcel->getActiveSheet();
        // rename the sheet
        $objSheet->setTitle('Upload Products');

        // let's bold and size the header font and write the header
        // as you can see, we can specify a range of cells, like here: cells from A1 to A4
        $objSheet->getCell('A1')->setValue('Category');
        $objSheet->getCell('B1')->setValue($category);
        $objSheet->getCell('A2')->setValue('Brand');
        $objSheet->getCell('B2')->setValue($brand);
        
        $objSheet->getStyle('A3:E3')->getFont()->setBold(true)->setSize(16);

        // write header
        $objSheet->getCell('A3')->setValue('Product Name');
        $objSheet->getCell('B3')->setValue('Description');
        $objSheet->getCell('C3')->setValue('Price');
        $objSheet->getCell('D3')->setValue('Standard Packing');
        $objSheet->getCell('E3')->setValue('Visibility (Yes or No)');
        
        

        for ($i=4; $i<=303 ; $i++) { 
            $objSheet->getCell('E'.$i)->setValue('Yes');
        }

        // autosize the columns
        $objSheet->getColumnDimension('A')->setAutoSize(true);
        $objSheet->getColumnDimension('B')->setAutoSize(true);
        $objSheet->getColumnDimension('C')->setAutoSize(true);
        $objSheet->getColumnDimension('D')->setAutoSize(true);
        $objSheet->getColumnDimension('E')->setAutoSize(true);
        
        
        // write the file
        $objWriter->save('downloads/test.xls');
        header("Location:downloads/test.xls");
    }
  

// // print_r($_REQUEST);
// if(isset($_REQUEST['brand_name']) && $_REQUEST['brand_name']!="null" && isset($_REQUEST['primary_category_id']) && $_REQUEST["primary_category_id"]!="null")
// {
//     $brand=$_REQUEST["brand_name"];
//     if(isset($_REQUEST['secondary_category_id']) && $_REQUEST["secondary_category_id"]!="")
//     {
//        $category=$_REQUEST["secondary_category_id"];
//     }
//     else
//     {
//        $category=$_REQUEST["primary_category_id"];
//     }

//     $query="select `category_name` from `category` where `id`=".$category;
//     $result=mysqli_query($con,$query);
//     $row=mysqli_fetch_array($result);

//     $category=$row["category_name"];

//     $filename = "downloads/upload_products.csv";
     
//     $fp = fopen($filename, "w");
//     $seperator = "";
//     $comma = "";

//     /*****************************************************************************************/


//     $fp = fopen($filename, "w");
//     $seperator = "";

//     $seperator .= "Category,{$category}\n";
//     $seperator .= "Brand,{$brand}\n";
//     // $seperator .= "\n";

//     $seperator .= 'Product Name';
//     $seperator .= ',Description';
//     $seperator .= ',Price';
//     $seperator .= ',Standard Packing';
//     $seperator .= ',Visibility (Yes or No)';
//     // $seperator .= ',Category';
//     // $seperator .= ',Brand';
//     // $seperator .= ',Image1';
//     // $seperator .= ',Image2';
//     // $seperator .= ',Image3';
//     // $seperator .= ',Image4';


//     $seperator .= "\n";


//         for ($i=1; $i <=300 ; $i++) { 
//             // $seperator.=",,,,Yes,{$category},{$brand},,,,\n";
//             // $seperator.=",,,,Yes,{$category},{$brand}\n";
//             $seperator.=",,,,Yes\n";
//         }

        
//         fputs($fp, $seperator);

//     fclose($fp);    

//     header("Location:downloads/upload_products.csv");
// }
// else{
//     header("Location:sample_excel.php");
// }

?>