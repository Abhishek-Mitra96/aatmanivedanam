<?php 

require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');
?>
</section>

<div class="content-wrapper">
      
  <section class="content-header">
     <h1> Manage Coupon
    <a href="coupon_insert.php" class="btn btn-info pull-right" role="button">Add Coupon</a>
  </section>
      
    <section class="content">

        <div class="box box-primary" id="box-widget">
            
            <div class="box-header">

        <div class="row">
          <div class="col-xs-12 col-sm-5">
            <input class="couponFilter" type="radio" name="filter" value="-2" checked="checked"> &nbsp;All Coupons &nbsp; &nbsp;
            <input class="couponFilter" type="radio" name="filter" value="1"> &nbsp;Active Coupons &nbsp; &nbsp;
            <input class="couponFilter" type="radio" name="filter" value="0"> &nbsp;Inactive Coupons &nbsp; &nbsp;
          </div>
          <div class="col-xs-12 col-sm-1"></div>

          <div class="col-xs-12 col-sm-4">
            <input type="text" id="search_coupon" name="search_coupon" class="form-control input-sm" placeholder="Search" value=""/>
          </div>

          <div class="col-xs-12 col-sm-2">
            <button type="submit" class="btn btn-primary search_btn"><i class="fa fa-search"></i> Search</button>
          </div>
        </div>
               
            </div><!-- /.box-header -->
            
            <div class="divide20"></div>
            <div class="box-body table-responsive no-padding">
              <div id="content">
                <h4 class="text-center">Please wait</h4>
              </div>
            </div>

            <div class="box-footer"></div>
        </div>

    </section>
 </div>
 <?php require_once ('theme/footer.php');?>

<script>


$(document).ready(function() {
    $('.search_btn').click(function() {
        search_coupon();
    });
    
    $('#search_coupon').keyup(function(e) {
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
          pagination(1,5,1);
            search_coupon();
        }
         // ****************e.which==27 for ESC key working ****************************
        else if(e.which==27)
        {
            $('#search_coupon').val("");
            pagination(1,5,1);
            search_coupon();
        }
        
    });
    
});

$("body").on("change",".couponFilter",function(){
  search_coupon();
});


function search_coupon(){
    var searchkey = $('#search_coupon').val();
       var status=$('input:radio[name=filter]:checked').val();
       var page=$(".active1").attr("page");
       
        $.ajax({
            type: 'POST',
            url: '../adminapi/coupon/coupon_list.php',
            data: {
                search:searchkey,
                status:status,
                page:page,
                limit:10
                },
            success: function(data) {
              console.log(data);
              print_data(data);
            }
        });
}
 
