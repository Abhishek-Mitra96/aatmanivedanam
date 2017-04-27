<?php 

require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');
?>

 </section>
 <style type="text/css">

  #upd_btn{
    
    display: inline-block;
    
  }
  #upload8{
    
    display: inline-block;
    
  }
  
</style>
  <div class="content-wrapper">
      
   <section class="content-header">
              
       <h1> Tour Page

       <a href="select_category.php" class="btn btn-info pull-right" role="button">Add Tour</a>
    
    </section>
      
     

    <section class="content">

        <div class="box box-primary" id="box-widget">
            
            <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_tour" name="search_keyword" class="form-control input-sm" placeholder="Search" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-primary search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                  </div>
                  <div class="divide10"></div>
                  <h4>Filter by Tour Status</h4>
                  <div class="divide10"></div>
                  <input class="tourFilter" type="radio" name="filter" value="-2" checked="checked"> &nbsp;All Tours &nbsp; &nbsp;
                  <input class="tourFilter" type="radio" name="filter" value="1"> &nbsp;Active Tours &nbsp; &nbsp;
                  <input class="tourFilter" type="radio" name="filter" value="0"> &nbsp;Inactive Tours &nbsp; &nbsp;
               
            </div><!-- /.box-header -->
            
                  <div class="divide10"></div>
            
            <div class="box-body table-responsive no-padding">
               
            <div id="content">
                  </div>             
                
                  
            </div>
            <div class="box-footer">
            </div>
          </div>

    </section>
  </div>

  
  
  
  <?php require_once ('theme/footer.php');

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
        search_tour();
    });
    
    $('#search_tour').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
          pagination(1,5,1);
            search_tour();
        }
         // ****************e.which==27 for ESC key working ****************************
        else if(e.which==27)
        {
            $('#search_tour').val("");
            pagination(1,5,1);
            search_tour();
        }
        
    });
    
});

$("body").on("change",".tourFilter",function(){
  search_tour();
})


function search_tour(){
    var searchkey = $('#search_tour').val();
       var status=$('input:radio[name=filter]:checked').val();
       var page=$(".active1").attr("page");
       
        $.ajax({
            type: 'POST',
            url: '../commonapi/tour/list.php',
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
 
 
  



    function print_data(fetchdata){
       // console.log(fetchdata);
    var arr=JSON.parse(fetchdata);
    
    if(arr.status=="success")
    {

    var x;
    var out='<div class="box box-primary"><div class="box-body table-responsive no-padding">';
   
    out+='<div id="content"></div>';
    out+='<table class=\'table table-hover\'><tbody>';
    out+='<tr>';
    //out+='<th>admin</th>';
    out+='<th>Category</th>';
    out+='<th>Vendor</th>';
    out+='<th>Tour Image </th>';
    out+='<th>Tour Name</th>';
   // out+='<th> description</th>';&
   // out+='<th>colors </th>';
    // out+='<th>COD</th>';
    // out+='<th>Net Price</th>';
    // out+='<th>Standard Packing</th>';
    out+='<th>Visibility</th>';
    out+='<th>Action</th>';
    out+='</tr>';
    
    
    for(x=0;x<arr.tours.length;x++)
    {
        
       /*****************************************pagination total_row(valu) start**************************************/
           var total_row = arr.tours[x].val ;
        /*****************************************pagination total_row(valu) end**************************************/
            
    out+="<tr>";  
  
    out+="<td style='margin-left:10px'><a href='tour_details.php?id="+arr.tours[x].tour_id+"'>"+arr.tours[x].category_name+"</a></td>";
    out+="<td style='margin-left:10px'>"+arr.tours[x].vendor_name+"</td>";
    if(arr.tours[x].img_set1!="")
      out+="<td><img class='lazy' data-original="+arr.tours[x].img1+" height='50px' width='80px'></td>";
    else
      out+="<td></td>";
    out+="<td>"+arr.tours[x].tour_name+"</td>";
    // out+="<td>"+arr.tours[x].cod_availability+"</td>";
    // out+="<td>"+arr.tours[x].net_amount+"</td>";
    // out+="<td>"+arr.tours[x].standard_packing+"</td>";
    
    
    if(arr.tours[x].visibility=="1"){
            out += "<td class='success-p1'>Active</td>";
            out+="<td><button class='btn btn-danger toggleTourStatus' tid='"+arr.tours[x].tour_id+"'>";
            out+="<i class=\"fa fa-times\" aria-hidden=\"true\"></i> Deactivate</button>"; 
        }
        else{
            out += "<td class='danger-p1'>Inactive</td>";
            out+="<td><button class='btn btn-info toggleTourStatus' tid='"+arr.tours[x].tour_id+"'>";
            out+="<i class=\"fa fa-check\" aria-hidden=\"true\"></i> &nbsp;&nbsp;&nbsp;&nbsp;Activate </button>"; 
     }
    out+="&nbsp&nbsp<a href='tour_edit.php?id="+arr.tours[x].tour_id+"'class='btn btn-success' data-toggle='tooltip' title='Edit Tour'><i class='fa fa-pencil-square-o'></i> Edit</a>";
    out+=" <button class='btn btn-danger deleteTour' tid="+arr.tours[x].tour_id+" data-toggle='tooltip' title='Delete Tour' data-confirm='#''><i class='fa fa-trash'></i> </button>";
    out+="</td>";
    
    out+="</tr>";
    
    }
   out+="</tbody></table></div>";
  }
  else{
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
    search_tour();
  })

$("body").ready(function(){
     search_tour();
  })


    
</script>
 
 
 
 
 <!-- 
 <script>
    $("#box-widget").activateBox();
</script> -->

<?php

// echo $_GET["save"];
if(isset($_GET["save"]))
  {
    if($_GET["save"]=="success")
    {
      echo '<script>toast("Changes made successfully");</script>';
    }
    else
    {
      echo '<script>toast("Something went wrong");</script>';
    }
  }
?>
