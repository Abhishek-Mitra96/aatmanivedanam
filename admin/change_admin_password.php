<?php 
    require_once ('theme/header_1.php'); 
    require_once ('theme/header_2.php'); 
    require_once ('theme/sidebar.php');

    $id = $_REQUEST["id"];
  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <h1>Change Password</h1>    
    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                <form onsubmit="return validate();" name="change_admin_password" action="change_admin_password_2.php" method="POST"  enctype="multipart/form-data">
                <div class="form-horizontal">
            
                    <div class="form-group">
                        <div class="col-sm-6">
                          <input type="hidden" name="brand_id" id="brand_id">
                      </div>
                    </div>
                    
                   <div class="form-group">
                        <label class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Confirm Password</label>
                    <img src="" height="80" id="image">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="confirm_password" id="confirm_password">
                         <input type="hidden" name="hid_id" id="hid_id" value="<?php echo $id; ?>"> 
                    </div>
                    </div>
                    <!--<div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                          <select class="form-control" id="status" name="status">
                          <option value= "1"> Active</option>
                          <option value= "0">Inactive</option>
                          </select>
                        </div>
                    </div>-->
              
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <center>
                        <input type="submit" class=" Submit btn btn-primary" name="submit" value="Save"> </center>
                  
                </div>
                
                </form>
                <!-- /.box-footer -->
            </div>
        </div>
        <!-- /.box-body -->
        </section>
        

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once ('theme/footer.php');

/*if(isset($_GET["success"]) && $_GET["success"]=="false")
  {
    echo '<script>swal("Oops","'.$_GET["message"].'","error");</script>';
    // echo '<script>alert("Data updated successfully");</script>';
    unset($_GET["success"]);
  }*/

  ?>

<!--<script>
    $(document).ready(function()
    {
        
            var id=<?php echo $_GET['id']; ?>;

            $.post("../commonapi/brand/brand_view.php",
            {
                brand_id:id
            },
            function(data)
            {
                var arr=JSON.parse(data);
                $("#brand_id").val(id);
                $("#brand_name").val(arr.brands[0].brand_name);
                $("#status").val(arr.brands[0].status);
                $("#image").attr("src",arr.brands[0].brand_image);
                $("#brand_image_current").val(arr.brands[0].brand_image);

                // http://dnademo.goyalsoftwares.com/assets/image/brand/14743134578.jpg
            })
    })
</script>-->
<script>
function validate()
  {
    $(".error").html("");
    var pass=$("#password").val();
    var cpass=$("#confirm_password").val();
    if(pass=="")
    {
     swal("Error","Password can not be empty.","error");
      return false; 
    }
    if(pass != cpass)
    {
     swal("Error","Password do not match.","error");
      return false; 
    }
         return true;
  }
</script>
