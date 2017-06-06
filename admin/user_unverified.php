<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Unverified Users  
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        
        <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_product" name="search_keyword" class="form-control input-sm" placeholder="Search" autofocus="" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                  </div>
               
            </div><!-- /.box-header -->
        
        
        
      <!-- Default box --> 
      <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
               
              <div id="content"><h3 style="text-align:center"><b>Loading Data</b></h3></div>             
                  
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
   ?>
  <script>
      
     $(document).ready(function() {
    $('.search_key').click(function() {
        search_product();
    });
    
    $('#search_product').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
            search_product();
        }
         // ****************e.which==27 for ESC key working *****************************
        else if(e.which==27)
        {
            $('#search_product').val("");
            search_product();
        }
        
    });
    
});

      
function search_product(){
    var searchkey = $('#search_product').val();
       var page=$(".active1").attr("page");

       
        $.ajax({
            type: 'POST',
            url: '../adminapi/user/verify_user_search.php',
            data: {
                key:searchkey,
                page:page,
                status:"unverified"
                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
             print_data(fetchdata);
             
             
            }
        });
}       
      
       
   
//  $.getJSON("../adminapi/verify_user/display_verified.php",
//    function(data)
//    {
//    data=JSON.stringify(data);
//    var arr=JSON.parse(data);
//    var x;
function print_data(fetchdata)
    {
    var arr = JSON.parse(fetchdata);
    if(arr.status=="success")
    {
        var x;
        var out='<div class="box box-primary"><div class="box-body table-responsive no-padding">';
            out+='<div id="content"><div>';
            out+='<table class=\'table table-hover\'><tbody>';
            out+='<tr>';
            out+='<th>SL.No</th>';
            out+='<th>Name </th>';
            out+='<th>Company Name </th>';
            out+='<th>Email </th>';
            out+='<th>Mobile</th>';
            out+='<th>Status</th>';
            out+='<th >Action</th>';
            out+='</tr>';
        
        for(x=0;x<arr.users.length;x++)
        {
            out+="<tr>";
            out+="<td>"+(x+1)+"</td>";
            
        out+="<td class='viewCustomer' id='"+arr.users[x].id+"'>"+arr.users[x].name+"</td>";
            
            out+="<td class='viewCustomer' id='"+arr.users[x].id+"'>"+arr.users[x].companyname+"</td>";
            out+="<td>"+arr.users[x].email+"</td>";
            out+="<td>"+arr.users[x].mobile+"</td>";
//        out+="<td>"+arr.users[x].otp+"</td>";
       
          
                  out += "<td class='danger-p1'>Unverified</td>";
                  out+="<td><a class='btn btn-success' ";
                  out+="href='../adminapi/user/change_status.php?id="+arr.users[x].id+"'  onclick=\"return confirm('Are you sure you want to Verify?');\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i> Verify </a>"; 
          //out+="<td>"+arr.users[x].status+"</td>";
        
    
    
    
    
    
         //out+="<td>";

         //Removed the Delete user feature
             // out+="&nbsp&nbsp<a href='../adminapi/verify_user/delete-user.php?id="+arr.users[x].id+"'class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this user?');\"data-toggle='tooltip' title='Delete User' data-confirm='#'><i class='fa fa-trash'></i>&nbspDelete</a>";
             out+="</td>";
       }
             out+="</tbody></table>";
             out+="</div>";
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
    search_product();
  })

$("body").ready(function(){
    search_product();
  })

  </script> 