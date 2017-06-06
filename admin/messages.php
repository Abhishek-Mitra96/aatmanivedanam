<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 <style>
   .button
   {
    color: red;
   }
 </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>   Messages   </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">
          
            <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_message" name="search_keyword" class="form-control input-sm" placeholder="Search" value="" autofocus="">
                      </div>

                      <div class="col-xs-12 col-sm-2">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>

                      </div>
                      <div class="com-sm-2">
                        <!-- <button class="allMessagesRead btn btn-success"><i class="fa fa-check"></i> Mark all as read</button> -->
                        <br>
                                              <h4 style="margin-left: 1.5%; margin-top: 2.8%;">Filter by Messages Status</h4>
                  <div class="divide10"></div>
                  <input class="brandFilter" name="filter" value="3" checked="checked" type="radio" style="margin-bottom: 1.5%; margin-left: 1.5%;"> &nbsp;All Messages &nbsp; &nbsp;
                  <input class="brandFilter" name="filter" value="1" type="radio"> &nbsp;Active Messages &nbsp; &nbsp;
                  <input class="brandFilter" name="filter" value="0" type="radio"> &nbsp;Inactive Messages &nbsp; &nbsp;

                        
                      </div>
                  </div>
               
            </div><!-- /.box-header -->
          

            <div class="box-body table-responsive no-padding">
               
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

  
  
  
 <?php

   require_once ('theme/footer.php');
   require_once 'user_details_modal.php';
   ?>

  <script>
      
    $(document).ready(function() {
    $('.search_key').click(function() {
        search_message();
    });
    
    $('#search_message').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
            search_message();
        }
         // ****************e.which==27 for ESC key working *****************************
        else if(e.which==27)
        {
            $('#search_message').val("");
            search_message();
        }
        
    });
    
});

$("body").on("change",".brandFilter",function(){
  
  search_message();
  
});


      
function search_message(){
    var searchkey = $('#search_message').val();
       var page=$(".active1").attr("page");
         var status=$('input:radio[name=filter]:checked').val();

       // alert(page);
        $.ajax({
            type: 'POST',
            url: '../adminapi/message/message_view.php',
            data: {
                search:searchkey,
                viewall:1,
        status:status,
                // limit:1,
                page:page
                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
             print_data(fetchdata);
             
            }
        });
}      
      
      

    
    function print_data(fetchdata)
    {
    
    // console.log(fetchdata);
   // fetchdata = JSON.stringify(fetchdata);
    var array = JSON.parse(fetchdata);
    // alert(array.status);
    // alert(array.messages.length);
    if(array.status=="success")
    {
      var x;
       var out="<div class=\"box box-primary\"><div class=\"box-body table-responsive no-padding\">";
            out+="<div id=\"content\"></div>";
            out+="<table class=\'table table-hover\'><tbody>";
            out+="<tr>";

            out+="<th>Date</th>";
            out+="<th>Message</th>";
            out+="<th>Name</th>";
            out+="<th>Status</th>";
            out+="<th>Action</th>";
            out+="</tr>";
    
            for(x=0;x<array.messages.length;x++){

            /*****************************************pagination total_row(valu) start**************************************/
            var total_row = array.messages[x].val ;
           /*****************************************pagination total_row(valu) end**************************************/
           
            out+="<tr>";
            out+="<td>"+array.messages[x].date+"</td>";
            out+="<td style='width:40%'>"+array.messages[x].message+"</td>";
            out+="<td class='viewCustomer' id='"+array.messages[x].user_id+"'>"+(array.messages[x].fname+' '+array.messages[x].lname)+"</td>";
            // out+="<td></td>";

            if(array.messages[x].status==0){
            out += "<td class='success-p1'>New</td>";
            out+="<td><div class='button' id='button"+array.messages[x].message_id+"'><button class='btn btn-success changeMessageStatus' ";
            out+="id='"+array.messages[x].message_id+"'> <i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp Mark Read</button>"; 
        }
        else{
            out += "<td class='danger-p1'>Read</td>";
            out+="<td><div class='button' id='button"+array.messages[x].message_id+"'><button class='btn btn-primary changeMessageStatus' ";
            out+="id='"+array.messages[x].message_id+"'><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i>&nbsp Mark Unread </button>"; 
     }
            
            out+="&nbsp;&nbsp;&nbsp;<button class='btn btn-danger deleteMessage' mid='"+array.messages[x].message_id+"' title='Delete Message'><i class='fa fa-trash'></i></button></div></td>";
            out+="</tr>";
          
            }
    
        out+="</tbody></table></div>";
        
        /*****************************************pagination tab for forntend start**************************************/
            var result_per_page = 5;
            var y= total_row/result_per_page;
            var pageno = Math.ceil(y);
            out+='<ul class="pagination">'; 
        for (i=1;i<=pageno;i++)
            {
            out+="<li id=\"item_"+i+"\" onclick="+"pagination("+i+");> <span class=\"page_name\"> "+i+"</span></li>";
            }
            out+='</ul>'; 
         /*****************************************pagination tab for forntend end**************************************/       
        
        
        document.getElementById("content").innerHTML=out;
    }

    else
    {
        document.getElementById("content").innerHTML=array.remark;
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
    search_message();
  })

$("body").ready(function(){
  search_message();

})


  </script>
    
   



