<?php 

require_once '../include/config.php';

require_once ('theme/header_1.php'); 

require_once ('theme/header_2.php');

require_once ('theme/sidebar.php'); ?>

<?php 

$obj=new stdClass();

$obj->nolimit=1;
$obj->viewall=1;

$arr_category=json_decode(categoryList($obj));
$arr_tour=json_decode(tourList($obj));
$arr_user=json_decode(userList($obj));

?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

<!-- Content Header (Page header) -->

<section class="content-header">

  <h1>Add new Coupon</h1>



</section>

<style type="text/css">

#upd_btn {

    display: inline-block;

}

#upload8 {

    display: inline-block;

}

ul.list {

    list-style: none;

}

ul.list li {

    border-bottom: 1px solid #ddd;

}

ul.list li:hover {

    background-color: #3C8DBC;

    color: #fff;

    cursor: pointer;

}

</style>


<!-- it change the menu style
<link rel="stylesheet" href="../assets/plugins/chosen/docsupport/style.css">-->

<link rel="stylesheet" href="../assets/plugins/chosen/docsupport/prism.css">

<link rel="stylesheet" href="../assets/plugins/chosen/chosen.css">



<!-- Main content -->

<section class="content">



<div class="box box-primary">



    <div class="box-body">



        <form onsubmit="return validate();" name="coupon_insert" action="coupon_insert_2.php" method="POST"  enctype="multipart/form-data">    

            

            <div class="form-horizontal">

                

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Coupon Code</label>

                    <div class="col-sm-6">

                    <input type="text" class="form-control"  id="coupon_code" name="coupon_code" value="" onblur="coupon_code_check()" style="text-transform: uppercase;" required maxlength="50">

                    </div>
                    <div class="col-sm-2" id="coupon_code_error"></div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Coupon detail</label>

                    <div class="col-sm-6">

                        <textarea class="form-control"  id="coupon_detail" name="coupon_detail" required></textarea>

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Valid from</label>

                    <div class="col-sm-3">

                        <input type="date" class="form-control"  id="valid_from_date" name="valid_from_date" value="<?=date('Y-m-d');?>" required >

                    </div>

                    <div class="col-sm-3">

                        <input type="time" class="form-control"  id="valid_from_time" name="valid_from_time" value="<?=date('H:i');?>" required >

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Valid till</label>

                    <div class="col-sm-3">

                        <input type="date" class="form-control"  id="valid_till_date" name="valid_till_date" value="<?=date('Y-m-d');?>" required >

                    </div>

                    <div class="col-sm-3">

                        <input type="time" class="form-control"  id="valid_till_time" name="valid_till_time" value="<?=date('H:i');?>" required >

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Min Booking Quantity</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="min_quantity" name="min_quantity" value="1" required min="0" >

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Min Booking Amount (<i class="fa fa-inr"></i>)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="min_amount" name="min_amount" value="0" required min="0">

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Discount Type (<i class="fa fa-inr"></i>)</label>

                    <div class="col-sm-3">

                        <center><input type="radio" name="discount_type" value="amount" checked>&nbsp;Amount</center>

                    </div>

                    <div class="col-sm-3">

                        <center><input type="radio" name="discount_type" value="percent">&nbsp;Percent</center>

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Discount (<i class="fa fa-inr"></i>)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="discount" name="discount" value="0" required min="0">

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Max Discount (<i class="fa fa-inr"></i>)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="max_discount" name="max_discount" value="0" required min="0">

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Min Booking Amount (<i class="fa fa-usd"></i>)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="min_amount_usd" name="min_amount_usd" value="0" required min="0">

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Discount Type (<i class="fa fa-usd"></i>)</label>

                    <div class="col-sm-3">

                        <center><input type="radio" name="discount_type_usd" value="amount" checked>&nbsp;Amount</center>

                    </div>

                    <div class="col-sm-3">

                        <center><input type="radio" name="discount_type_usd" value="percent">&nbsp;Percent</center>

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Discount (<i class="fa fa-usd"></i>)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="discount_usd" name="discount_usd" value="0" required min="0">

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Max Discount (<i class="fa fa-usd"></i>)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="max_discount_usd" name="max_discount_usd" value="0" required min="0">

                    </div>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Maximum Use <br>(for each user)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="max_use" name="max_use" value="0" required min="0">

                    </div>
                    <label class="col-sm-2">0 for Infinite</label>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">Maximum Use <br>(for this coupon)</label>

                    <div class="col-sm-6">

                    <input type="number" class="form-control"  id="max_use_global" name="max_use_global" value="0" required min="0">

                    </div>
                    <label class="col-sm-2">0 for Infinite</label>

                </div>

                <div class="form-group">

                    <label  class="col-sm-3 control-label">First Purchase Only</label>

                    <div class="col-sm-3">

                        <center><input type="radio" name="first_purchase_only" value="1" checked>&nbsp;Yes</center>

                    </div>

                    <div class="col-sm-3">

                        <center><input type="radio" name="first_purchase_only" value="0">&nbsp;No</center>

                    </div>

                </div>



                <div class="form-group">

                    <hr><center><label>Coupon Applicable on</label></center><hr>

                </div>



                <table class="table table-responsive" id="myTable">

                    <tr>

                        <th class="col-sm-3">Category</th>

                        <th class="col-sm-3">Tour</th>

                        <th class="col-sm-3">User</th>

                        <th class="col-sm-3">Not User</th>

                    </tr>

                    <tr id='firsttr'>

                        <td id="firsttd">

                            <input type="checkbox" id="category_for_all" name="category_for_all" value="1" checked>&nbsp;<label>For All</label>
                            <select class="form-control chosen-select" multiple id="category_list" name="category_list[]" tabindex="3" disabled>
                                <?php
                                    for($i=0;$i<sizeof($arr_category->categories);$i++){
                                        echo '<option value="'.$arr_category->categories[$i]->id.'">'.$arr_category->categories[$i]->category_name.'</option>';
                                    }
                                ?>
                            </select>
                            <p id="category_error"></p>
                        </td>

                        <td id="secondtd">

                            <input type="checkbox" id="tour_for_all" name="tour_for_all" value="1" checked>&nbsp;<label>For All</label>

                            <select class="form-control chosen-select" multiple id="tour_list" name="tour_list[]" tabindex="3" disabled>
                                <?php
                                    for($i=0;$i<sizeof($arr_tour->tours);$i++){
                                        echo '<option value="'.$arr_tour->tours[$i]->tour_id.'">'.$arr_tour->tours[$i]->tour_name.'</option>';
                                    }
                                ?>
                            </select>
                            <p id="tour_error"></p>
                        </td>

                        <td id="thirdtd">

                            <input type="checkbox" id="user_for_all" name="user_for_all" value="1" checked>&nbsp;<label>For All</label>

                            <select class="form-control chosen-select" multiple id="user_list" name="user_list[]" tabindex="3" disabled>
                                <?php
                                    for($i=0;$i<sizeof($arr_user->users);$i++){
                                        echo '<option value="'.$arr_user->users[$i]->id.'">'.$arr_user->users[$i]->fname.' '.$arr_user->users[$i]->lname.'</option>';
                                    }
                                ?>
                            </select>
                            <p id="user_error"></p>
                        </td>

                        <td id="fourthtd">
                            <label></label>
                            <select class="form-control chosen-select" multiple id="not_user_list" name="not_user_list[]" tabindex="3">
                                <?php
                                    for($i=0;$i<sizeof($arr_user->users);$i++){
                                        echo '<option value="'.$arr_user->users[$i]->id.'">'.$arr_user->users[$i]->fname.' '.$arr_user->users[$i]->lname.'</option>';
                                    }
                                ?>
                            </select>

                        </td>

                    </tr>

                </table>



                <div class="box-footer">

                    <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" id="submit" value="Add Coupon"> </center>

                </div><!-- /.box-footer -->

              

            </div><!-- /.box-body -->



        </form>

     

    </div> 

    

    

