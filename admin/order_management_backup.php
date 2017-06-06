<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Orders 
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box --> 
      <div class="box box-primary">
          
          
           <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_order" name="search_keyword" class="form-control input-sm" placeholder="Search" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                  </div>
               
            </div><!-- /.box-header -->
          
          
            <div class="box-body table-responsive no-padding">
               
            <div id="content">
                  </div>             
                  <div id="content">
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
  <?php require_once ('theme/footer.php');?>
  <script>
      
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
       
        $.ajax({
            type: 'POST',
            url: '../adminapi/order_management/list.php',
            data: {
                search:searchkey
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
              out+='<th>Company </th>';
              out+='<th>Order Date </th>';
              out+='<th>Amount </th>';
              // out+='<th>Delivered Date</th>';
              out+='<th>Status</th>';
              out+='<th>Action</th> ';
              out+='</tr>';
        
      for(x=0;x<arr.orders.length;x++)
      {
          out+="<tr>";
          // out+="<td>"+(x+1)+"</td>";
         
          if(arr.orders[x].order_status == "Delivered"){
             out+="<td><a href='../invoice/invoice.php?id="+arr.orders[x].orderNo+"'' target='_blank'>"+arr.orders[x].orderNo+"</a></td>";
             }else{
           out+="<td>"+arr.orders[x].orderNo+"</td>";
             }
      
          out+="<td>"+arr.orders[x].name+"</td>";
          out+="<td>"+arr.orders[x].companyname+"</td>";
          out+="<td>"+arr.orders[x].order_date+"</td>";
          out+="<td>"+arr.orders[x].amount+"</td>";
          // out+="<td>"+arr.orders[x].delivered_date+"</td>";
          
          out+="<td>"+arr.orders[x].order_status+"</td>";
          out+="<td>";


  //change order status "cancel to Process"
               if(arr.orders[x].order_status == "Cancelled"){
                  out+="<a href=";
                     if(arr.orders[x].order_status == "Delivered"){
                          out+="'#'";
                      }
                      else{
                          out+="'../adminapi/order_management/change_order_management_status.php?id="+arr.orders[x].id+"'";
                      }
                  out+="class='btn btn-info' data-toggle='tooltip'>";
                  out+="<i class='fa fa-spinner' aria-hidden='true'></i>Proces</a>";
                   }
  //change order status "cancel to Process"

  //change order status "Process to Dispatch"
               if(arr.orders[x].order_status == "Process"){
                  out+="<a href=";
                     if(arr.orders[x].order_status == "Delivered"){
                          out+="'#'";
                      }
                      else{
                          out+="'../adminapi/order_management/change_order_management_status.php?id="+arr.orders[x].id+"'";
                      }
                  out+="class='btn btn-info' data-toggle='tooltip' title='Set as Dispatched'>";
                  out+="<i class='fa fa-spinner' aria-hidden='true'></i>Dispatch</a>";
                   }
  //change order status "Process to Dispatch"




  //change order status "Dispatch to Delivered"
               if(arr.orders[x].order_status == "Dispatch"){
                  out+="<a href=";
                     if(arr.orders[x].order_status == "Delivered"){
                          out+="'#'";
                      }
                      else{
                          out+="'../adminapi/order_management/change_order_management_status.php?id="+arr.orders[x].id+"'";
                      }
                  out+="class='btn btn-info' data-toggle='tooltip' title='Set as Delivered'>";
                  out+="<i class='fa fa-spinner' aria-hidden='true'></i>Delivered</a>";
                   }
  //change order status "Dispatch to Delivered"








  //change order status "cancel"
              if(arr.orders[x].order_status != "Cancelled" &&  arr.orders[x].order_status != "Delivered"){
                  out+="<a href=";
                     if(arr.orders[x].order_status == "Cancelled"){
                          out+="'#'";
                      }
                      else{
                          out+="'../adminapi/order_management/change_order_management_status_cancel.php?id="+arr.orders[x].id+"'";
                      }
                  out+="class='btn btn-success' data-toggle='tooltip' title='Cancel Order'>";
                  out+="<i class='fa fa-ban' aria-hidden='true'></i> Cancel</a>";
              }
  //change order status "cancel"
      
          // out+="<a href='../adminapi/order_management/order_delete.php?id="+arr.orders[x].id+"' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\" data-toggle='tooltip' title='Delete Order' data-confirm='#''><i class='fa fa-trash'></i> Delete</a>";
          
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
  search_order(); 
  
   </script> 
  
  
  