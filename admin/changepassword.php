<?php require_once ('theme/header_1.php'); ?>
<?php require_once ('theme/header_2.php'); ?>
<?php require_once ('theme/sidebar.php'); ?>
 
  <div class="content-wrapper">

    <section class="content">
  <div class="login-box">
         <div class="login-logo">
            <a href="#"><?php echo $company_name; ?></a>
         </div>
         <div class="login-box-body">
            <p class="login-box-msg">Change your password</p>
            <div class="form-group has-feedback">
               <input type="password"  name="password1" class="form-control password1" placeholder="Old password">
               <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
               <input type="password" name="password2" class="form-control password2" placeholder="New Password">
               <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
               <input type="password" name="password3" class="form-control password3" placeholder="Confirm New Password">
               <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
               <div class="col-xs-12">
                  <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat chng_pass">Change Password</button>
               </div>
            </div>
         </div>
      </div>
    </section>
</div>

<?php require_once ('theme/footer.php');?>
<script>
$(document).ready(function(){
  $('.chng_pass').click(function(){
    var oldpass=$('.password1').val();
    var newpass=$('.password2').val();
    var confnew=$('.password3').val();
    if(newpass===confnew)
    {
            $.ajax({
                       type: 'POST',
                       url: '../adminapi/logs/change_password.php',
                       data: {
                           oldpassword: oldpass,
                           newpassword: newpass
                       },
                       success: function(data) {
                           if(data==1)
                           {
                               $('.login-box-msg').html("Password updated successfully!");
                               // swal("Success","Password changed successfully","success");
                               toast("Password changed successfully");
                            }
                           else
                           {
                               $('.login-box-msg').html("Incorrect Password!");
                                toast("Incorrect Password");

                             }
                       }
                   });
    }
    else
    {
      swal("Error","Passwords do not match","error");
    }
  })
})
</script>