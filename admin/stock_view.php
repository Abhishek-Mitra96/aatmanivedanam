<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>

<?php
$data=json_decode(stockList());
?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Stock 
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box --> 
      <div class="box box-primary">
          
          
           <div class="box-header">

                  <!-- <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_order" name="search_keyword" class="form-control input-sm" placeholder="Search" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                  </div> -->
                  <div class="divide10"></div>
            </div><!-- /.box-header -->
          
          
            <div class="box-body table-responsive no-padding">
               
            <div id="content">
                  </div>             
                  <div id="content">
                  <? 
                  if($data->status=="success")
                  {
                  	$output='<table class="table table-responsive table-striped">
                  			<tr>
                  				<th>Product Name</th>
                  				<th>Size</th>
                  				<th>Color</th>
                  				<th>Stock</th>
                  			</tr>';
                  	for($i=0;$i<sizeof($data->stock);$i++)
                  	{
                  		$output.='<tr>
                  					<td>'.$data->stock[$i]->product_name.'</td>
                  					<td>'.$data->stock[$i]->size.'</td>
                  					<td>'.$data->stock[$i]->color.'</td>
                  					<td>'.$data->stock[$i]->stock.'</td>
                  				</tr>';
                  	}
                  	$output.='</table>';
                  echo $output;

                  }
                  ?>
                  </div>
                  
            </div>
            <div class="box-footer">
            </div>
          </div>
 
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

   require_once ('theme/footer.php');
   require_once 'user_details_modal.php';
   require_once 'consignment_details_modal.php';
   ?>
  <!-- <script>
      
$(document).ready(function() {
    $('.search_key').click(function() {
        search_order();
    });
    
    $('#search_order').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
            search_order();
        }
         // ****************e.which==27 for ESC key working *****************************
        else if(e.which==27)
        {
            $('#search_order').val("");
            search_order();
        }
        
    });
    
});
   
function search_order(){
    var searchkey = $('#search_order').val();
       var status=$('input:radio[name=filter]:checked').val();
       var page=$(".active1").attr("page");

       // alert(status);
        $.ajax({
            type: 'POST',
            url: '../adminapi/order_management/list.php',
            data: {
                search:searchkey,
                status:status,
                page: page
                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
             print_data(fetchdata);
             
             
            }
        });
}               


  function print_data(fetchdata)
    {
    var arr=JSON.parse(fetchdata,true);
    var x;
      if(arr.status=="success")
      {
          var out='<div class="box box-primary">';
              out+='<div class="box-body table-responsive no-padding">';
              out+='<div id="content"></div>';
              out+='<table class="table table-hover"><tbody>';
              out+=' <tr>';
              // out+='<th>Sl.No</th>';
              out+='<th>Order No.</th>';
              out+='<th>Customer Name </th>';
              // out+='<th>Company </th>';
              out+='<th>Order Date </th>';
              out+='<th>Amount </th>';
              // out+='<th>Delivered Date</th>';
              out+='<th>Order Status</th>';
              out+='<th>Payment Method</th>';
              out+='<th>Payment Status</th>';
              out+='<th>Action</th> ';
              out+='</tr>';
        
      for(x=0;x<arr.orders.length;x++)
      {
          out+="<tr>";
          // out+="<td>"+(x+1)+"</td>";
         
             out+="<td><a href='../invoice/invoice.php?id="+arr.orders[x].orderNo+"' target='_blank'>Order# "+arr.orders[x].orderNo+"</a></td>";
      
          out+="<td class='viewCustomer' id='"+arr.orders[x].user_id+"'>"+arr.orders[x].name+"</td>";
          // out+="<td class='viewCustomer' id='"+arr.orders[x].user_id+"'>"+arr.orders[x].companyname+"</td>";
          out+="<td>"+arr.orders[x].order_date+"</td>";
          out+="<td>"+arr.orders[x].amount+"</td>";
          // out+="<td>"+arr.orders[x].delivered_date+"</td>";
          
          out+="<td>"+arr.orders[x].order_status+"</td>";
          out+="<td>"+arr.orders[x].payment_method+"</td>";
          out+="<td>"+arr.orders[x].payment_status+"</td>";
          out+="<td>";


  //change order status "cancel to Process"
               if(arr.orders[x].order_status == "New Order"){
                  out+="<button class='processOrder btn btn-info' id='"+arr.orders[x].orderNo+"'> Process Order</button>";
                   }
  //change order status "cancel to Process"

  //change order status "Process to Dispatch"
               else if(arr.orders[x].order_status == "Processed"){
                  out+="<button class='dispatchOrder btn btn-primary' id='"+arr.orders[x].orderNo+"'> Dispatch Order</button>";
                   }
  //change order status "Process to Dispatch"




  //change order status "Dispatch to Delivered"
               else if(arr.orders[x].order_status == "Dispatched"){
                  out+="<button class='deliverOrder btn btn-success' id='"+arr.orders[x].orderNo+"'> Set as Delivered</button>";
                   }
  //change order status "Dispatch to Delivered"


               if(arr.orders[x].order_status != "Cancelled" && arr.orders[x].order_status != "Delivered"){
                  out+=" <button class='cancelOrder btn btn-danger' id='"+arr.orders[x].orderNo+"'> Cancel Order</button>";
                   }

              if(arr.orders[x].order_status != "Cancelled" && arr.orders[x].payment_method=="Cash" && arr.orders[x].payment_status=="Unpaid")
                  out+=" <button class='cashReceived btn btn-success' orderNo='"+arr.orders[x].orderNo+"' data-toggle='tooltip' title='Cash Received'><i class='fa fa-money' aria-hidden='true'></i> Cash</button>";

          
          out+="</td>";
          out+="</tr>";
           }
          out+="</tbody></table></div>";
     document.getElementById("content").innerHTML=out;
     
      }
      else
      {
        document.getElementById("content").innerHTML=arr.remark;
      }
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
    search_order();
  })

$("body").ready(function(){
  search_order(); 
  })

   </script> -->