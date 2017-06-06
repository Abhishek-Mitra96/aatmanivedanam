<?php 
    require_once ('theme/header_1.php'); 
    require_once ('theme/header_2.php'); 
    require_once ('theme/sidebar.php');
  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <h1>Edit Country</h1>    
    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                <form name="country_edit" action="country_edit_2.php" method="POST"  enctype="multipart/form-data">
                <div class="form-horizontal">
            
                    <div class="form-group">
                        <div class="col-sm-6">
                          <input type="hidden" name="id" id="id">
                      </div>
                    </div>
                    
                   <div class="form-group">
                        <label class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="country" id="country">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ISD Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="isd_code" id="isd_code">
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

            $.post("../adminapi/country/country_view.php",
            {
                country_id:id
            },
            function(data)
            {
                var arr=JSON.parse(data);
                $("#id").val(id);
                $("#country").val(arr.countries[0].country);
                $("#isd_code").val(arr.countries[0].isd_code);
            })
    })
</script>