function print_data(data){
  // console.log(fetchdata);
  var arr=JSON.parse(data);

  if(arr.status=="success"){

    var i;
    var out='';

    var coupon_count=arr.coupon.length;
    if(coupon_count!=0){
      //atleast one row return
      //out+='<div class="box box-primary"><div class="box-body table-responsive no-padding">';

      out+='<table class="table table-striped"><tbody>';
      out+='<tr>';
      out+='<th class="col-sm-1">Coupon</th>';
      out+='<th class="col-sm-2 text-center">Detail</th>';
      out+='<th class="col-sm-2">Validity</th>';
      out+='<th class="col-sm-2">Minimum</th>';
      out+='<th class="col-sm-2">Discount</th>';
      out+='<th class="col-sm-2">Others</th>';
      out+='<th class="col-sm-1">Action</th>';
      out+='</tr>';
      for(i=0;i<coupon_count;i++){
        out+='<tr>';

        if(arr.coupon[i].status=="1")
          out+='<td><a href="coupon_details.php?id='+arr.coupon[i].id+'" class="text-success">'+arr.coupon[i].coupon_code+'</a></td>';
        else out+='<td><a href="coupon_details.php?id='+arr.coupon[i].id+'" class="text-danger">'+arr.coupon[i].coupon_code+'</a></td>';
        out+='<td>'+arr.coupon[i].coupon_detail+'</td>';
        out+='<td>'+arr.coupon[i].valid_from+'<br>'+arr.coupon[i].valid_till+'</td>';

        out+='<td>amount : <i class="fa fa-inr"></i>&nbsp;'+arr.coupon[i].min_amount+', <i class="fa fa-usd"></i>&nbsp;'+arr.coupon[i].min_amount_usd+'<br>';
        out+='Booking : '+arr.coupon[i].min_quantity+'</td>';

        out+='<td>';
        if(arr.coupon[i].discount_type=="percent") out+=arr.coupon[i].discount+' %, Max : <i class="fa fa-inr"></i>&nbsp;'+arr.coupon[i].max_discount;
        else if(arr.coupon[i].discount_type=="amount") out+='<i class="fa fa-inr"></i>&nbsp;'+arr.coupon[i].discount+', Max : <i class="fa fa-inr"></i>&nbsp;'+arr.coupon[i].max_discount;
        else out+='error';

        out+='<br>';

        if(arr.coupon[i].discount_type_usd=="percent") out+=arr.coupon[i].discount_usd+' %, Max : <i class="fa fa-usd"></i>&nbsp;'+arr.coupon[i].max_discount_usd;
        else if(arr.coupon[i].discount_type_usd=="amount") out+='<i class="fa fa-usd"></i>&nbsp;'+arr.coupon[i].discount_usd+', Max : <i class="fa fa-usd"></i>&nbsp;'+arr.coupon[i].max_discount_usd;
        else out+='error';

        out+='</td>';

        out+='<td>Max use : ';
        if(arr.coupon[i].max_use=="0")
          out+='INF';
        else out+=arr.coupon[i].max_use;

        if(arr.coupon[i].max_use_global=="0")
          out+=',INF';
        else out+=','+arr.coupon[i].max_use_global;

        if(arr.coupon[i].first_purchase_only=="1") out+='<br>First Purchase : YES</td>';
        else out+='<br>First Purchase : NO</td>';

        out+='<td><div class="row">';
        if(arr.coupon[i].status=="1"){
          //coupon is in active mode. press this to deactivate
          out+='<a class="btn btn-danger" onclick="toggleCouponStatus('+arr.coupon[i].id+')" data-toggle="tooltip" title="click for deactivate"><i class="fa fa-times"></i></a>';
        }else{
          //coupon is in inactive mode. press this to activate
          out+='<a class="btn btn-success" onclick="toggleCouponStatus('+arr.coupon[i].id+')" data-toggle="tooltip" title="click for activate"><i class="fa fa-check"></i></a>';
        }
        out+='&nbsp;<a href="coupon_edit.php?id='+arr.coupon[i].id+'" class="btn btn-warning" data-toggle="tooltip" title="Edit Coupon"><i class="fa fa-pencil"></i></a>';
        out+='</div></td>';

        out+='</tr>';
      }
      out+="</tbody></table>";//</div></div>";
    }else{
      //no coupon return
      out+='<h4 class="text-center text-danger">No data return</h4>';
    }
  }
  else{
    out='<h3 class="text-center text-danger">'+arr.remark+'</h3>';
  }
      
  document.getElementById("content").innerHTML=out;
  
}

pagination(1,5,1);
  

$("body").on("click",".page",function()
{
  // alert("click");
  // $("li").removeClass("active");
  var start=1;
  var page=$(this).attr("page");
  if(page>2)
    start=page-2;

  pagination(start,start+4,page);
  search_coupon();
});

$("body").ready(function(){
     search_coupon();
  });

function toggleCouponStatus(id){
  swal({
    title: "Are you sure ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "green",
    confirmButtonText: "Yes",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(){
    $.ajax({
            type: 'POST',
            url: '../adminapi/coupon/coupon_change_status.php',
            data: {
                  id:id
                },
            success: function(data) {
              console.log(data);
              toast("Changes made successfully");
              location.reload();
            }
        });
  });
}

</script>