</div>

</section>



<!-- /.content -->

</div>

<!-- /.content-wrapper -->

<?php require_once ('theme/footer.php');?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>-->

<script src="../assets/plugins/chosen/chosen.jquery.js" type="text/javascript"></script>

<script src="../assets/plugins/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

var config = {

  '.chosen-select'           : {},

  '.chosen-select-deselect'  : {allow_single_deselect:true},

  '.chosen-select-no-single' : {disable_search_threshold:10},

  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},

  '.chosen-select-width'     : {width:"95%"}

}

for (var selector in config) {

  $(selector).chosen(config[selector]);

}

</script>



<script>

CKEDITOR.replace( 'coupon_detail' );



$('#category_for_all').click(function() {
    $('#category_list').prop('disabled', this.checked).trigger("chosen:updated");
});

$('#tour_for_all').click(function() {
    $('#tour_list').prop('disabled',this.checked).trigger("chosen:updated");
});

$('#user_for_all').click(function() {
    $('#user_list').prop('disabled',this.checked).trigger("chosen:updated");
    $('#not_user_list').prop('disabled',!this.checked).trigger("chosen:updated");
});

function coupon_code_check(){
    var coupon_code=$("#coupon_code").val();
    if(coupon_code!=""){
        $("#coupon_code_error").html("<i class='fa fa-spinner'></i>");
        $.post("../adminapi/coupon/coupon_code_check.php", 
            {
                coupon_code:coupon_code
            },
            function(data){
                //console.log(data);
                if(data==1) $("#coupon_code_error").html("<i class='fa fa-check' style='color:green'></i>");
                else $("#coupon_code_error").html("<i class='fa fa-times' style='color:red'></i>");
            });
    }
}

