function sendOTP()
{
	var mobile=document.getElementById("mobile").value;
	if(mobile.length!=10)
	{
		document.getElementById("otpNotSent").innerHTML="Incorrect mobile number";
	}
	else{
		$.post("sendOTP.php",
		{
			mobile: mobile
		},
		function(data)
		{
			if(data==1){
				document.getElementById("otpNotSent").innerHTML="";
				document.getElementById("otpSent").innerHTML="OTP sent";
			}
			else if(data==0){
				document.getElementById("otpSent").innerHTML="";
				document.getElementById("otpNotSent").innerHTML="Incorrect mobile number";
			}
		});
	}
}


$(".sendOTP").click(function()
  {
    sendOTP();
  })


$(document).ready(function() {
         
           // $(function() {
           //     $('input').iCheck({
           //         checkboxClass: 'icheckbox_square-blue',
           //         radioClass: 'iradio_square-blue',
           //         increaseArea: '20%'
           //     });
           // });
         
//           $('.btn_submit').keyup/click(function() {
               
               
               
          $('.btn_submit').click(function() {      
               checkLogin();
           });
           $('#password').keypress(function(e) {      
               if(e.which==13){
                    checkLogin();
                }
           });
           $('#mobile').keypress(function(e) {      
               if(e.which==13){
                    checkLogin();
                }
           });
         });
               
               
               function checkLogin()
               {
                var name = $('.username').val();
                var password = $('.password').val();
                if (name != '' && password != '') {
                   $.ajax({
                       type: 'POST',
                       url: '../adminapi/logs/checklogin.php',
                       data: {
                           username: name,
                           password: password
                       },
                       success: function(data) {
         
         
                           if (data == 1)
                               location.href="dashboard.php";
                           else
                               $('#texterror').html('Sorry ! Your name or password did not match');
                       }
                   });
               } else {
         
                   alert("Please fill in all the fields!");
         
               }
               }

/**************** Change Password  *************/

function changePassword()
{
  var mobile=document.getElementById("mobile").value;
  var otp=document.getElementById("otp").value;
  var newPassword=document.getElementById("newPassword").value;
  var repeatPassword=document.getElementById("repeatPassword").value;

  if(newPassword===repeatPassword)
  {
    $.post("changeForgotPassword.php",
    {
      mobile: mobile,
      otp: otp,
      newPassword : newPassword
    },
    function(data)
    {
      var obj = JSON.parse(data);

      if(obj[0].status=="success")
        document.getElementById("passwordChanged").innerHTML="Password changed successfully. Please login now.";
      else if(obj[0].status!="success")
        document.getElementById("passwordNotChanged").innerHTML=obj[0].remarks;
    });
  }
  else
  {
    // alert("Both Passwords do not match");
    swal("Error","Both Passwords do not match","error");
  }
}



$(".changePassword").click(function()
  {
    changePassword();
  })