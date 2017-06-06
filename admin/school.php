<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  School Page
             
          <a href="school_insert.php" class="btn btn-info pull-right" role="button">Add School</a>
             </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">
          
            <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_school" name="search_keyword" class="form-control input-sm" placeholder="Search" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                  </div>
                  <div class="divide10"></div>

                  <h4>Filter by School Status</h4>
                  <div class="divide10"></div>
                  <input class="schoolFilter" type="radio" name="filter" value="-2" checked="checked"> &nbsp;All Schools &nbsp; &nbsp;
                  <input class="schoolFilter" type="radio" name="filter" value="1"> &nbsp;Active Schools &nbsp; &nbsp;
                  <input class="schoolFilter" type="radio" name="filter" value="0"> &nbsp;Inactive Schools &nbsp; &nbsp;
               
            </div><!-- /.box-header -->
          
                  <div class="divide10"></div>
          
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

  if(isset($_GET["success"]) && $_GET["success"]=="true")
  {
    echo '<script>swal("Done","Data updated successfully","success");</script>';
    // echo '<script>alert("Data updated successfully");</script>';
    unset($_GET["success"]);
  }
  ?>

  <script>
      
    $(document).ready(function() {
    $('.search_key').click(function() {
        search_school();
    });
    
    $('#search_school').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
            search_school();
        }
         // ****************e.which==27 for ESC key working *****************************
        else if(e.which==27)
        {
            $('#search_school').val("");
            search_school();
        }
        
    });
    
});

      
function search_school(){
    var searchkey = $('#search_school').val();
       var status=$('input:radio[name=filter]:checked').val();
       var page=$(".active1").attr("page");
       
        $.ajax({
            type: 'POST',
            url: '../commonapi/school/school_view.php',
            data: {
                search:searchkey,
                status:status,
                page:page,
                viewall:1
                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
             print_data(fetchdata);
             
             
            }
        });
}      
      
      
$("body").on("change",".schoolFilter",function(){
  search_school();
})
    
    function print_data(fetchdata)
    {
    
    // console.log(fetchdata);
   // fetchdata = JSON.stringify(fetchdata);
    var array = JSON.parse(fetchdata);
    // alert(array.status);
    // alert(array.schools.length);
    if(array.status=="success")
    {
      var x;
       var out="<div class=\"box box-primary\"><div class=\"box-body table-responsive no-padding\">";
            out+="<div id=\"content\"></div>";
            out+="<table class=\'table table-hover\'><tbody>";
            out+="<tr>";

            out+="<th>Sl No.</th>";
            out+="<th>School</th>";
            out+="<th>Logo</th>";
            out+="<th>Status</th>";
            out+="<th>Action</th>";
            out+="</tr>";
    
            for(x=0;x<array.schools.length;x++){

            
            var total_row = array.schools[x].val ;

           
            out+="<tr>";
            out+="<td>"+(x+1)+"</td>";
            // out+="<td>"+array.schools[x].school_id+"</td>";
            out+="<td>"+array.schools[x].name+"</td>";
            out+="<td><img class='lazy' data-original='"+array.schools[x].logo+"' height='50px' width='80px' alt='"+array.schools[x].school_name+"'></td>"; 
            if(array.schools[x].status==1){
            out += "<td class='success-p1'>Active</td>";
            out+="<td><a class='btn btn-danger' ";
            out+="href='../adminapi/school/change_school_status.php?id="+array.schools[x].school_id+"'  onclick=\"return confirm('Are you sure you want Deactivate this school?');\"> <i class=\"fa fa-times\" aria-hidden=\"true\"></i>&nbsp Deactivate</a>"; 
        }
        else{
            out += "<td class='danger-p1'>Deactivated</td>";
            out+="<td><a class='btn btn-info' ";
            out+="href='../adminapi/school/change_school_status.php?id="+array.schools[x].school_id+"'  onclick=\"return confirm('Are you sure you want to Activate this school?');\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp Activate </a>"; 
     }
    
            out+="&nbsp<a href='school_edit.php?id="+array.schools[x].school_id+"'class='btn btn-success' data-toggle='tooltip' title='Edit School'><i class='fa fa-pencil-square-o'></i> Edit</a>";
            //out+="&nbsp<a href='../adminapi/school/school_delete.php?id="+array.schools[x].school_id+"' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\" data-toggle='tooltip' '><i class='fa fa-trash'></i> Delete</a>";  //for deleting a school
            
            
            out+="</td>";
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
    $("img.lazy").lazyload();
        
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
    search_school();
  })

$("body").ready(function(){
    search_school();
  })
  

 
  </script>
    
   



