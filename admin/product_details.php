<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php');
require_once ('theme/sidebar.php');

$id=$_REQUEST['id'];

$obj=new stdClass();
$obj->product_id=$id;
$result=productDetails($obj);
$arr=json_decode($result);

// print_r($arr);

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

       <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Product Details
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">
                
                <div class="form-horizontal">
                    <div class="divide30"></div>
                    <div class="row">
                      <div class="col-md-6">
                        <img alt="" class="main-image" id="img_set1" src="<? echo $arr->product[0]->img_set1;?>">
                        <div class="divide80"></div>
                        <img alt="" class="small-image" id="img_set2" src="<? echo $arr->product[0]->img_set2;?>">
                        <img alt="" class="small-image" id="img_set3" src="<? echo $arr->product[0]->img_set3;?>">
                        <img alt="" class="small-image" id="img_set4" src="<? echo $arr->product[0]->img_set4;?>">
                      </div>
                      <div class="col-md-5">


                            <h3 id="category"><strong>Category: </strong> <? echo $arr->product[0]->category_name;?></h3>
       
                        
                            <h3 id="brand"><strong>Brand: </strong> <? echo $arr->product[0]->brand_name;?></h3>

                            <div class="divide20"></div>
                        
                            <h4 id="product_name"><? echo $arr->product[0]->product_name;?></h4>
                     
                        
                                <p class="details" id="description" style="text-align: justify;margin-top: 30px;">
                                  <? echo $arr->product[0]->description;?>
                                </p>
                                <div class="divide20"></div>
                                <span class="details">Gross Rate: Rs.</span><div class="details" id="price" style="display: inline;"><? echo $arr->product[0]->price;?></div>
                                <div class="divide20"></div>
                                <span class="details">Discount: </span><div class="details" id="price" style="display: inline;"><? echo $arr->product[0]->discount;?></div>
                                <div class="divide20"></div>
                                <span class="details">Net Amount: </span><div class="details" id="price" style="display: inline;"><? echo $arr->product[0]->net_amount;?></div>
                                <div class="divide30"></div>
                                <span class="details">Standard Packing: </span><div class="details" id="standard_packing" style="display: inline;"><? echo $arr->product[0]->standard_packing;?></div>
                                <div class="divide20"></div>
                                <?php

            if(isset($arr->color))
            {
                echo '<span class="details">Color :  </span><div class="details" id="price" style="display: inline;">';
                                    for($i=0;$i<sizeof($arr->color);$i++)
                                    {
                                        $c=$arr->color[$i]->color;
                                        echo $c.',';
                                    }
                echo '</div>
                </span>
                <!--/.color-details-->
                                <div class="divide20"></div>
                ';
            }

            //display sizes


            
            if(isset($arr->size))
            {

                echo '<span class="details">Size: </span><div class="details" id="price" style="display: inline;">';
                        for($i=0;$i<sizeof($arr->size);$i++)
                        {
                            $s=$arr->size[$i]->size;
                            echo $arr->size[$i]->size_id.',';
                        }

                        echo '</div>
                </span>
                <!-- productFilter -->
                                <div class="divide20"></div>
                ';
            }

            //display classes

            if(isset($arr->class))
            {

                echo '<span class="details">Class: </span><div class="details" id="price" style="display: inline;">';
                        for($i=0;$i<sizeof($arr->class);$i++)
                        {
                            $cl=$arr->class[$i]->class;
                            echo $cl.',';
                        }

                        echo '
                    </div>
                </span>
                <!-- productFilter -->
                <div class="divide20"></div>';
            }

            if(isset($arr->details))
            {
                $size=sizeof($arr->details);
                foreach ($arr->details[0] as $key => $value)
                {
                    echo '<span class="details">'.$key.' : '.$value.'</span>';
                    echo '<div class="divide20"></div>';
                }
            }
            ?>
                          
                        
                        <div class="divide40"></div>

                        <div class="box-footer">
                    
                            
                            <a href="product_edit.php?id=<?php echo $id;?>" class="btn btn-primary submit_btn"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Edit </a>
                           
                        </div><!-- /.box-footer -->
                      </div>
                   </div>  
                      
               </div><!-- /.box-body -->
 
                 
                </div> 
                
                
            </div>
      
      
      <!-- /.box -->
       
    </section>

    <!-- /.content -->
   

  </div>
  <!-- /.content-wrapper -->

  
  <?php require_once ('theme/footer.php');?>