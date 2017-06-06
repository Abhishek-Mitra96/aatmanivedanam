<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
?>
<?php require_once ('theme/header_2.php'); ?>
<?php require_once ('theme/sidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <h1>Add new Pincode</h1>
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pincode Start </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="" id="pin_code_start" name="pin_code_start" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pincode End </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="" id="pin_code_end" name="pin_code_end" value="">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Description </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="" id="description" name="description" value="">
                        </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                          <select class="form-control" id="visibility" name="visibility">
                          <option value= "Active">Active</option>
                          <option value= "Inactive">Inactive</option>
                          </select>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <center>
                        <input type="submit" class="Submit btn btn-primary submit_btn" name="submit" value="submit"> </center>
                    
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        <!-- /.box-body -->
        
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once ('theme/footer.php');?>
<script>
$(document).ready(function() {
    $('.submit_btn').click(function() {
        var start_pin = $('#pin_code_start').val();
        var end_pin = $('#pin_code_end').val();
        var description = $('#description').val();
        var visibility_data = $('#visibility').val();
        $.ajax({
            type: 'POST',
            url: '../adminapi/pincode/pincode_add.php',
            data: {
                startpin:start_pin,
                endpin:end_pin,
                desc:description,
                visibility:visibility_data
            },
            success: function(data) {
                
            //   alert(data); [echo query, when api output (echo $query)]
               if (data == 1) {
                    alert('Added successfully!');
                    location.href = "pincode.php";
                } else
                    alert('Error!!');
            }
        });
    });
});
</script>
