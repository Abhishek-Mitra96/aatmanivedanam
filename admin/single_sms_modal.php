<!--Modal to send SMS to Customer  -->
<div id="sendSms" class="modal fade" role="dialog" data-keyboard="true" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Send SMS</b></h4>
      </div>
      <div class="modal-body">
        <table class=" table table-bordered">
    <tr>
        <td><b> Mobile </b></td>
        <td><input type="text" id="mobile" disabled="true"></td>
    </tr>
    <tr>
        <td><b> Message </b></td>
        <td><textarea id="singleSMS" maxlength="765"></textarea></td>
    </tr>
    <tr>
        <td><b> SMS Count </b></td>
        <td><input type="text" id="smsCount" disabled="true" value="0"></td>
    </tr>
    
</table>

    <button class="btn btn-success sendSingleSms">Send</button>

    </div>
    </div>

  </div>
</div>

<!-- Modal Ends here -->

<script>
$('body').on('click', '.smsCustomer', function()
{
    // alert("click detected");
    var mobile=$(this).attr("mobile");
    $("#mobile").val(mobile);
    $("#sendSms").modal('show');
        
});
$("body").on("keyup","#singleSMS",function()
{
    var message=$(this).val();
    var count=smsSize(message);
    $("#smsCount").val(count);

});
$('body').on('click', '.sendSingleSms', function()
{
    $("#sendSms").modal('hide');

    var mobile=$("#mobile").val();
    var message=$("#singleSMS").val();

    $.post("../adminapi/sms/send.php",
    {
        mobile: mobile,
        message: message
    },
    function(data)
    {
        var arr=JSON.parse(data);
        toast(arr.remark);
    })
        
});

</script>