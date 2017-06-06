<?php require_once ('theme/header_1.php'); ?>

<?php require_once '../include/config.php';?>
<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add School
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
             
           <!--mastercategory_insert_2.php-->
                
        <form name="school_insert" action="school_insert_2.php" method="POST"  enctype="multipart/form-data">
            <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">School Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="school_name" value="">
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">School Logo</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control"  id="fileUpload" name="school_image" value="">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000" />
                    </div>
                    </div>
                  
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">school_description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="school_description" value="">
                        </div>
                    </div> -->
                     
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                          <select class="form-control" id="status" name="status">
                          <option value= "1">Active</option>
                          <option value= "0">Inactive</option>
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

  
  
  
  <?php require_once ('theme/footer.php');

  if(isset($_GET["status"]) && $_GET["status"]=="failure")
  {
    echo '<script>swal("Oops","'.$_GET["message"].'","error");</script>';
    unset($_GET["status"]);
  }
  ?>









      </script> -->
