<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  Country Page
             
          <a href="country_insert.php" class="btn btn-info pull-right" role="button">Add Country</a>
             </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">
          
            <div class="box-header">

                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                        <input type="text" id="search_country" name="search_keyword" class="form-control input-sm" placeholder="Search" value=""/>
                      </div>

                      <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-default search_key"><i class="fa fa-search"></i> Search</button>
                      </div>
                  </div>
                  <div class="divide10"></div>
               
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
        search_country();
    });
    
    $('#search_country').keyup(function(e) {
       
        
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
            search_country();
        }
         // ****************e.which==27 for ESC key working *****************************
        else if(e.which==27)
        {
            $('#search_country').val("");
            search_country();
        }
        
    });
    
});

      
function search_country(){
    var searchkey = $('#search_country').val();
       var status=$('input:radio[name=filter]:checked').val();
       var page=$(".active1").attr("page");
       
        $.ajax({
            type: 'POST',
            url: '../adminapi/country/country_view.php',
            data: {
                search:searchkey,
                // status:status,
                page:page,
                viewall:1
                },
            success: function(fetchdata) {
                
                //alert(fetchdata);
             print_data(fetchdata);
             
             
            }
        });
}      
      
      
$("body").on("change",".countryFilter",function(){
  search_country();
})
    
    function print_data(fetchdata)
    {
    
    // console.log(fetchdata);
   // fetchdata = JSON.stringify(fetchdata);
    var array = JSON.parse(fetchdata);
    // alert(array.status);
    // alert(array.countries.length);
    if(array.status=="success")
    {
      var x;
       var out="<div class=\"box box-primary\"><div class=\"box-body table-responsive no-padding\">";
            out+="<div id=\"content\"></div>";
            out+="<table class=\'table table-hover\'><tbody>";
            out+="<tr>";

            out+="<th>Sl No.</th>";
            // out+="<th>Country Id</th>";
            out+="<th>Country</th>";
            // out+="<th>Image</th>";
            out+="<th>ISD Code</th>";
            out+="<th>Action</th>";
            out+="</tr>";
    
            for(x=0;x<array.countries.length;x++){

            /*****************************************pagination total_row(valu) start**************************************/
            var total_row = array.countries[x].val ;
           /*****************************************pagination total_row(valu) end**************************************/
           //alert (total_row);
           
            out+="<tr>";
            out+="<td>"+(x+1)+"</td>";
            // out+="<td>"+array.countries[x].country_id+"</td>";
            out+="<td>"+array.countries[x].country+"</td>";
            out+="<td>"+array.countries[x].isd_code+"</td>";
            // out+="<td>"+array.countries[x].mobile+"</td>";
            // out+="<td><img class='lazy' data-original='"+array.countries[x].country_image+"' height='50px' width='80px' alt='"+array.countries[x].country_name+"'></td>"; 
            // out+="<td>"+array.countries[x].country_description+"</td>";
           // out+="<td>"+array.countries[x].status+"</td>";
     //        if(array.countries[x].status==1){
     //        out += "<td class='success-p1'>Active</td>";
     //        out+="<td><button class='btn btn-danger toggleCountry' ";
     //        out+="bid='"+array.countries[x].country_id+"'> <i class=\"fa fa-times\" aria-hidden=\"true\"></i>&nbsp Deactivate</button>"; 
     //    }
     //    else{
     //        out += "<td class='danger-p1'>Deactivated</td>";
     //        out+="<td><button class='btn btn-danger toggleCountry' ";
     //        out+="bid='"+array.countries[x].country_id+"'><i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp Activate </button>"; 
     // }
    
            out+="<td><a href='country_edit.php?id="+array.countries[x].id+"'class='btn btn-success' data-toggle='tooltip' title='Edit Country'><i class='fa fa-pencil-square-o'></i> Edit</a>";
            out+="&nbsp;&nbsp;&nbsp;<button class='btn btn-danger deleteCountry' mid='"+array.countries[x].id+"' title='Delete Country' data-toggle='tooltip'><i class='fa fa-trash'></i></button></td>";
            //out+="&nbsp<a href='../adminapi/country/country_delete.php?id="+array.countries[x].country_id+"' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\" data-toggle='tooltip' '><i class='fa fa-trash'></i> Delete</a>";  //for deleting a country
            
            
            // out+="</td>";
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
    // $("img.lazy").lazyload();
        
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
    search_country();
  })

$("body").ready(function(){
    search_country();
  })
  

 
  </script>
    
   



