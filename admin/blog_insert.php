<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); 

$obj=new stdClass();

$obj->nolimit=1;
$obj->viewall=1;
// $data=json_decode(blogcategoryList($obj));
// print_r($vendors);
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
      <h1>New Blog</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">


                <form onsubmit="return validate();" name="blog_insert" action="blog_insert_2.php" method="POST"  enctype="multipart/form-data">    
                    
                <div class="form-horizontal">

                     <!--  <div class="form-group">
                            <label  class="col-sm-2 control-label">Blog Category</label>
                            <div class="col-sm-6"> -->
                            <?php

                            // if($data->status=="success")
                            // {
                            //   echo '<select class="form-control" id="category_id" name="category_id">';

                            //   for($i=0;$i<sizeof($data->categories);$i++)
                            //   {
                            //     echo '<option value= "'.$data->categories[$i]->blog_cat_id.'">'.$data->categories[$i]->category_name.'</option>';
                            //   }
                            //   echo '</select>';
                            // }
                            ?>
                             <!-- </div>
                      </div> -->

                      <div class="form-group">
                            <label  class="col-sm-2 control-label">Blog Title</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="blog_title" name="blog_title" value="">
                             </div>
                      </div>
                    
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Blog Image</label>
                            <div class="col-sm-6">
                            <p><input name="img1" id="fileUpload1" type="file" class="inputFile " /><p>
                            <div class="error" id="error1"></div>
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
                            <textarea placeholder="Enter Description" id="description" name="description" value="">
                            </textarea>
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
// CKEDITOR.replace( 'itinerary' );
// CKEDITOR.replace( 'faq' );
// CKEDITOR.replace( 'details' );

       
function validate()
  {
    $(".error").html("");
    var p=$("#blog_title").val();
    if(p=="")
    {
      swal("Error","Blog Title can not be empty.","error");
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