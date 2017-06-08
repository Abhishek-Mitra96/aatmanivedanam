<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); 

$obj=new stdClass();

$obj->nolimit=1;
$obj->viewall=1;
// $data=json_decode(blogcategoryList($obj));
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
      <h1>Edit Blog</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">


                <form onsubmit="return validate();" name="blog_insert" action="blog_edit_2.php" method="POST"  enctype="multipart/form-data">    
                    
                <div class="form-horizontal">
   
                    
                    <input type="hidden" name="blog_id" value="<?php echo $_REQUEST['id']; ?>">
                   

                      <div class="form-group">
                            <label  class="col-sm-2 control-label">Blog Title</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="blog_title" name="blog_title" value="">
                             </div>
                    </div>
                    
                    <!--  <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-6" id="category_primary"> -->
                        <?php

                            // if($data->status=="success")
                            // {
                            //   echo '<select class="form-control" id="primary_category_id" name="category_id">';

                            //   for($i=0;$i<sizeof($data->categories);$i++)
                            //   {
                            //     echo '<option value= "'.$data->categories[$i]->blog_cat_id.'">'.$data->categories[$i]->category_name.'</option>';
                            //   }
                            //   echo '</select>';
                            // }
                            ?>
                       <!--  </div>
                    </div> -->

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Blog Image</label>
                             <img id="blog_image" width="200px">
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
                            <textarea id="description" name="description"></textarea>
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


function blog_details(){
    var id = <?php echo $_REQUEST["id"]; ?>
       
        $.ajax({
            type: 'POST',
            url: '../adminapi/blog/blog_details.php',
            data: {
                id:id
                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
                // console.log(fetchdata);
             print_data(fetchdata);
             
             
            }
        });
} 

function print_data(fetchdata)
    {
    console.log(fetchdata);
    var arr = JSON.parse(fetchdata,true);
    var x;
    
    if(arr.status=="success")
    {       
    
    for(x=0;x<arr.blog.length;x++)
        {
            $("#blog_title").val(arr.blog[x].blog_title);
            $("#description").val(arr.blog[x].blog_description);
            $("#blog_image").attr("src",arr.blog[x].blog_img);
            $("#visibility").val(arr.blog[x].status);
            // $("#primary_category_id").val(arr.blogs[x].blog_cat_id);
        }
     
    }
    }
  


blog_details();
CKEDITOR.replace( 'description' );

</script>