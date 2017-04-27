<?php 

require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');
?>
</section>

<div class="content-wrapper">
      
  <section class="content-header">
    <h1> Videos
    <a href="video_add.php" class="btn btn-info pull-right" role="button">Add Videos</a>
  </section>
      
  <section class="content">
    <div class="box box-primary" id="box-widget">
      <div class="box-header">
        <div class="row">
          <div class="col-xs-12 col-sm-5">
            <input class="Filter" type="radio" name="filter" value="-2" checked="checked"> &nbsp;All &nbsp; &nbsp;
            <input class="Filter" type="radio" name="filter" value="1"> &nbsp;Active &nbsp; &nbsp;
            <input class="Filter" type="radio" name="filter" value="0"> &nbsp;Inactive &nbsp; &nbsp;
          </div>
          <div class="col-xs-12 col-sm-1"></div>

          <div class="col-xs-12 col-sm-4">
            <input type="text" id="search" name="search" class="form-control input-sm" placeholder="Search" value=""/>
          </div>

          <div class="col-xs-12 col-sm-2">
            <button type="submit" class="btn btn-primary search_btn"><i class="fa fa-search"></i> Search</button>
          </div>
        </div>
             
      </div><!-- /.box-header -->
          
      <div class="divide20"></div>
      <div class="box-body no-padding">
        <div id="content">
          <h4 class="text-center">Please wait</h4>
        </div>
      </div>

          <div class="box-footer"></div>
      </div>

  </section>
</div>
<?php require_once ('theme/footer.php');?>

<script>


$(document).ready(function() {
    $('.search_btn').click(function() {
        search();
    });
    
    $('#search').keyup(function(e) {
       // ****************e.which==13 for enter key working ****************************
        if(e.which==13){ 
          pagination(1,5,1);
            search();
        }
         // ****************e.which==27 for ESC key working ****************************
        else if(e.which==27)
        {
            $('#search').val("");
            pagination(1,5,1);
            search();
        }
        
    });
    
});

$("body").on("change",".Filter",function(){
  search();
});


function search(){
    var searchkey = $('#search').val();
       var status=$('input:radio[name=filter]:checked').val();
       var page=$(".active1").attr("page");
       
        $.ajax({
            type: 'POST',
            url: '../adminapi/video/video_list.php',
            data: {
                search:searchkey,
                status:status,
                page:page,
                limit:10
                },
            success: function(data) {
              console.log(data);
              print_data(data);
            }
        });
}
 
function print_data(data){
  // console.log(fetchdata);
  var arr=JSON.parse(data);

  if(arr.status=="success"){

    var i;
    var out='';

    var video_count=arr.video_list.length;
    if(video_count!=0){
      //atleast one row return
      //out+='<div class="box box-primary"><div class="box-body table-responsive no-padding">';

      out+='<table class="table table-striped"><tbody>';
      out+='<tr>';
      out+='<th class="col-sm-2">Category name</th>';
      out+='<th class="col-sm-3">Name</th>';
      out+='<th class="col-sm-6">Description</th>';
      out+='<th class="col-sm-1">Action</th>';
      out+='</tr>';
      for(i=0;i<video_count;i++){
        out+='<tr>';

        out+='<td>';
        if(arr.video_list[i].category_status=="1")
          out+='<a href="video_category_detail.php?id='+arr.video_list[i].category_id+'" class="text-success">'+arr.video_list[i].category_name+'</a>';
        else out+='<a href="video_category_detail.php?id='+arr.video_list[i].category_id+'" class="text-danger">'+arr.video_list[i].category_name+'</a>';
        out+='</td>';

        out+='<td>';
        if(arr.video_list[i].status=="1")
          out+='<a href="video_detail.php?id='+arr.video_list[i].video_id+'" class="text-success">'+arr.video_list[i].name+'</a>';
        else out+='<a href="video_detail.php?id='+arr.video_list[i].video_id+'" class="text-danger">'+arr.video_list[i].name+'</a>';
        out+='</td>';

        out+='<td>'+arr.video_list[i].description+'</td>';

        out+='<td><div class="row">';
        if(arr.video_list[i].status=="1"){
          //category is in active mode. press this to deactivate
          out+='<a class="btn btn-danger btn-block" onclick="toggleStatus('+arr.video_list[i].video_id+')" data-toggle="tooltip" title="click for deactivate"><i class="fa fa-times"></i>&nbsp;Active</a>';
        }else{
          //category is in inactive mode. press this to activate
          out+='<a class="btn btn-success btn-block" onclick="toggleStatus('+arr.video_list[i].video_id+')" data-toggle="tooltip" title="click for activate"><i class="fa fa-check"></i>&nbsp;Inactive</a>';
        }
        //out+='&nbsp;<a href="video_edit.php?id='+arr.video_list[i].video_id+'" class="btn btn-warning" data-toggle="tooltip" title="Edit Video"><i class="fa fa-pencil"></i></a>';
        out+='</div></td>';

        out+='</tr>';
      }
      out+="</tbody></table>";//</div></div>";
    }else{
      //no coupon return
      out+='<h4 class="text-center text-danger">No data return</h4>';
    }
  }
  else{
    out='<h3 class="text-center text-danger">'+arr.remark+'</h3>';
  }
      
  document.getElementById("content").innerHTML=out;
  
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
  search();
});

$("body").ready(function(){
     search();
  });

function toggleStatus(video_id){
  swal({
    title: "Are you sure ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "green",
    confirmButtonText: "Yes",
    closeOnConfirm: true
  },
  function(){
    $.ajax({
            type: 'POST',
            url: '../adminapi/video/video_change_status.php',
            data: {
                  video_id:video_id
                },
            success: function(data) {
              console.log(data);
              var arr=JSON.parse(data);
              if(arr["status"]=="success"){
                toast("Changes made successfully");
                search();
              }else{
                swal("Error",arr["remark"],"error");
              }
            }
        });
  });
}

</script>