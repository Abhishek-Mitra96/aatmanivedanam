<?php require_once ('theme/header_1.php'); ?>

<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>

<?php

$all=0;
$active=0;
$blocked=0;

$query="select count(*) as count,`status` from `user` where `mobile`!='' and `status`!=0 group by `status`";
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
        Bulk SMS
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

            <div class="form-horizontal">
            <!-- <h4>SMS Notifications</h4> -->
                    <div class="divide40"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-6">
                        <textarea name="" id="message" cols="30" rows="10" onkeyup="count()"></textarea>
                        <div class="divide20"></div>
                        <div id="charcount" style="display: inline;">0</div> character and <div id="smscount" style="display: inline;">0</div> messages.
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
    </div>

        <div class="box-footer">
            <button class="btn btn-primary sendMessage"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;&nbsp;  Send</button>
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
   function sendMessage()
   {
      var body=$("#message").val();
      var users=$('input:radio[name=users]:checked').val();

      $.post("../adminapi/sendMessage.php",
      {
        message: body,
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
            swal("Failed","Messages not sent","error");
          }
      })
   }

   $(".sendMessage").click(function()
   {
      sendMessage();
   })


  function count() {
    var message=$("#message").val();
    if(message.length>765)
    {
      message=message.substr(0,765);
      $("#message").val(message);
      swal("Stop","Only 765 characters allowed","error");
    }
    document.getElementById("charcount").innerHTML=message.length;
    document.getElementById("smscount").innerHTML=smsSize(message);
  }
</script>