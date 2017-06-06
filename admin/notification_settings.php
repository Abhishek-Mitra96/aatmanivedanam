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
      $admin_mobile=$_POST["admin_mobile"];

      $notification_process_order=$_POST["process_order_app"];
      $notification_dispatch_order=$_POST["dispatch_order_app"];
      $notification_deliver_order=$_POST["deliver_order_app"];
      $notification_cancel_order=$_POST["cancel_order_app"];

      $query="Update `settings` set `value`='".$new_order."' where `setting_title`='sms_new_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$process_order."' where `setting_title`='sms_process_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$dispatch_order."' where `setting_title`='sms_dispatch_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$deliver_order."' where `setting_title`='sms_deliver_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$cancel_order."' where `setting_title`='sms_cancel_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$admin_mobile."' where `setting_title`='admin_mobile'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$notification_process_order."' where `setting_title`='notification_process_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$notification_dispatch_order."' where `setting_title`='notification_dispatch_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$notification_deliver_order."' where `setting_title`='notification_deliver_order'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$notification_cancel_order."' where `setting_title`='notification_cancel_order'";
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
        Notification Settings
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
             
           <!--mastercategory_insert_2.php-->
                
        <form name="brand_insert" action="" method="POST"  enctype="multipart/form-data">
            <div class="form-horizontal">
            <h4>SMS Notifications</h4>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">New Order</label>
                        <div class="col-sm-6">
                            <select name="new_order" id="new_order">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Processing</label>
                    <div class="col-sm-6">
                        <select name="process_order" id="process_order">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Dispatched</label>
                    <div class="col-sm-6">
                        <select name="dispatch_order" id="dispatch_order">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>
                  
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Delivered</label>
                    <div class="col-sm-6">
                        <select name="deliver_order" id="deliver_order">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Cancelled</label>
                    <div class="col-sm-6">
                        <select name="cancel_order" id="cancel_order">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Admin Mobile</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="10" name="admin_mobile" id="admin_mobile">
                    </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <h4>App Notifications</h4>

                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">New Order</label>
                        <div class="col-sm-6">
                            <select name="new_order_app" id="new_order_app">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                        </div>
                    </div> -->
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Processing</label>
                    <div class="col-sm-6">
                        <select name="process_order_app" id="process_order_app">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Dispatched</label>
                    <div class="col-sm-6">
                        <select name="dispatch_order_app" id="dispatch_order_app">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>
                  
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Delivered</label>
                    <div class="col-sm-6">
                        <select name="deliver_order_app" id="deliver_order_app">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Order Cancelled</label>
                    <div class="col-sm-6">
                        <select name="cancel_order_app" id="cancel_order_app">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
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
  $arr=smsNotificationSettings();

  if($flag==1)
  {
    echo '<script>toast("Settings updated successfully");</script>';
  }
  ?>
  <script>
    var obj='<?php echo $arr; ?>';
    var arr=JSON.parse(obj);
    $("#new_order").val(arr.sms_new_order);
    $("#process_order").val(arr.sms_process_order);
    $("#dispatch_order").val(arr.sms_dispatch_order);
    $("#deliver_order").val(arr.sms_deliver_order);
    $("#cancel_order").val(arr.sms_cancel_order);
    $("#admin_mobile").val(arr.admin_mobile);
    $("#process_order_app").val(arr.notification_process_order);
    $("#dispatch_order_app").val(arr.notification_dispatch_order);
    $("#deliver_order_app").val(arr.notification_deliver_order);
    $("#cancel_order_app").val(arr.notification_cancel_order);
  </script>
