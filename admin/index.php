<!DOCTYPE html>
<html>
<style>
  .ch{display:inline; float: right; color:#CCC; margin-top: 10px;}
</style>
    <?php require_once '../include/config.php'; ?>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Log in</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
      <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="../assets/plugins/iCheck/square/blue.css">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
           <?php echo $company_name; ?>
         </div>
         <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <p id="texterror" class="text1">Enter your username and password to log in:</p>
            <div class="form-group has-feedback">
               <input type="text"  name="username" class="form-control username" placeholder="Name">
               <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
               <input type="password" name="password" class="form-control password" placeholder="Password" id="password">
               <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
               <div class="col-xs-12">
                  <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat btn_submit" >Sign In</button>
                  <span class="ch"><a href="" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a></span>
               </div>
            </div>
         </div>
      </div>
<!-- modal for forgot password -->
<div id="forgotPassword" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <table class=" table table-bordered">
  <tr>
    <td><b> Mobile No. : </b></td>
    <td>
    <input type="text" id="mobile" autocomplete=off placeholder="Enter your Mobile no." minlength="10" maxlength="10">&nbsp;&nbsp;&nbsp;<button class="btn btn-info sendOTP">Send OTP</button>
    <div id="otpSent" class="success"></div>
    <div id="otpNotSent" class="failure"></div>
    </td>
  </tr>
  <tr>
    <td><b> OTP : </b></td>
    <td><input type="text" id="otp" autocomplete=off placeholder="Enter OTP received" maxlength="6"></td>
  </tr>
  <tr>
    <td><b> New Password : </b></td>
    <td><input type="password" id="newPassword" autocomplete=off placeholder="Enter new password"></td>
  </tr>
  <tr>
    <td><b> Repeat Password : </b></td>
    <td><input type="password" id="repeatPassword" autocomplete=off placeholder="Repeat password"></td>
  </tr>
</table>
<div id="passwordChanged" class="success"></div>
<div id="passwordNotChanged" class="failure"></div>
  <div class="divide35"></div>
  <button class="btn btn-success changePassword">Change Password</button>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>
        

<!-- Modal Ends here -->
      <!-- <script src="../assets/plugins/jQuery/jQuery-2.2.0.min.js"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- <script src="../assets/plugins/iCheck/icheck.min.js"></script> -->
      <script src="js/login.js"></script>
   </body>
</html>