<?php 
    require_once ('theme/header_1.php'); 
    require_once ('theme/header_2.php'); 
    require_once ('theme/sidebar.php');
    include_once '../include/config.php';

?>
  
<div class="content-wrapper">
   
    <section class="content-header">
        <h1>        Edit Category      </h1>
    </section>

    
    <section class="content">
        
    <div class="box box-primary">
        <div class="box-body">
                
        <form name="mastercategory_edit" action="category_edit_2.php" method="POST"  enctype="multipart/form-data">
        <div class="form-horizontal">

            
        <div class="form-group">
            <div class="col-sm-6">
            <input type="hidden" name="cat_id" id="cat_id">
            </div>
        </div> 
            
            
            
            

        <!-- <div class="form-group">
        <label class="col-sm-2 control-label">Parent Category</label>
        <div class="col-sm-6">
        <select class="form-control" id="parent_id" name="parent_id">
            <option value="0">Main</option>

        </select>
        </div>
        </div> -->

        <div class="form-group">
             <label  class="col-sm-2 control-label">Name</label>
             <div class="col-sm-6">
                 <input type="text" class="form-control"  id="cat_name" name="category_name">
             </div>
        </div>

        <div class="form-group">
             <label  class="col-sm-2 control-label">Image</label>
             <img id="category_image" width="200px">
             <div class="col-sm-6">
                 <input type="file" class="form-control"  id="cat_img" name="category_image" value="">
                 <!-- <input type="hidden" name="category_image">  -->
             </div>
        </div>

        <div class="form-group">
             <label  class="col-sm-2 control-label">Small Description</label>
             <div class="col-sm-6">
                 <input type="text"  class="form-control" id="small_description" name="small_description" value="" maxlength="100"> (Max 100 characters)
             </div>
        </div>

        <div class="form-group">
             <label  class="col-sm-2 control-label">Full Description</label>
             <div class="col-sm-6">
                 <textarea  class="form-control" id="full_description" name="full_description" value=""></textarea>
             </div>
        </div>

        <div class="form-group">
           <label class="col-sm-2 control-label">Status</label>
           <div class="col-sm-6">
               <select class="form-control" id="status" name="status">
               <option value= "1"> Active</option>
               <option value= "0"> Inactive</option>
               </select>
           </div>
        </div>

        </div>

            <div class="box-footer">
            <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" value="Save"> </center>
            </div>

  
        </form>
        </div>
        </div>

    </section>
    </div>
 
<?php require_once ('theme/footer.php');

if(isset($_GET["success"]) && $_GET["success"]=="false")
  {
    echo '<script>swal("Oops","'.$_GET["message"].'","error");</script>';
    // echo '<script>alert("Data updated successfully");</script>';
    unset($_GET["success"]);
  }?>

<script>

CKEDITOR.replace( 'full_description' );
    
//     $(document).ready(function() {
//     $('.search_key').click(function() {
//         category_details();
//     });
    
// });

      
function category_details(){
    var id = <?php echo $_REQUEST["id"]; ?>
       
        $.ajax({
            type: 'POST',
            url: '../adminapi/category/category_details.php',
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
    // console.log(fetchdata);
    var arr = JSON.parse(fetchdata,true);
    var x;
    
    if(arr.status=="success")
    {       
    
    for(x=0;x<arr.categories.length;x++)
        {
            $("#cat_id").val(arr.categories[x].id);
            $("#cat_name").val(arr.categories[x].category_name);
            $("#small_description").val(arr.categories[x].small_description);
            $("#full_description").val(arr.categories[x].full_description);
            $("#category_image").attr("src",arr.categories[x].category_image);
            $("#status").val(arr.categories[x].status);
            

        }
     
    }
    }
  
category_details();


 </script>