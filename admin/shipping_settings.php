<?php 

  require_once '../include/config.php';

  $flag=0;

  if(isset($_POST["submit"]))
  {
      $min_purchase_amount=$_POST["min_purchase_amount"];
      $shipping_charge=$_POST["shipping_charge"];
      
      $query="Update `settings` set `value`='".$min_purchase_amount."' where `setting_title`='min_purchase_amount'";
      mysqli_query($con,$query);

      $query="Update `settings` set `value`='".$shipping_charge."' where `setting_title`='shipping_charge'";
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
            <h4>Shipping Settings</h4>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Minimum Purchase (Free Shipping)</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" name="min_purchase_amount" id="min_purchase_amount" value="0" >
                    </div>
                    </div>

                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Shipping Charge</label>
                    <div class="col-sm-6">
                        <input type="number" name="shipping_charge" id="shipping_charge"  value="0">
                    </div>
                    </div>
                    <br>
                    <hr>
                    
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
  $arr=shippingSettings();

  if($flag==1)
  {
    echo '<script>toast("Settings updated successfully");</script>';
  }
  ?>
  <script>
    var obj='<?php echo $arr; ?>';

    var arr=JSON.parse(obj);
    $("#min_purchase_amount").val(arr.min_purchase_amount);
    $("#shipping_charge").val(arr.shipping_charge);
  </script>
