<?php 

  require_once '../include/config.php';

  $flag=0;

  if(isset($_POST["submit"]))
  {
      $new_order=$_POST["new_order"];
      $process_order=$_POST["process_order"];
      $dispatch_order=$_POST["dispatch_order"];
      $deliver_order=$_POST["deliver_order"];
      $cancel_order=$_POST["cancel_order"];

      $query="Update `settings` set `value`='".$new_order."' where `setting_title`='new_order_template'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$process_order."' where `setting_title`='process_order_template'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$dispatch_order."' where `setting_title`='dispatch_order_template'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$deliver_order."' where `setting_title`='delivered_order_template'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$cancel_order."' where `setting_title`='cancel_order_template'";
      mysqli_query($con,$query);

      $flag=1;
  }
?>
<?php require_once ('theme/header_1.php'); ?>

<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Message Templates
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
             
           <!--mastercategory_insert_2.php-->
                
        <form name="brand_insert" action="" method="POST"  enctype="multipart/form-data">
            <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">New Order</label>
                        <div class="col-sm-6">
                            <textarea  name="new_order" id="new_order">
                              
                            </textarea>
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Processing</label>
                    <div class="col-sm-6">
                        <textarea  name="process_order" id="process_order">
                              
                            </textarea>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Dispatched</label>
                    <div class="col-sm-6">
                        <textarea  name="dispatch_order" id="dispatch_order">
                              
                            </textarea>
                    </div>
                    </div>
                  
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Delivered</label>
                    <div class="col-sm-6">
                        <textarea  name="deliver_order" id="deliver_order">
                              
                            </textarea>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Cancelled</label>
                    <div class="col-sm-6">
                        <textarea  name="cancel_order" id="cancel_order">
                              
                            </textarea>
                    </div>
                    </div>                    
    </div>

        <div class="box-footer">
            <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" value="Save"> </center>
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
  $arr=templates();

  if($flag==1)
  {
    echo '<script>swal("Success","Templates updated successfully","success");</script>';
  }
  ?>
  <script>
    var obj='<?php echo $arr; ?>';
    var arr=JSON.parse(obj);
    $("#new_order").val(arr.new_order_template);
    $("#process_order").val(arr.process_order_template);
    $("#dispatch_order").val(arr.dispatch_order_template);
    $("#deliver_order").val(arr.delivered_order_template);
    $("#cancel_order").val(arr.cancel_order_template);
  </script>
