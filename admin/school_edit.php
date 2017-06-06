<?php 
    require_once ('theme/header_1.php'); 
    require_once ('theme/header_2.php'); 
    require_once ('theme/sidebar.php');
  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <h1>Edit School</h1>    
    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                <form name="school_edit" action="school_edit_2.php" method="POST"  enctype="multipart/form-data">
                <div class="form-horizontal">
            
                    <div class="form-group">
                        <div class="col-sm-6">
                          <input type="hidden" name="school_id" id="school_id">
                      </div>
                    </div>
                    
                   <div class="form-group">
                        <label class="col-sm-2 control-label">School Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="school_name" id="school_name">
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Logo</label>
                    <img src="" height="80" id="image">
                    <div class="col-sm-6">
                        <input type="file" class="form-control"  id="school_image" name="school_image" value="">
                         <input type="hidden" name="school_image_current" id="school_image_current"> 
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                          <select class="form-control" id="status" name="status">
                          <option value= "1"> Active</option>
                          <option value= "0">Inactive</option>
                          </select>
                        </div>
                    </div>
              
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

if(isset($_GET["success"]) && $_GET["success"]=="false")
  {
    echo '<script>swal("Oops","'.$_GET["message"].'","error");</script>';
    // echo '<script>alert("Data updated successfully");</script>';
    unset($_GET["success"]);
  }

  ?>

<script>
    $(document).ready(function()
    {
        
            var id=<?php echo $_GET['id']; ?>;

            $.post("../commonapi/school/school_view.php",
            {
                school_id:id
            },
            function(data)
            {
                var arr=JSON.parse(data);
                $("#school_id").val(id);
                $("#school_name").val(arr.schools[0].name);
                $("#status").val(arr.schools[0].status);
                $("#image").attr("src",arr.schools[0].logo);
                $("#school_image_current").val(arr.schools[0].school_image);
            })
    })
</script>
