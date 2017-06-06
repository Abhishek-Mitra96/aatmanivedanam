<?php 

  require_once '../include/config.php';

  $flag=0;

  if(isset($_POST["submit"]))
  {
      $auto_approve_user=$_POST["auto_approve_user"];
      // $screenshot_allowed=$_POST["screenshot_allowed"];
      $manage_inventory=$_POST["manage_inventory"];
      $cod_allowed=$_POST["cod_allowed"];
      $online_payment=$_POST["online_payment"];
      $tax_applicable=$_POST["tax_applicable"];
      $loyalty_management=$_POST["loyalty_management"];
      $loyalty_merchant_key=$_POST["loyalty_merchant_key"];

      $query="Update `settings` set `value`='".$auto_approve_user."' where `setting_title`='auto_approve_user'";
      mysqli_query($con,$query);

      // $query="Update `settings` set `value`='".$screenshot_allowed."' where `setting_title`='screenshot_allowed'";
      // mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$manage_inventory."' where `setting_title`='manage_inventory'";
      mysqli_query($con,$query);

      // $query="Update `settings` set `value`='".$cod_allowed."' where `setting_title`='cod_allowed'";
      // mysqli_query($con,$query);

      // $query="Update `settings` set `value`='".$online_payment."' where `setting_title`='online_payment'";
      // mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$tax_applicable."' where `setting_title`='tax_applicable'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$loyalty_management."' where `setting_title`='loyalty_management'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$loyalty_merchant_key."' where `setting_title`='loyalty_merchant_key'";
      mysqli_query($con,$query);

      // $query="Update `settings` set `value`='".$notification_deliver_order."' where `setting_title`='notification_deliver_order'";
      // mysqli_query($con,$query);

      // $query="Update `settings` set `value`='".$notification_cancel_order."' where `setting_title`='notification_cancel_order'";
      // mysqli_query($con,$query);

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
        General Settings
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
                        <label class="col-sm-2 control-label">Auto Approve User</label>
                        <div class="col-sm-6">
                            <select name="auto_approve_user" id="auto_approve_user">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                
                    <!-- <div class="form-group">
                    <label  class="col-sm-2 control-label">Screenshot Allowed in App</label>
                    <div class="col-sm-6">
                        <select name="screenshot_allowed" id="screenshot_allowed">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div> -->

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Manage Inventory</label>
                    <div class="col-sm-6">
                        <select name="manage_inventory" id="manage_inventory">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>
                  
                  <!-- <div class="form-group">
                    <label  class="col-sm-2 control-label">Cash on Delivery</label>
                    <div class="col-sm-6">
                        <select name="cod_allowed" id="cod_allowed">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Online Payment</label>
                    <div class="col-sm-6">
                        <select name="online_payment" id="online_payment">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div>  -->

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Tax applicable on Products</label>
                    <div class="col-sm-6">
                        <select name="tax_applicable" id="tax_applicable">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div> 

                    <!-- <hr>
                    <h4>Loyalty Management</h4>
                    <br>
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Loyalty Management</label>
                    <div class="col-sm-6">
                        <select name="loyalty_management" id="loyalty_management">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            </select>
                    </div>
                    </div> 

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Loyalty Merchant Token</label>
                    <div class="col-sm-6">
                       <input type="text" name="loyalty_merchant_key" id="loyalty_merchant_key">
                    </div>
                    </div> --> 
                    
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
  $arr=generalSettings();

  if($flag==1)
  {
    echo '<script>swal("Success","Settings updated successfully","success");</script>';
  }
  ?>
  <script>
    var obj='<?php echo $arr; ?>';
    var arr=JSON.parse(obj);
    $("#auto_approve_user").val(arr.auto_approve_user);
    // $("#screenshot_allowed").val(arr.screenshot_allowed);
    $("#manage_inventory").val(arr.manage_inventory);
    // $("#cod_allowed").val(arr.cod_allowed);
    // $("#online_payment").val(arr.online_payment);
    $("#tax_applicable").val(arr.tax_applicable);
    // $("#loyalty_management").val(arr.loyalty_management);
    // $("#loyalty_merchant_key").val(arr.loyalty_merchant_key);
    // $("#deliver_order_app").val(arr.notification_deliver_order);
    // $("#cancel_order_app").val(arr.notification_cancel_order);
  </script>
