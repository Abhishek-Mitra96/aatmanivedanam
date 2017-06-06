<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Verified Users  
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        
        <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_user" name="search_keyword" class="form-control input-sm" placeholder="Search" autofocus="" value=""/>
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
  require_once 'single_sms_modal.php';
  require_once 'single_notification_modal.php';

  ?>
  <script>
      
     $(document).ready(function() {
    $('.search_key').click(function() {
        search_user();
    });
    
    $('#search_user').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
            search_user();
        }
         // ****************e.which==27 for ESC key working *****************************
        else if(e.which==27)
        {
            $('#search_user').val("");
            search_user();
        }
        
    });
    
});

      
function search_user(){
    var searchkey = $('#search_user').val();
       var page=$(".active1").attr("page");

       
        $.ajax({
            type: 'POST',
            url: '../adminapi/user/verify_user_search.php',
            data: {
                key:searchkey,
                page:page,
                status:"verified"
                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
             print_data(fetchdata);
             
             
            }
        });
}       
      
       
  
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
            out+='<th>Organization Name</th>';
            out+='<th>Email </th>';
            out+='<th>Mobile</th>';
            out+='<th>Gender</th>';
            out+='<th>Nationality</th>';
            out+='<th>Date of Birth</th>';
            // out+='<th>Status</th>';
            out+='<th >Action</th>';
            out+='</tr>';
        
        for(x=0;x<arr.users.length;x++)
        {
            out+="<tr>";
            out+="<td>"+(x+1)+"</td>";
            
        out+="<td class='viewCustomer' id='"+arr.users[x].id+"'>"+(arr.users[x].fname+' '+arr.users[x].lname)+"</td>";
            
            out+="<td class='viewCustomer' id='"+arr.users[x].id+"'>"+arr.users[x].organization_name+"</td>";
            out+="<td>"+arr.users[x].email+"</td>";
            out+="<td>"+arr.users[x].mobile+"</td>";
            out+="<td>"+arr.users[x].gender+"</td>";
            out+="<td>"+arr.users[x].nationality+"</td>";
            out+="<td>"+arr.users[x].dob+"</td>";
//        out+="<td>"+arr.users[x].otp+"</td>";
       
          // if(arr.users[x].status=="1"){
          //         out += "<td class='success-p1'>Active</td>";
          //         out+="<td><button class='btn btn-danger toggleUserStatus' uid='"+arr.users[x].id+"' data-toggle='tooltip' title='Block User!'><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button>"; 
          //     }
          //     else{
          //         out += "<td class='danger-p1'>Blocked</td>";
          //         out+="<td><button class='btn btn-success toggleUserStatus' uid='"+arr.users[x].id+"' data-toggle='tooltip' title='Allow User'><i class=\"fa fa-check\" aria-hidden=\"true\"></i></button>"; 
          //  }
          // out+='&nbsp;&nbsp;<button class="btn btn-primary smsCustomer" mobile="'+arr.users[x].mobile+'"><i class="fa fa-envelope" aria-hidden="true" data-toggle="tooltip" title="Send Message"></i></button>&nbsp;&nbsp;<button class="btn btn-success notificationCustomer" uid="'+arr.users[x].id+'"><i class="fa fa-bell" aria-hidden="true" data-toggle="tooltip" title="Send App notification!"></i></button>';
          out+="<td> <button class='btn btn-danger deleteUser' uid="+arr.users[x].id+" data-toggle='tooltip' title='Delete User' data-confirm='#''><i class='fa fa-trash'></i> </button>";
    
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
    search_user();
  })

$("body").ready(function(){
    search_user();
  })

  </script> 