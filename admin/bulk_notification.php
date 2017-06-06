<?php require_once ('theme/header_1.php'); ?>

<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>

<?php

$all=0;
$active=0;
$blocked=0;

$query="select count(*) as count,`status` from `user` where `firebaseid`!='' and `status`!=0 group by `status`";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
  switch ($row["status"]) 
  {
    case '1':
      $active=$row["count"];
      break;
    case '-1':
      $blocked=$row["count"];
      break;
  }
}

$all=$active+$blocked;

?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bulk Notifications
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
             
           <!--mastercategory_insert_2.php-->
                
            <div class="form-horizontal">
            <!-- <h4>SMS Notifications</h4> -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Notification Title</label>
                        <div class="col-sm-6">
                        <input type="text" id="title" style="width: 300px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Notification Body</label>
                        <div class="col-sm-6">
                        <textarea name="" id="messageBody" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Send To</label>
                    <div class="col-sm-6">
                        <input type="radio" name="users" value="-2"> All Users (<?=$all?>) &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="users" value="1" checked=""> Active Users (<?=$active?>) &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="users" value="-1"> Blocked Users (<?=$blocked?>) &nbsp;&nbsp;&nbsp;
                    </div>
                    </div>

                    
                    <div class="divide60"></div>
                    <hr>
                    <br>
                    
                    
    </div>

        <div class="box-footer">
            <button class="btn btn-primary sendNotification"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;&nbsp;  Send</button>
         </div>



            </div><!-- /.box-body -->

          </div><!-- /.box -->
<!--                        </div>-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php 
  require_once ('theme/footer.php');
  
  ?>
 <script>
   function sendNotification()
   {
      var title=$("#title").val();
      var body=$("#messageBody").val();
      var users=$('input:radio[name=users]:checked').val();

      $.post("../adminapi/sendNotification.php",
      {
        title: title,
        body: body,
        users: users
      },
      function(data)
      {
          // console.log(data);
          var arr=JSON.parse(data);
          if(arr.success>0)
          {
            swal("Success","Sent to "+arr.success+" phones","success");
          }
          else
          {
            swal("Failed","Notifications not sent","error");
          }
      })
   }

   $(".sendNotification").click(function()
   {
      sendNotification();
   })
 </script>