function validate(){

    console.log($("textarea#coupon_detail").val());



    //coupon_code validation

    if($("#coupon_code").val()==""){

      swal("Error","Coupon Code can not be empty.","error");

      return false;

    }

    /*coupon_detail validation

    if($("textarea#coupon_detail").val()==""){

      swal("Error","Coupon Detail can not be empty.","error");

      return false;

    }*/

    //min_quantity validation

    if($("#min_quantity").val()==""){

      swal("Error","Minimum Quantity can not be empty.","error");

      return false;

    }

    //min_amount validation

    if($("#min_amount").val()==""){

      swal("Error","Minimum Amount can not be empty.","error");

      return false;

    }


    //discount validation

    if($("#discount").val()==""){

      swal("Error","Discount can not be empty.","error");

      return false;

    }

    //max_discount validation

    if($("#max_discount").val()==""){

      swal("Error","Maximum Discount can not be empty.","error");

      return false;

    }

    //min_amount_usd validation

    if($("#min_amount_usd").val()==""){

      swal("Error","Minimum Amount USD can not be empty.","error");

      return false;

    }


    //discount_usd validation

    if($("#discount_usd").val()==""){

      swal("Error","Discount USD can not be empty.","error");

      return false;

    }

    //max_discount_usd validation

    if($("#max_discount").val()==""){

      swal("Error","Maximum Discount USD can not be empty.","error");

      return false;

    }

    //max_use validation

    if($("#max_use").val()==""){

      swal("Error","Maximum Usage cannot be empty","error");

      return false;

    }

    //max_use_global validation

    if($("#max_use_global").val()==""){

      swal("Error","Maximum Usage for this coupon cannot be empty","error");

      return false;

    }

    return true;

}

</script>

<?php
$error=$_GET["error"];
if(isset($error)){
    if($error=="0") echo '<script>swal("Error","This Coupon Code is already in the database. please choose another Coupon Code","error");</script>';
    if($error=="1") echo '<script>swal("Error","please select atleast one category","error");</script>';
    if($error=="2") echo '<script>swal("Error","Please select atleast one tour","error");</script>';
    if($error=="3") echo '<script>swal("Error","Please select atleast one user","error");</script>';
}
?>