
<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); 

$obj=new stdClass();

$obj->nolimit=1;
$data=json_decode(countryList($obj));

$vendors=json_decode(vendorList($obj));

$inclusions=json_decode(inclusionList($obj));

//echo '<script>console.log('.$data.');</script>';
//print_r($data);
?>
 <style>
   .error{
    color: red;
    display: inline;
   }
 </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add new tour</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">


                <form onsubmit="return validate();" name="tour_insert" action="tour_insert_2.php" method="POST"  enctype="multipart/form-data">    
                    
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
                                echo '<option value= "'.$vendors->vendors[$i]->vendor_id.'">'.$vendors->vendors[$i]->name.'</option>';
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
                    </div>
                    
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Video URL</label>
                            <div class="col-sm-6">
                                <input name="video_url" id="video_url" type="text" class="form-control" placeholder="Eg: http://www.example.com/myvideo.mp4" />
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Tour Name</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="tour_name" name="tour_name" value="" required maxlength="50">
                             </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Tour tag</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="tour_tag" name="tour_tag" value="" placeholder="Eg: alice,bob,cat">
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
                                <input type="date" class="form-control"  id="start_date" name="start_date" value="<?php echo date('Y-m-d');?>", required>
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Price (in Rupeess <i class="fa fa-inr"></i>)</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control"  id="price" name="price" value="" step="0.01" min="0.00" required>
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Discount (in Rupeess <i class="fa fa-inr"></i>)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  id="discount" name="discount" value="" placeholder="Eg: 20% or 20" required>
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Price (in Dollar <i class="fa fa-usd"></i>)</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control"  id="price_usd" name="price_usd" step="0.01" min="0.00" value="" required>
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Discount (in Dollar <i class="fa fa-usd"></i>)</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  id="discount_usd" name="discount_usd" value="" placeholder="Eg: 20% or 20" required>
                            </div>
                            
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Pax</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control"  id="stock" name="stock" value="0" min="0" max="999999999">
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
                            <textarea placeholder="Enter Description" id="description" name="description" value="" required>
                            </textarea>
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Itinerary</label>
                            <div class="col-sm-6">
                            <textarea placeholder="Enter Itinerary" id="itinerary" name="itinerary" value="">
                            </textarea>
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">FAQ</label>
                            <div class="col-sm-6">
                            <textarea  id="faq" name="faq" value="">
                            </textarea>
                            </div>
                    </div>

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-6">
                            <textarea id="details" name="details" value="">
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
                            <input type="text" class="form-control" name="start_location" required>
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
                      <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" id="submit" value="submit"> </center>
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

       
function validate()
  {
    $(".error").html("");

    //tour_name validation
    if($("#tour_name").val()==""){
      swal("Error","Tour name can not be empty.","error");
      return false;
    }
    //tour_tag validation

    //price validation
    if(isNaN(parseFloat($("#price").val()))){
        swal("Error","Price is not valid","error");
        return false;
    }

    //discount validation
    /*
    if(isNaN(parseFloat($("#discount").val()))){
        swal("Error","Discount is not valid","error");
        console.log("discount");
        return false;
    }*/

    //price usd validation
    if(isNaN(parseFloat($("#price_usd").val()))){
        swal("Error","Price USD is not valid","error");
        return false;
    }

    //discount USD validation
    /*
    if(isNaN(parseFloat($("#discount_usd").val()))){
        swal("Error","Discount USD is not valid","error");
        console.log("discount_usd");
        return false;
    }*/

    //pax validation
    if(isNaN(parseInt($("#stock").val()))){
        swal("Error","Pax is not valid","error");
        return false;
    }
    var i;
    for(i=1;i<=1;i++)
    {
     var fileUpload = document.getElementById("fileUpload"+i);
     // alert(i);
        if (typeof (fileUpload.files[0]) != "undefined") 
        {
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            if(size > 100)
            {
              swal("Error","Please Select an image size below 100 KB !","error");
              $("#error"+i).html("Incorrect image size");
              return false;
            }
        }
        // alert(i +' '+ 'No error') ;
        
    }
   
         return true;
  }
</script>