<!--Modal to send Notification to Customer  -->
<div id="sendNotification" class="modal fade" role="dialog" data-keyboard="true" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Send Notification</b></h4>
      </div>
      <div class="modal-body">
        <table class=" table table-bordered">
    <tr>
        <td><b> Title </b></td>
        <td><input type="text" id="notificationTitle" maxlength="50"></td>
    </tr>
    <tr>
        <td><b> Message </b></td>
        <td><textarea id="singleNotification" maxlength="765"></textarea></td>
    </tr>
    <tr style="display: none;">
        <td><input type="hidden" id="userid"></textarea></td>
    </tr>

</table>

    <button class="btn btn-success sendSingleNotification">Send</button>

    </div>
    </div>

  </div>
</div>

<!-- Modal Ends here -->

<script>
$('body').on('click', '.notificationCustomer', function()
{
    var uid=$(this).attr("uid");
    $("#userid").val(uid);
    $("#sendNotification").modal('show');
        
});
$('body').on('click', '.sendSingleNotification', function()
{
    $("#sendNotification").modal('hide');

    var uid=$("#userid").val();
    var title=$("#notificationTitle").val();
    var message=$("#singleNotification").val();

    $.post("../adminapi/notification/send.php",
    {
        uid: uid,
        title: title,
        message: message
    },
    function(data)
    {
        console.log(data);
        // var arr=JSON.parse(data);
        toast("Notification sent");
    })
        
});

</script>