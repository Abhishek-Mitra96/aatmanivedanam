<?php 

require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');

?>
 

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      

      <h1>  Manage Category
             
              <a href="category_insert.php" class="btn btn-info pull-right" role="button">Add Category</a>
             </h1>
    </section>

    <!-- Main content -->
 <section class="content">

       <div class="box box-primary">
           
            <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_category" name="search_keyword" class="form-control input-sm" placeholder="Search" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                      <h4 style="margin-left: 1.5%; margin-top: 4.8%;">Filter by Category Status</h4>
                  <div class="divide10"></div>
                  <input class="brandFilter" name="filter" value="3" checked="checked" type="radio" style="margin-bottom: 1.5%; margin-left: 1.5%;"> &nbsp;All Category &nbsp; &nbsp;
                  <input class="brandFilter" name="filter" value="1" type="radio"> &nbsp;Active Category &nbsp; &nbsp;
                  <input class="brandFilter" name="filter" value="0" type="radio"> &nbsp;Inactive Category &nbsp; &nbsp;
                  </div>
               
            </div><!-- /.box-header -->
           
           
            <div class="box-body table-responsive no-padding">
               
            <div id="content"></div>
                  
            </div>
            <div class="box-footer">
            </div>
          </div>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  
  

  <?php
  require_once ('theme/footer.php');

 if(isset($_GET["success"]))
  {
      if($_GET["success"]=="true")
      {
        echo '<script>swal("Done","Data updated successfully","success");</script>';
        unset($_GET["success"]);
      }
      else
      {
       echo '<script>swal("Error","Something went wrong","error");</script>';
        unset($_GET["success"]); 
      }
  }

  ?>

  <script>
    
    $(document).ready(function() {
    $('.search_key').click(function() {
        search_category();
    });
    
    $('#search_category').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
            search_category();
        }
         // ****************e.which==27 for ESC key working *****************************
        else if(e.which==27)
        {
            $('#search_category').val("");
            search_category();
        }
        
    });
    
});

      
function search_category(){
    var searchkey = $('#search_category').val();
    var page=$(".active1").attr("page");
    var status=$('input:radio[name=filter]:checked').val();

       
        $.ajax({
            type: 'POST',
            url: '../adminapi/category/category_list.php',
            data: {
                search:searchkey,
                page:page,
                <?php
                    if(isset($_GET["parent"]))
                      echo "parent_id:".$_GET["parent"].","; 
                ?>
                viewall:1,
        status:status

                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
                // console.log(fetchdata);
             print_data(fetchdata);
             
             
            }
        });
}

$("body").on("change",".brandFilter",function(){
  
  search_category();
/*    var status=$('input:radio[name=filter]:checked').val();
  $.ajax({
  type: 'POST',
  url: '../admin/ajax/ajax_list.php',
  data: {
      status : status,
      tag    : 'category' 
      },
  success: function(fetchdata) {
    
    //alert(fetchdata);
    // console.log(fetchdata);
   print_data(fetchdata);
   
   
  }
});
*/

});

  
function print_data(fetchdata)
    {
       // console.log(fetchdata);
    var arr = JSON.parse(fetchdata,true);
  // console.log(arr);
    var x;
    
    if(arr.status=="success")
{       
    var out="<div class=\"box box-primary\"><div class=\"box-body table-responsive no-padding\">";
        out+="<div id=\"content\"></div>";
        out+="<table class=\'table table-hover\'><tbody>";
        out+="<tr>";
        
        out+="<th>Sl. No.</th>";
        out+="<th>Category</th>";
        out+="<th>Position</th>";

        
        out+="<th>Category Image</th>";
        
//        out+="<th>category_icon</th>";
//        out+="<th>category_priority</th>";
        out+="<th>status</th>";
        
        out+="<th>Action</th>";
        out+="</tr>";
    
    
    
    for(x=0;x<arr.categories.length;x++)
        {
            /*****************************************pagination total_row(valu) start**************************************/
            var total_row = arr.categories[x].val ;
            /*****************************************pagination total_row(valu) end**************************************/

            out+="<tr>";
            out+="<td>"+(x+1)+"</td>";
            out+="<td><a href='category.php?parent="+arr.categories[x].id+"'>"+arr.categories[x].category_name+"</td>";
            out+="<td>"+arr.categories[x].position+"</td>";
            // out+="<td>"+arr.categories[x].+"</td>";

            out+="<td><img class='lazy' data-original='"+arr.categories[x].category_image+"' width='100px'></td>";
            var status=(arr.categories[x].status==1)?"Active":"Inactive";
            
            
            //out+="<td>"+arr.categories[x].status+"</td>";
            //out+="<td><a href='../adminapi/category/category_Deleted_Active.php?id="+arr.categories[x].id+"'   class='btn btn-info'    onclick=\"return confirm('Are you sure you want to change status "+arr.categories[x].status+"?');\"> "+arr.categories[x].status+"</a>";
            if(status=="Active"){
            out += "<td class='success-p1'>" + status + "</td>";
            out+="<td><button class='btn btn-danger toggleCategoryStatus' cid='"+arr.categories[x].id+"'>";
            out+="<i class=\"fa fa-times\" aria-hidden=\"true\"></i>&nbsp Deactivate</button>"; 
        }
        else{
            out += "<td class='danger-p1'>" + status + "</td>";
            out+="<td><button class='btn btn-info toggleCategoryStatus' cid='"+arr.categories[x].id+"'>";
            out+="<i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp Activate </button>"; 
     }

            out+="&nbsp;&nbsp;<a href='category_edit.php?id="+arr.categories[x].id+"'class='btn btn-success' data-toggle='tooltip' title='Edit Category'><i class='fa fa-pencil-square-o'></i> Edit</a>";
            //out+="<a href='../adminapi/_Category/category_delete.php?id="+arr.categories[x].id+"' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\" data-toggle='tooltip' title='Delete Site User' data-confirm='#''><i class='fa fa-trash'></i> Delete</a></td>"; //for deleting
            out+="</tr>";
        }
   out+="</tbody></table></div>";

 }
 else
 {
  out=arr.remark;
 }      
        
   
   
   document.getElementById("content").innerHTML=out;
    $("img.lazy").lazyload();

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
    search_category();
  })

$("body").ready(function(){
search_category();
  })
    
  
  


 </script>