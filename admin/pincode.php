<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Manage Pincode
             
              <a href="pincode_insert.php" class="btn btn-info pull-right" role="button">Add Pin Code</a>
             </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      
      
      
      
       <div class="box box-primary">
          
                <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_product" name="search_keyword" class="form-control input-sm" placeholder="Search" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                  </div>
               
            </div><!-- /.box-header -->
          
           <div class="box-body table-responsive no-padding">
               
                        
				
              <div id="content">
                  </div>       
            </div><!-- /.box-body -->
        </div><!-- /.box -->
                 <!-- /.box -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  
  
  
  <?php require_once ('theme/footer.php');?>
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
       
        $.ajax({
            type: 'POST',
            url: '../adminapi/pincode/pincode_serch_by_data.php',
            data: {
                key:searchkey
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
    var out="<div class=\"box-body table-responsive no-padding\">";
        out+="<table class='table table-hover'>";
        out+="<tbody>";
            out+="<tr>";
            out+="<th>Sl.No </th>";
            out+="<th>Pin Code Start</th>";
            out+="<th>Pin Code End</th>";
            out+="<th>Description</th>";
            out+="<th>Status</th>";
            out+="<th>Action</th>";
            out+="</tr>";
   
            for(x=0;x<arr.length;x++)
            {
                
            /************pagination total_row(valu) start********************/
            var total_row = arr[x].val;
           /***************pagination total_row(valu) end********************/
           
            out+="<tr>";
            out+="<td>"+(x+1)+"</td>";
            out+="<td style='margin-left:10px'>"+arr[x].pin_code_start+"</td>";
            out+="<td>"+arr[x].pin_code_end+"</td>";
            out+="<td>"+arr[x].description+"</td>";
            // out+="<td>"+arr[x].visibility+"</td>";
           
    
      if(arr[x].visibility=="Active"){
            out += "<td class='success-p1'>" + arr[x].visibility + "</td>";
            out+="<td><a class='btn btn-danger' ";
            out+="href='../adminapi/pincode/change_pincode_status.php?id="+arr[x].id+"'  onclick=\"return confirm('Are you sure you want to change status "+arr[x].visibility+"?');\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deactivate</a> &nbsp;"; 
        }
        else{
            out += "<td class='danger-p1'>" + arr[x].visibility + "</td>";
            out+="<td><a class='btn btn-info' ";
            out+="href='../adminapi/pincode/change_pincode_status.php?id="+arr[x].id+"'  onclick=\"return confirm('Are you sure you want to change status "+arr[x].visibility+"?');\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i> Activate </a> &nbsp;"; 
     }
    
    
           // out+="<td>";
            out+=" &nbsp;<a href='pincode_edit.php?id="+arr[x].id+"'class='btn btn-success' data-toggle='tooltip' title='Edit Site User'><i class='fa fa-pencil-square-o'></i> Edit</a>&nbsp;";
            out+=" &nbsp;<a href='../adminapi/pincode/pincode_delete.php?id="+arr[x].id+"' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\" data-toggle='tooltip' title='Delete Site User' data-confirm='#''><i class='fa fa-trash'></i> Delete</a>";
            out+="</td>";
            out+="</tr>";
            }
   out+="</tbody></table></div>";
   
   /*****************************************pagination tab for forntend start**************************************/
            var result_per_page = 5;
            var x= total_row/result_per_page;
            var pageno = Math.ceil(x);
//            alert(total_row);
//            alert(pageno);
        out+='<ul class="pagination">'; 
           
        for (i=1;i<=pageno;i++)
            {
            out+="<li id=\"item_"+i+"\" onclick="+"pagination("+i+");> <span class=\"page_name\"> "+i+"</span></li>";
            }
            out+='</ul>'; 
 /*****************************************pagination tab for forntend end**************************************/       
        
   
   
   document.getElementById("content").innerHTML=out;
    }
        
   
   
    /***************************pagination function for forntend end************************/
     function pagination(var1){
         
         var result_per_page = 5;
        $.post( "../adminapi/pincode/pincode_serch_by_data.php", { pageno: var1, paginationCount: result_per_page})
      .done(function( fetchdata ) {
                 
      //  alert( "Data Loaded: " + fetchdata );
        print_data(fetchdata);
      });
    }  
  /*****************pagination function for forntend end****************************/
 
  search_product();      
 
  </script>
  
 