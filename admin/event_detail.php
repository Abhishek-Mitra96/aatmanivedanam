<?php 

require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');
?>
</section>

<div class="content-wrapper">
      
  <section class="content-header">
    <h1>Event Detail
    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#edit">Edit Event</button>
    <!-- <a class="btn btn-info pull-right" role="button">Edit Video</a> -->
  </section>
      
  <section class="content">
    <div class="box box-primary" id="box-widget">
      <!-- <div class="box-header"></div> -->
          
      <!-- <div class="divide20"></div> -->
      <div class="box-body">
        <div class="row">
          <center><div id="frame" class="thumbnail" ></div></center>
        </div>
        <div class="row">
          <!-- <div class="well well-sm col-sm-2">
            <h3 class="text-center"><i class="fa fa-spinner"></i></h3>
            <h4 class="text-center">Active</h4>
          </div> -->
          <div class="col-sm-12">
            <h2 class="text-center" id="event_name"><i class="fa fa-spinner"></i></h2>
            <h4 class="text-center" id="event_description"><i class="fa fa-spinner"></i></h4>
          </div>
          <!-- <div class="well well-sm col-sm-2">
            <h3 class="text-center"><i class="fa fa-spinner"></i></h3>
            <h4 class="text-center">Inactive</h4>
          </div> -->
        </div>
      </div>

      <!-- <div class="box-footer"></div> -->
    </div>

  </section>
</div>
<?php require_once ('theme/footer.php');?>

<!--EDIT Modal -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Event</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <table class="table">
            <tr><th class="col-xs-3"></th><th class="col-xs-9"></th></tr>
            <tr>
              <td><b>Event Name</b></td>
              <td><input type="text" class="form-control" id="edit_event_name"></td>
            </tr>
            <tr>
              <td><b>Description</b></td>
              <td><textarea class="form-control" id="edit_event_description" rows="3"></textarea></td>
            </tr>
            <tr>
              <td><b>Event URL</b></td>
              <td><input type="text" class="form-control" id="edit_event_url"></td>
            </tr>
            <tr>
              <td><b>Status</b></td>
              <td>
                <div class="row">
                  <div class="col-xs-6">
                    <input type="radio" id="edit_event_status" name="edit_event_status" value="1">&nbsp;Active
                  </div>
                  <div class="col-xs-6">
                    <input type="radio" id="edit_event_status" name="edit_event_status" value="0">&nbsp;Inactive
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="edit()" data-dismiss="modal">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>

$(document).ready(function(){
    auto_load();
});

function auto_load(){
  var event_id='<?=$_REQUEST["id"]?>';
  $.ajax({
      type: 'POST',
      url: '../adminapi/event/event_detail.php',
      data: {
            event_id:event_id
          },
      success: function(data) {
        console.log(data);
        var arr=JSON.parse(data);
        $("#event_name").text(arr["event_list"][0]["name"]);
        $("#event_description").text(arr["event_list"][0]["description"]);

        $("#edit_event_name").val(arr.event_list[0].name);
        $("#edit_event_description").val(arr.event_list[0].description);
        $("#edit_event_url").val(arr.event_list[0].url);
        $("#edit_event_status[value='"+arr.event_list[0]["status"]+"']").attr('checked','checked');

        $("#frame").html('<img class="img img-responsive" src="'+arr.dir_url+''+arr.event_list[0].url+'" width=:100%>');
      }
  });
}

function edit(){
  //console.log(category_id);
  var event_id=<?=$_REQUEST["id"];?>;
  var name=$("#edit_event_name").val();
  var description=$("#edit_event_description").val();
  var url=$("#edit_event_url").val();
  var status=$("#edit_event_status:checked").val();
  // console.log(category_id);
  if(event_id!=""){
    $.ajax({
        type: 'POST',
        url: '../adminapi/event/event_edit.php',
        data: {
              event_id:event_id,
              name:name,
              description:description,
              url:url,
              status:status
            },
        success: function(data) {
          console.log(data);
          var arr=JSON.parse(data);
          if(arr["status"]=="success"){
            toast("Changes made successfully");
            auto_load();
          }else{
            swal("Error",arr["remark"],"error");
          }
        }
    });
  }else{
    swal("Error","id not recieved","error");
  }
}
</script>