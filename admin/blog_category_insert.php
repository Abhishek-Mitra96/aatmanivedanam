<?php require_once ('theme/header_1.php'); ?>

<?php require_once '../include/config.php';?>
<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Category
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
             
           <!--category_insert_2.php-->
                
                <form  onsubmit="return validate();" name="category_insert" action="blog_category_insert_2.php" method="POST"  enctype="multipart/form-data">
     <div class="form-horizontal">


          
  
                   <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Primary Category</label>
                        <div class="col-sm-6" id="category_primary">

                        </div>
                    </div>-->
                   <!--  <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary  Category</label>
                        <div class="col-sm-6" id="category_secondary">

                        </div>
                    </div> -->

        <div class="form-group">
             <label  class="col-sm-2 control-label">Category Name</label>
             <div class="col-sm-6">
                 <input type="text"  class="form-control" id="category_name" name="category_name" value="" autofocus="true">
             </div>
        </div>




      <!--  <div class="form-group">
             <label  class="col-sm-2 control-label">Category Description</label>
             <div class="col-sm-6">
                 <textarea id="CKeditor" name="category_description" rows="10" cols="80"></textarea>
             </div>
       </div> -->

         <div class="form-group">
             <label  class="col-sm-2 control-label">Category Image</label>
             <div class="col-sm-6">
                 <input type="file" class="form-control"  id="fileUpload" name="category_image" value="">
                 <input type="hidden" name="MAX_FILE_SIZE" value="1000" />
             </div>
           </div>

           <!-- <div class="form-group">
             <label  class="col-sm-2 control-label">Attributes</label>
             <div class="col-sm-6">
                 <input type="checkbox" name="check_list[]" value="Size">&nbsp;&nbsp;Size<br>
                 <input type="checkbox" name="check_list[]" value="Color">&nbsp;&nbsp;Color <br>
                 <input type="checkbox" name="check_list[]" value="School">&nbsp;&nbsp;School <br>
                 <input type="checkbox" name="check_list[]" value="Class">&nbsp;&nbsp;Class <br>
             </div>
           </div> -->

          <!--  <div class="form-group">
             <label  class="col-sm-2 control-label">Additional Attributes</label>
             <div class="col-sm-6">
                 <input type="text"  class="form-control" id="attributes" name="attributes" placeholder="Enter comma seperated. Ex- OS,Height,Width,etc.">
             </div>
            </div>
 -->

         <!--<div class="form-group">
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
        </div>-->

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
            <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" value="submit"> </center>
         </div>

  
   </form>


            </div><!-- /.box-body -->

          </div><!-- /.box -->
<!--                        </div>-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
  
  
  <?php 
  require_once ('theme/footer.php');
 
  if(isset($_GET["status"]) && $_GET["status"]=="failure")
  {
    echo '<script>swal("Oops","'.$_GET["message"].'","error");</script>';
    unset($_GET["status"]);
  }

  ?>

  
  <script>

//CKEDITOR.replace( 'full_description' );

      
      /* For Primary Category */
      $.post("../adminapi/blog_category/blog_category_list.php",
        {
          nolimit: 1
        },
           function(data2){
                 // console.log(data2);
                 // data2=JSON.stringify(data2);
                 var arr2=JSON.parse(data2);
                 var x2;
                 var out='<select class="form-control" id="primary_category_id" name="primary_category_id">';
                 out += "<option value='null'>Select Category</option>";
                 for(x2=0;x2<arr2.categories.length;x2++)
                    {
                      out+="<option value="+arr2.categories[x2].blog_cat_id+"> "+arr2.categories[x2].category_name+"</option> ";
                    }
                    out+='</select>';
                    document.getElementById("category_primary").innerHTML=out;
                        } 
                    );
      

function validate()
      {
          
          if( document.category_insert.category_name.value == "" )
         {
            alert( "Please provide your Category Name!" );
            document.category_insert.category_name.focus() ;
            return false;
         }
             
             
         var fileUpload = document.getElementById("fileUpload");
        if (typeof (fileUpload.files) != "undefined") {
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            
            //           alert(size + " KB.");
                      if(size > 100){
                     // alert(size + " KB.");
                      
                alert( "Your image size"+ size +"KB. Please Select any Image an image size below 100 KB !" )
                        return false;
                      }
        } 
        

         
         return true;
  }
</script>


