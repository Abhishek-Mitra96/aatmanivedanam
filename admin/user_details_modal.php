<!--Modal to View Customer Details -->
<div id="viewCustomer" class="modal fade" role="dialog" data-keyboard="true" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Customer Details</h4>
      </div>
      <div class="modal-body">
        <table class=" table table-bordered">
    <tr>
        <td><b> Name </b></td>
        <td><input type="text" id="viewName" disabled="true"></td>
    </tr>
    <tr>
        <td><b> Email</b></td>
        <td><input type="text" id="email" disabled="true"></td>
    </tr>
    <tr>
        <td><b> Mobile </b></td>
        <td><input type="text" id="viewMobile" disabled="true"></td>
    </tr>
</table>

    </div>
    </div>

  </div>
</div>

<!-- Modal Ends here -->

<script>
$('body').on('click', '.viewCustomer', function()
{
    // alert("click detected");
    id=this.id;
    $.post("../adminapi/user/verify_user_search.php",
    {
        id: id,
    },
    function(data) 
    {
        // console.log(data);
        var dat=JSON.parse(data);
        if(dat.status=="success")
        {
            $("#viewName").val(dat.users[0].fname+' '+dat.users[0].lname);
            // $("#schoolName").val(dat.users[0].school_name);
            $("#email").val(dat.users[0].email);
            $("#viewMobile").val(dat.users[0].mobile);
            // $("#address").val(dat.users[0].address);
            // $("#state").val(dat.users[0].state);
            // $("#city").val(dat.users[0].city);
            // $("#pincode").val(dat.users[0].pincode);
            $("#viewCustomer").modal('show');
        }
    });
});
</script>