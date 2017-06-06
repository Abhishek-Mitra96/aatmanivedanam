<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>

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
      <h1>Add new Admin</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">


                <form onsubmit="return validate();" name="create_admin" action="create_admin_2.php" method="POST"  enctype="multipart/form-data">    
                    
                <div class="form-horizontal">
                

                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  id="name" name="name" value="">
                             </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-6">
                            <input type="password" class="form-control" placeholder="" id="password" name="password" value="">
                            </div>
                    </div>
                    
                 
                    <div class="form-group">
                            <label  class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-6">
                             <input type="password" class="form-control" placeholder="" id="cpassword" name="cpassword" value="">
                            

                            </div>
                    </div>
                      
                     <div class="form-group">
                            <label  class="col-sm-2 control-label">Mobile</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="mobile" name="mobile" value="" max="9999999999">
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
/*$.getJSON("../commonapi/brand/brand_view.php",

        function(brand){
         data = JSON.stringify(brand);   
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
              document.getElementById("brand_loc").innerHTML=out ;
          }
        });*/


       
function validate()
  {
    $(".error").html("");
    var p=$("#product_name").val();
    if(p=="")
    {
      swal("Error","Admin name can not be empty.","error");
      return false;
    }
    var pass=$("#password").val();
    var cpass=$("#cpassword").val();
    if(pass=="")
    {
     swal("Error","Password name can not be empty.","error");
      return false; 
    }
    if(pass != cpass)
    {
     swal("Error","Password do not match.","error");
      return false; 
    }
    var mobile=$("#mobile").val();
    if(mobile.length != 10)
    {
     swal("Error","mobile should be 10 digits.","error");
      return false;  
    }
   
         return true;
  }
</script>