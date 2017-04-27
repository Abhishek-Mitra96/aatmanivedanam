<?php require_once ('theme/header_1.php'); ?>

<?php require_once '../include/config.php';?>
<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); 

$obj=new stdClass();

$obj->nolimit=1;
$data=json_decode(countryList($obj));

?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Vendor
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
         <div class="alert alert-danger" id="msgerror" style="display:none; text-align:center; font-weight:800;"></div>
        <form name="vendor_insert" id="vendorInsert" action="vendor_insert_2.php" method="POST">
            <div class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="vendor_name" value="">
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Vendor Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="vendor_email" value="">
                    </div>
                    </div>
                  
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Mobile</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="vendor_mobile" value="" max="9999999999">
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
                     
                   <!--  <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                          <select class="form-control" id="status" name="status">
                          <option value= "1">Active</option>
                          <option value= "0">Inactive</option>
                          </select>
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

  
  
  
  <?php require_once ('theme/footer.php');

  if(isset($_GET["status"]) && $_GET["status"]=="failure")
  {
    echo '<script>swal("Oops","'.$_GET["message"].'","error");</script>';
    unset($_GET["status"]);
  }
  ?>

<script>
$(document).ready(function(e) {
    $('.submit_btn').click(function(e) {
        var vendor_name = $('input[name="vendor_name"]').val();
		var vendor_email = $('input[name="vendor_email"]').val();
		var vendor_mobile = $('input[name="vendor_mobile"]').val();
		var country_id = $('input[name="country_id"]').val();
		var organization_name = $('input[name="organization_name"]').val();
		var work_email = $('input[name="work_email"]').val();
		var personal_email = $('input[name="personal_email"]').val();
		var landline = $('input[name="landline"]').val();
		var bank_name = $('input[name="bank_name"]').val();
		var ac_no = $('input[name="ac_no"]').val();
		var ifsc_code = $('input[name="ifsc_code"]').val();
		var swift_code = $('input[name="swift_code"]').val();
		var branch_name = $('input[name="branch_name"]').val();
		var ac_type = $('input[name="ac_type"]').val();
		var pan_no = $('input[name="pan_no"]').val();
		var iec = $('input[name="iec"]').val();
		
		if(vendor_name == '')
		{
			$('#msgerror').text("Vendor Name Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}
		if(vendor_email == '')
		{
			$('#msgerror').text("Vendor Email Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');
			return false;
		}
		if(vendor_mobile == '')
		{
			$('#msgerror').text("Vendor Mobile Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}
		if(country_id == '')
		{
			$('#msgerror').text("Country Name Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}
		if(organization_name == '')
		{
			$('#msgerror').text("Organization Name Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(work_email == '')
		{
			$('#msgerror').text("Work Email Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(personal_email == '')
		{
			$('#msgerror').text("Personal Email Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(landline == '')
		{
			$('#msgerror').text("Landline Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(bank_name == '')
		{
			$('#msgerror').text("Bank Name Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(ac_no == '')
		{
			$('#msgerror').text("Account Number Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(ifsc_code == '')
		{
			$('#msgerror').text("IFSC code Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(swift_code == '')
		{
			$('#msgerror').text("Swift Code Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(branch_name == '')
		{
			$('#msgerror').text("Branch Name Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(ac_type == '')
		{
			$('#msgerror').text("Account Type Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(pan_no == '')
		{
			$('#msgerror').text("PAN Number Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}if(iec == '')
		{
			$('#msgerror').text("IEC Can't be blank");
			$('#msgerror').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#msgerror').delay(5000).fadeOut('slow');	
			return false;
		}
		//$('#vendorInsert').submit();
    });
	
});
</script>
