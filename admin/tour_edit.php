<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php');
require_once ('theme/sidebar.php');

$id=$_REQUEST['id'];
$obj=new stdClass();
$obj->tour_id=$id;

$res=tourDetails($obj);
$arr=json_decode($res);

$obj->nolimit=1;
$data=json_decode(countryList($obj));

$vendors=json_decode(vendorList($obj));

$inclusions=json_decode(inclusionList($obj));

?>
<script>console.log(<?php echo $res; ?>);</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

       <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Edit Tour
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      
      <div class="box box-primary">

            <div class="box-body">
                <form onsubmit="return validate();" name="tour_edit" action="tour_edit_2.php" method="POST"  enctype="multipart/form-data">    
                    
                <div class="form-horizontal">
   
                    
                    <input type="hidden" name="category_id" value="<?php echo $_REQUEST['category_id']; ?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Name</label>
                        <div class="col-sm-6" id="vendor_loc">
                          <?php

                            if($vendors->status=="success")
                            {
                              echo '<select class="form-control" id="vendor_id" name="vendor_id">';

                              for($i=0;$i<sizeof($vendors->vendors);$i++)
                              {
                                echo '<option value= "'.$vendors->vendors[$i]->vendor_id.'" >'.$vendors->vendors[$i]->name.'</option>';
                              }
                              echo '</select>';
                            }
                        ?>
                        </div>
                        <div class="col-sm-2">
                            <a href="vendor_insert.php" class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Vendor</a>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Primary Image</label>
                            <div class="col-sm-6">
                            <p><input name="img1" id="fileUpload1" type="file" class="inputFile " /><p>
                            <div class="error" id="error1"></div>
                            </div>
                            <div class="col-sm-3">
                            <img src="<?=$arr->tour[0]->img1?>" alt="current image">
                            </div>
                    </div>
                    
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Video URL</label>
                            <div class="col-sm-6">
                                <input name="video_url" id="video_url" type="text" class="form-control" value="<?=$arr->gallery_video[0]->url;?>" />
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Tour Name</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="tour_name" name="tour_name" value="<?=$arr->tour[0]->tour_name;?>">
                             </div>
                    </div>
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Tour tag</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="tour_tag" name="tour_tag" value="<?=$arr->tour[0]->tag;?>" placeholder="Eg: alice,bob,cat">
                             </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-6">
                            <?php

                            if($data->status=="success")
                            {
                              echo '<select class="form-control" id="country_id" name="country_id">';

                              for($i=0;$i<sizeof($data->countries);$i++)
                              {
                                echo '<option value= "'.$data->countries[$i]->id.'">'.$data->countries[$i]->country.'</option>';
                              }
                              echo '</select>';
                            }
                            ?>
                            </div>
                            <div class="col-sm-2">
                                <a href="country_insert.php" class="btn btn-warning"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Country</a>
                            </div>
                          
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Start Date</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control"  id="start_date" name="start_date" value="<?=$arr->tour[0]->start_date;?>">
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Price (in Rupeess)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  id="price" name="price" value="<?=$arr->tour[0]->price;?>">
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Discount (in Rupeess)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  id="discount" name="discount" value="<?=$arr->tour[0]->discount;?>" placeholder="Eg: 20% or 20">
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Price (in Dollar)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  id="price_usd" name="price_usd" value="<?=$arr->tour[0]->price_usd;?>">
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Discount (in Dollar)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  id="discount_usd" name="discount_usd" value="<?=$arr->tour[0]->discount_usd;?>" placeholder="Eg: 20% or 20">
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Pax</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control"  id="stock" name="stock" value="<?=$arr->tour[0]->stock;?>">
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Visibility</label>
                            <div class="col-sm-6">
                            <select class="form-control" id="visibility" name="visibility">
                            <option value= "1"> Active</option>
                            <option value= "0"> Inactive</option>
                            </select>
                            </div>
                    </div>
                    
                 
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-6">
                            <textarea placeholder="Enter Description" id="description" name="description" value=""><?=$arr->tour[0]->description;?>
                            </textarea>
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Itinerary</label>
                            <div class="col-sm-6">
                            <textarea placeholder="Enter Itinerary" id="itinerary" name="itinerary" value=""><?=$arr->tour[0]->itinerary;?>
                            </textarea>
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">FAQ</label>
                            <div class="col-sm-6">
                            <textarea  id="faq" name="faq" value=""><?=$arr->tour[0]->faq;?>
                            </textarea>
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-6">
                            <textarea id="details" name="details" value=""><?=$arr->tour[0]->details;?>
                            </textarea>
                            </div>
                    </div>
                      
                    <!--  <div class="form-group">
                            <label  class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="price" name="price" value="" step="0.01">
                            </div>
                    </div> -->

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Start Location </label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="start_location" value="<?=$arr->tour[0]->start_location;?>">
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Tour Inclusions</label>
                            <div class="col-sm-6 inclusions">
                            <?php

                            if($inclusions->status=="success")
                            {
                              // echo '<select class="form-control" id="country_id" name="country_id">';

                              for($i=0;$i<sizeof($inclusions->inclusions);$i++)
                              {
                                echo '<input type="checkbox" name="inclusions[]" value="'.$inclusions->inclusions[$i]->inc_id.'"> '.$inclusions->inclusions[$i]->inc_name.'<br>';
                              }
                              // echo '</select>';
                            }
                            ?>
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Tour Exclusions</label>
                            <div class="col-sm-6 inclusions">
                            <?php

                            if($inclusions->status=="success")
                            {
                              // echo '<select class="form-control" id="country_id" name="country_id">';

                              for($i=0;$i<sizeof($inclusions->inclusions);$i++)
                              {
                                echo '<input type="checkbox" name="exclusions[]" value="'.$inclusions->inclusions[$i]->inc_id.'"> '.$inclusions->inclusions[$i]->inc_name.'<br>';
                              }
                              // echo '</select>';
                            }
                            ?>
                            </div>
                    </div>
                    
                    <div class="box-footer">
                      <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" id="submit" value="update"> </center>
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
CKEDITOR.replace( 'itinerary' );
CKEDITOR.replace( 'faq' );
CKEDITOR.replace( 'details' );

$("#vendor_id").val('<?=$arr->tour[0]->vendor_id?>');
$("#country_id").val('<?=$arr->tour[0]->country_id?>');
$("#visibility").val('<?=$arr->tour[0]->visibility?>');


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