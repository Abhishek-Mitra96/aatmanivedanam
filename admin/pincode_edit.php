<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
?>
<?php require_once ('theme/header_2.php'); ?>
<?php require_once ('theme/sidebar.php'); ?>
<?php $id = $_REQUEST['id'];?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <h1>Edit Pincode</h1>
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-horizontal">
                    
                    
                    <div class="form-group">
                        <div class="col-sm-6">
                          <input type="hidden" name="pincode_id" id="pincode_id" value="<?php echo $id ?>">
                      </div>
                    </div>
                    
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
                        <input type="submit" class=" Submit btn btn-primary submit_btn" name="submit" value="submit"> </center>
                  
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
    $.getJSON("../adminapi/pincode/pincode_edit_getdata.php?id="+<?php echo $id ?>,
        function(data) {
            data = JSON.stringify(data);
            var array = JSON.parse(data);
          
            var pincodestart = array[0].pin_code_start ;
            var pincodeend = array[0].pin_code_end;
            var pincoddescription = array[0].description;
            
           
            
           $('#pin_code_start').val(pincodestart);
            $('#pin_code_end').val(pincodeend);
            $('#description').val(pincoddescription);
        }
    );


    $('.submit_btn').click(function() {
        var pin_code_start = $('#pin_code_start').val();
        var pin_code_end = $('#pin_code_end').val();
        var description = $('#description').val();
        var pincodeid = $('#pincode_id').val();
        var visibility_data = $('#visibility').val();
        
        $.ajax({
            type: 'POST',
            url: '../adminapi/pincode/pincode_edit.php',
            data: {
             
            startpin:pin_code_start,
            endpin:pin_code_end,
            desc:description,
            id:pincodeid,
            visibility:visibility_data
            },
            success: function(data) {
                if (data == 1) {
                    alert('Edited successfully!');
                    location.href = "pincode.php";
                } else
                    alert('Error!!!!!');
            }
        });
    })
});
</script>
