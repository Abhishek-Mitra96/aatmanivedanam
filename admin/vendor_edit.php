<?php 
    require_once ('theme/header_1.php'); 
    require_once ('theme/header_2.php'); 
    require_once ('theme/sidebar.php');
    $obj=new stdClass();

    $obj->nolimit=1;
    $data=json_decode(countryList($obj));
  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <h1>Edit Vendor</h1>    
    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                <form name="vendor_edit" action="vendor_edit_2.php" method="POST"  enctype="multipart/form-data">
                <div class="form-horizontal">
            
                    <div class="form-group">
                        <div class="col-sm-6">
                          <input type="hidden" name="vendor_id" id="vendor_id">
                      </div>
                    </div>
                    
                   <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="vendor_name" id="vendor_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="vendor_email" id="vendor_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Mobile</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="vendor_mobile" id="vendor_mobile">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-6">
                            <?php

                            if($data->status=="success")
                            {
                              echo '<select class="form-control" id="country_id" name="country_id">';

                              for($i=0;$i<sizeof($data->countries);$i++)
                              {
                                echo '<option value= "'.$data->countries[$i]->id.'">'.$data->countries[$i]->country.'</option>';
                              }
                              echo '</select>';
                            }
                            ?>
                            </div>
                          <a href="country_insert.php" class="btn btn-warning"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Country</a>
                    </div>
                	<div class="form-group">
                        <label class="col-sm-2 control-label">Organization Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="organization_name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Work Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="work_email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Personal Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="personal_email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Landline</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="landline" value="" max="9999999999">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bank Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="bank_name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">A/C No</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="ac_no" value="" max="9999999999">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">IFSC Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="ifsc_code" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Swift Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="swift_code" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Branch Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="branch_name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type of Account</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="ac_type" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">PAN No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="pan_no" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">IEC</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="iec" value="">
                        </div>
                    </div>
                
                <!-- 
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Vendor Image</label>
                    <img src="" height="80" id="image">
                    <div class="col-sm-6">
                        <input type="file" class="form-control"  id="vendor_image" name="vendor_image" value="">
                         <input type="hidden" name="vendor_image_current" id="vendor_image_current"> 
                    </div>
                    </div> -->
                    <!-- <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                          <select class="form-control" id="status" name="status">
                          <option value= "1"> Active</option>
                          <option value= "0">Inactive</option>
                          </select>
                        </div>
                    </div> -->
              
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

            $.post("../adminapi/vendor/vendor_view.php",
            {
                vendor_id:id
            },
            function(data)
            {
                console.log(data);
                var arr=JSON.parse(data);
                $("#vendor_id").val(id);
                $("#vendor_name").val(arr.vendors[0].name);
                $("#vendor_email").val(arr.vendors[0].email);
                $("#vendor_mobile").val(arr.vendors[0].mobile);
                $("#country_id").val(arr.vendors[0].country_id);
				$('input[name="organization_name"]').val(arr.vendors[0].org_name);
				$('input[name="work_email"]').val(arr.vendors[0].work_email);
				$('input[name="personal_email"]').val(arr.vendors[0].personal_email);
				$('input[name="landline"]').val(arr.vendors[0].landline);
				$('input[name="bank_name"]').val(arr.vendors[0].bank_name);
				$('input[name="ac_no"]').val(arr.vendors[0].ac_no);
				$('input[name="ifsc_code"]').val(arr.vendors[0].ifsc);
				$('input[name="swift_code"]').val(arr.vendors[0].swift_code);
				$('input[name="branch_name"]').val(arr.vendors[0].branch_name);
				$('input[name="ac_type"]').val(arr.vendors[0].account_type);
				$('input[name="pan_no"]').val(arr.vendors[0].pan);
				$('input[name="iec"]').val(arr.vendors[0].iec);
            })
    })
</script>
