<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php');
require_once ('theme/sidebar.php');

$id=$_REQUEST['id'];
$obj=new stdClass();
$obj->product_id=$id;

$res=productDetails($obj);
$arr=json_decode($res);

$brand_id= $arr->product[0]->brand_id;

unset($obj);

$obj->viewall=1;
$brands=brandList($obj);
// echo $brands;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

       <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Edit Products
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      
      <div class="box box-primary">

            <div class="box-body">
                <form name="product_edit" action="product_edit_2.php" method="POST"  enctype="multipart/form-data">
                
                <div class="form-horizontal">
   
                    
                     <div class="form-group">
                      
                      <div class="col-sm-6">
                          <input type="hidden" name="id" id="product_id" value="<?=$arr->product[0]->id;?>">
                      </div>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Brand Name</label>
                        <div class="col-sm-6" id="brand">

                        </div>
                    </div>
                    
                    <div class="form-group">
                         <img width="150px"  id="img_set1" src="<?=$arr->product[0]->img_set1;?>"> &nbsp; <a class="btn btn-danger deleteProductImage" title="Delete Image" pid="<?php echo $_REQUEST['id'];?>" set="1"><i class="fa fa-times" style="font-size: 16px;"></i></a>
                            <label  class="col-sm-2 control-label">Image 1</label>
                            <div class="col-sm-6">
                                 <!-- <input type="hidden" name="img_set1"> -->
                            <p><input name="img_set1" type="file" class="inputFile" /><p>
                            </div>
                    </div>
                    
                    <div class="form-group">
                         <img width="150px"  id="img_set2" src="<?=$arr->product[0]->img_set2;?>"> &nbsp; <a class="btn btn-danger deleteProductImage" title="Delete Image" pid="<?php echo $_REQUEST['id'];?>" set="2"><i class="fa fa-times" style="font-size: 16px;"></i></a>
                            <label  class="col-sm-2 control-label">Image 2</label>
                            <div class="col-sm-6">
                                <!-- <input type="hidden" name="img_set2"> -->
                            <p><input name="img_set2" type="file" class="inputFile" /><p>
                            </div>
                    </div>
                    
                    <div class="form-group">
                         <img width="150px"  id="img_set3" src="<?=$arr->product[0]->img_set3;?>"> &nbsp; <a class="btn btn-danger deleteProductImage" title="Delete Image" pid="<?php echo $_REQUEST['id'];?>" set="3"><i class="fa fa-times" style="font-size: 16px;"></i></a>
                            <label  class="col-sm-2 control-label">Image 3</label>
                            <div class="col-sm-6">
                                <!-- <input type="hidden" name="img_set3"> -->
                            <p><input name="img_set3" type="file" class="inputFile" /><p>
                            </div>
                    </div>
                    <div class="form-group">
                         <img width="150px"  id="img_set4" src="<?=$arr->product[0]->img_set4;?>"> &nbsp; <a class="btn btn-danger deleteProductImage" title="Delete Image" pid="<?php echo $_REQUEST['id'];?>" set="4"><i class="fa fa-times" style="font-size: 16px;"></i></a>
                            <label  class="col-sm-2 control-label">Image 4</label>
                            <div class="col-sm-6">
                                <!-- <input type="hidden" name="img_set3"> -->
                            <p><input name="img_set4" type="file" class="inputFile" /><p>
                            </div>
                    </div>
                    

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Product Name</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="product_name" name="product_name" value="<?=$arr->product[0]->product_name;?>">
                             </div>
                    </div>
                 
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-6">
                            <textarea class="form-control" placeholder="" id="description" name="description">
                              <?=$arr->product[0]->description;?>
                            </textarea>
                            </div>
                    </div>
                      
                     <div class="form-group">
                            <label  class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" id="price" name="price" value="<?=$arr->product[0]->price;?>">
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">VAT % </label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="tax" name="tax" step="0.01" value="<?=$arr->product[0]->tax;?>">
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Discount</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" id="discount" name="discount" value="<?=$arr->product[0]->discount;?>"> (Example - 5 or 5%)
                            </div>
                    </div>

                     <div class="form-group">
                            <label  class="col-sm-2 control-label">Standard Packing</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" id="standard_packing" name="standard_packing" value="<?=$arr->product[0]->standard_packing;?>">
                            </div>
                    </div>

                    <?php


                  if(isset($_REQUEST["id"]))
                  {
                      $cat_id=getCategoryforProduct($_REQUEST["id"]);
                      $arr=categoryAttributes($cat_id);
                      for($i=0;$i<sizeof($arr);$i++)
                      {
                        if($arr[$i]["attribute"] == 'School' )
                        {
                                   echo '<div class="form-group">
                                                <label  class="col-sm-2 control-label">'.$arr[$i]["attribute"].'</label>
                                                <div class="col-sm-6">';
                              $obj=new stdClass();
                              $obj->viewall=1;
                              $school=json_decode(schoolList($obj));
                              if($school->status=="success")
                              {
                               for($j=0;$j<sizeof($school->schools);$j++)
                                {
                                 echo '
                                <input type="checkbox" id="'.$school->schools[$j]->school_id.'" name="School[]" value="'.$school->schools[$j]->school_id.'" /> '.$school->schools[$j]->name.' <br />';
                                }
                              }
                                echo '</div>
                                        
                                    </div>';
                        }
                        else
                        {
                          echo '
                                         <div class="form-group">
                                                <label  class="col-sm-2 control-label">'.$arr[$i]["attribute"].'</label>
                                                <div class="col-sm-6">
                                                <input type="text" class="form-control" id="'.$arr[$i]["attribute"].'" name="'.$arr[$i]["attribute"].'">
                                                </div>
                                        
                                        </div>';
              
                        }
            
                      }
                  }
                  ?>
                  
                  
                    
                        </div>
                    </div>

                    <div class="box-footer">
                
                        
                        <input type="submit" class=" Submit btn btn-primary submit_btn pull-left" name="submit" id="submit" value="Save"> 
                       
                    </div><!-- /.box-footer -->
                      
                       
                      
               </div><!-- /.box-body -->
 
              </form>
                 
                </div> 
                
                
            </div>
      
      
      <!-- /.box -->
       
    </section>

    <!-- /.content -->
   

  </div>
  <!-- /.content-wrapper -->

  
  <?php require_once ('theme/footer.php');?>
  
  
  <script>

CKEDITOR.replace( 'description' );


var data_brands='<?php echo $brands; ?>';
print_brands(data_brands);

        function print_brands(data){
         // data = JSON.stringify(brand);   
         var array = JSON.parse(data);
         if(array.status=="success")
         {
           var i;
           var out='<select class="form-control" id="brand_id" name="brand_id">';
              out+="<option value='null'>Select Brand</option>";
              for(i=0;i<array.brands.length;i++){
                  
                  out+= "<option value=" + array.brands[i].brand_id + ">" ;
                  out+= array.brands[i].brand_name;
                  out+= "</option> "
              }
               out+='</select>';
              document.getElementById("brand").innerHTML=out ;
              $("#brand_id").val("<?=$brand_id;?>");

          }
        };


$(".deleteProductImage").click(function()
{
  var id=$(this).attr("pid");
  var set=$(this).attr("set");

swal({
     title: "Are you sure?",
     text: "",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD4B39",
     confirmButtonText: "Yes, DELETE it!",
   }, 
    function()
    {
      $.post("../adminapi/product/delete_image.php",
      {
        id: id,
        set: set
      },
      function(data)
      {
        var arr=JSON.parse(data);
        toast(arr.remark);
        location.reload();
      })
    })
})

      </script>