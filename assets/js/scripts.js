function toast (message) {
    $(".toast").html(message);
    $('.toast').stop().fadeIn(400).delay(3000).fadeOut(400); //fade out after 3 seconds
};

function pagination(start, stop, active_point)
  {
    var out='<ul class="pagination">';

    for(var i=start;i<=stop;i++)
    {
      if(i==active_point)
        out+='<li class="active"><a class="active1" page="'+i+'">'+i+'</a></li>';
      else
        out+='<li page="'+i+'"><a class="page" page="'+i+'">'+i+'</a></li>';
    }
                  
    out+='</ul>';
    $(".box-footer").html(out);
  }


/*********** Deleting a message ************/

   $("body").on("click",".deleteMessage",function()
  {
    var id=$(this).attr("mid");
    swal({   
      title: "Delete Message?",   
      text: "You will not be able to recover this message!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Delete it!",   

      }, 
      function()
      {
        $.post("../adminapi/message/delete.php",
          {
            id:id
          },
          function(data)
          {
            arr=JSON.parse(data);
            if(arr.status=="success")
            {
                // swal("Success!", arr.remark, "success"); 
                toast(arr.remark);
                search_message();
            }
            else
            {
                toast(arr.remark);
                // swal("Oops!", arr.remark, "error");
            }
          })   
      });
  });

/*********** Deleting a Country ************/

   $("body").on("click",".deleteCountry",function()
  {
    var id=$(this).attr("mid");
    swal({   
      title: "Delete Country?",   
      text: "This action is non reversible!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Delete it!",   

      }, 
      function()
      {
        $.post("../adminapi/country/delete.php",
          {
            id:id
          },
          function(data)
          {
            arr=JSON.parse(data);
            if(arr.status=="success")
            {
                // swal("Success!", arr.remark, "success"); 
                toast(arr.remark);
                search_country();
            }
            else
            {
                toast(arr.remark);
                // swal("Oops!", arr.remark, "error");
            }
          })   
      });
  });


/***************** Mark all messages as read **************/


$("body").on("click",".allMessagesRead",function()
  {
    swal({   
      title: "Mark all messages Read?",   
      // text: "You will not be able to recover this imaginary file!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Yes, I am sure!",   
      // closeOnConfirm: false 
      }, 
      function()
      {
        $.post("../adminapi/message/mark_all_read.php",
          {},
          function(data)
          {
            arr=JSON.parse(data);
            if(arr.status=="success")
            {
                // swal("Success!", "All messages marked read", "success"); 
                toast("All messages marked read");
                search_message();
            }
            else
            {
                // swal("Oops!", "Something went wrong. Try again later", "error");
                toast("Something went wrong. Try again later");
            }
          })   
      });
  });


/*************** Change message status ************/


$("body").on("click",".changeMessageStatus",function(){
  id=this.id;
  $("#button"+id).html("Please wait");
  $.post("../adminapi/message/message_status_change.php",
  {
    message_id:id
  },
  function(data){
    // console.log(data);
    var obj=JSON.parse(data);
    if(obj.status=="success")
    {
       toast(obj.remark);
    }
    else
    {
      toast(obj.remark);
    }
    // location.reload();
    search_message();
  })
})


/************ Toggle Brand Status ***********/

   $("body").on("click",".toggleBrand",function()
  {
    var id=$(this).attr("bid");
    
    $.post("../adminapi/brand/change_brand_status.php",
    {
      id:id
    },
    function(data)
    {
      arr=JSON.parse(data);
      if(arr.status=="success")
      {
          // swal("Success!", arr.remark, "success"); 
          toast(arr.remark);
          search_brand();
      }
      else
      {
          toast(arr.remark);
          // swal("Oops!", arr.remark, "error");
      }
    })   
});


/************ Toggle Tour Status ***********/

$("body").on("click",".toggleTourStatus",function()
  {
    var tid=$(this).attr("tid");
    swal({   
      title: "Are you sure?",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Yes, I am sure!",   
      closeOnConfirm: false 
      }, 
      function()
      {
        $.post("../adminapi/tour/change_tour_status.php",
        {
          id: tid
        },
        function(data)
        {
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success","Done","success");
            search_tour();
          }
          else
          {
            swal("Error","Unknown Error Occured","error");
            // swal("Error",arr.remark,"error");
          }

        })
      })
  });

/************ Toggle Blog Status ***********/

$("body").on("click",".toggleBlogStatus",function()
  {
    var tid=$(this).attr("tid");
    swal({   
      title: "Are you sure?",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Yes, I am sure!",   
      closeOnConfirm: false 
      }, 
      function()
      {
        $.post("../adminapi/blog/change_blog_status.php",
        {
          id: tid
        },
        function(data)
        {
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success","Done","success");
            search_blog();
          }
          else
          {
            swal("Error","Unknown Error Occured","error");
            // swal("Error",arr.remark,"error");
          }

        })
      })
  });

$("body").on("click",".deleteBlog",function()
  {
    var tid=$(this).attr("tid");
    swal({   
      title: "Are you sure?",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Yes, I am sure!",   
      closeOnConfirm: false 
      }, 
      function()
      {
        $.post("../adminapi/blog/delete_blog.php",
        {
          id: tid
        },
        function(data)
        {
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success","Done","success");
            search_blog();
          }
          else
          {
            swal("Error","Unknown Error Occured","error");
            // swal("Error",arr.remark,"error");
          }

        })
      })
  });


/************ Toggle Category Status ***********/

$("body").on("click",".toggleCategoryStatus",function()
  {
    var cid=$(this).attr("cid");
    swal({   
      title: "Are you sure?",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Yes, I am sure!",   
      }, 
      function()
      {
        $.post("../adminapi/category/change_category_status.php",
        {
          id: cid
        },
        function(data)
        {
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            // swal("Success","Done","success");
            toast("Done");
            search_category();
          }
          else
          {
            toast("Unknown Error Occured");
            // swal("Error","Unknown Error Occured","error");
            // swal("Error",arr.remark,"error");
          }

        })
      })
  });

$("body").on("click",".toggleBlogCategoryStatus",function()
  {
    var cid=$(this).attr("cid");
    swal({   
      title: "Are you sure?",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Yes, I am sure!",   
      }, 
      function()
      {
        $.post("../adminapi/blog_category/change_blog_category_status.php",
        {
          id: cid
        },
        function(data)
        {
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            // swal("Success","Done","success");
            toast("Done");
            search_category();
          }
          else
          {
            toast("Unknown Error Occured");
            // swal("Error","Unknown Error Occured","error");
            // swal("Error",arr.remark,"error");
          }

        })
      })
  });

/************ Toggle User Status ***********/

$("body").on("click",".toggleUserStatus",function()
  {
    var uid=$(this).attr("uid");
    swal({   
      title: "Are you sure?",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#00A65A",   
      confirmButtonText: "Yes, I am sure!",   
      // closeOnConfirm: false 
      }, 
      function()
      {
        $.post("../adminapi/user/change_status.php",
        {
          id: uid
        },
        function(data)
        {
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            // swal("Success","Done","success");
            toast("Done");
            search_user();
          }
          else
          {
            toast("Unknown Error Occured");
            // swal("Error","Unknown Error Occured","error");
          }

        })
      })
  });


/********** Get report *********/

function getReport()
{
    var start = $("#dateStart").val();
    var stop = $("#dateStop").val();

    $.post("../adminapi/report/sales.php",
    {
      date_start : start,
      date_stop : stop
    },
    function(data)
    {
      // alert(data);
        var myArr=JSON.parse(data);
        myFunction(myArr);
    });

}

$(".salesReport").click(function(){
  getReport();
});

/*********** SMS Size **********/

function smsSize(message)
{
  var chars=message.length;
  len=0;
  if(chars==0)
    len=0;
  else if(chars>0 && chars<=160)
    len=1;
  else if (chars>160 && chars<=306)
    len=2;
  else if(chars>306 && chars<=459)
    len=3;
  else if(chars>459 && chars<=612)
    len=4;
  else if(chars>612 && chars<=765)
    len=5;
  else
    len=6;

  return len;
}

function change_order_status(id,status)
{
  $.post("../commonapi/order/change_order_status.php",
  {
    orderNo: id,
    status: status
  },
  function(data)
  {
    // console.log(data);
    // console.log("ID is "+id+" and data is "+data);
    var arr=JSON.parse(data);
    // alert(arr.remark);
    swal({
      title: "Success",
      text: arr.remark,
      type: "success"},
      function(){
        // location.reload();

      });
        search_order();
    
  })
}   

$('body').on('click', '.dispatchOrder', function()
{
    // alert("click detected");
    id=this.id;
    $("#orderNo").val(id);
    $("#consignmentDetailsModal").modal('show');
});

$('body').on('click', '.saveConsignmentDetails', function()
{
  var orderNo=$("#orderNo").val();
  // alert("Order no is "+orderNo);
  var consignmentNo=$("#consignmentNo").val();

  $.post("../adminapi/shipping_details/add.php",
  {
    orderNo: orderNo,
    consignmentNo: consignmentNo
  },
  function(data)
  {
        // alert(data);
        change_order_status(orderNo,2);
        search_order(); 
      $("#consignmentDetailsModal").modal('hide');

  })  
})

$("body").on("click",".processOrder",function(){
  change_order_status(this.id,1);
})

$("body").on("click",".deliverOrder",function(){
  change_order_status(this.id,3);
})

$("body").on("click",".cancelOrder",function(){
  id=this.id;
  swal({
     title: "Are you sure?",
     text: "The order will be cancelled!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD4B39",
     confirmButtonText: "Yes, cancel it!",
     closeOnConfirm: false 
   }, 
    function()
    {
      change_order_status(id,-1);
     });
})

$("body").on("change",".orderFilter",function(){
  search_order();
})


$("body").on("click",".addToWishlist",function(){
  var id=this.id;
  // alert(id);
  $.post("../clientapi/wishlist/wishlist_add.php",
        {
          product_id: id
        },
        function(data)
        {
          // console.log(data);
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success",arr.remark,"success");
          }
          else
          {
            swal("Error",arr.remark,"error");
          }

        })
})

$("body").on("click",".removeWishlist",function(){
  var id=this.id;
  // alert(id);
  $.post("../clientapi/wishlist/wishlist_delete.php",
        {
          id: id
        },
        function(data)
        {
          // console.log(data);
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success",arr.remark,"success");
            wishlist();
          }
          else
          {
            swal("Error",arr.remark,"error");
          }

        })
})

function checklogin()
{
  var user=$("#userDetail").val();
    var password=$("#password").val();

    if(user.length==0 || password.length==0)
      swal("Error","Both fields are mandatory","error");

    else{
    $.post("../clientapi/user/login.php",
          {
            mobile: user,
            password: password
          },
          function(data)
          {
            // console.log(data);
            var arr=JSON.parse(data);
            if(arr.status=="success")
            {
              window.location="/";
              // location.reload();
              swal("Success",arr.remark,"success");
            }
            else
            {
              swal("Error",arr.remark,"error");
            }

          })
      }
}

$("body").on("click",".userLogin",function(){
    checklogin();
  });

$(".checklogin").keyup(function(e)
{
  if(e.which==13)
    {
      checklogin();
    }
})

$("body").on("click",".userRegister",function()
{
  //alert("sdfdsfdf");
  var fname=$("#fname").val();
  var lname=$("#lname").val();
  var email=$("#email").val();
  var mobile=$("#mobile").val();
  var newPassword=$("#newpassword").val();
  var repeatPassword=$("#repeatpassword").val();
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  var error=0;
  var message="";
  if(fname.length==0)
  {
    error=1;
    // message+="First Name can't be empty";
    swal("Error","First Name can't be empty","error");
  }

  else if(lname.length==0)
  {
    error=1;
   // message+="Last Name can't be empty";
    swal("Error","Last Name can't be empty","error");
  }


   else if(!email.match(mailformat))
  {
      error=1;
     // message+="Please Enter a Valid email address<br>";
      swal("Error","Please Enter a Valid email address","error");
  } 

  else if(mobile.length!=10)
  {
    error=1;
   // message+="Mobile has to be 10 digits";
   swal("Error","Mobile has to be 10 digits","error");
  }
  else if(newPassword.length==0)
  {
    error=1;
   // message+="Password can't be empty";
    swal("Error","Password can't be empty","error");
  }
  else if(newPassword!=repeatPassword)
  {
    error=1;
    //message+="Passwords do not match";
    swal("Error","Passwords do not match","error");
  }


  if(error==0)
  {
    $.post("clientapi/user/register.php",
    {
      fname: fname,
      lname: lname,
      email: email,
      mobile: mobile,
      password : newPassword
    },
    function(data)
    {
      //alert("post");
      // console.log(data);
      var obj = JSON.parse(data);

      if(obj.status=="success"){
        alert(obj.remark);
         swal("Success",obj.remark,"success");
        //$('.success').html("Registration successful. Please login now.");
      }
      else{
        alert(obj.remark);
         swal("Error",obj.remark,"error");
        //alert(obj.remark);
        //$('.error').html(obj.remark);
      }
    });
  }
  else
  {
    $(".error").html(message);
  }
});

$("body").on("click",".deleteCart",function(){
  var id=this.id;
  // alert(id);
  $.post("../clientapi/cart/cart_delete.php",
        {
          cartID: id
        },
        function(data)
        {
          // console.log(data);
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success",arr.remark,"success");
            cart();
          }
          else
          {
            swal("Error",arr.remark,"error");
          }

        })
})

$("body").on("click",".cartToWishlist",function(){
  var id=this.id;
  // alert(id);
  $.post("../clientapi/cart/cart_to_wishlist.php",
        {
          product_id: id
        },
        function(data)
        {
          // console.log(data);
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success",arr.remark,"success");
            cart();
          }
          else
          {
            swal("Error",arr.remark,"error");
          }

        })
})

$(".addAddress").click(function()
    {
        var flag=0;
        var name=$("#name").val();
        var address1=$("#address1").val();
        var address2=$("#address2").val();
        var mobile=$("#mobile").val();
        var landmark=$("#landmark").val();
        var city=$("#city").val();
        var pin=$("#pin").val();

        if(name.length==0)
        {
            swal("Error","Name can't be empty","error");
            flag=1;
        }
        else if(address1.length==0)
        {
            swal("Error","Address can't be empty","error");
            flag=1;   
        }
        else if(city.length==0)
        {
            swal("Error","City can't be empty","error");
            flag=1;   
        }
        else if(pin.length==0)
        {
            swal("Error","Zip code can't be empty","error");
            flag=1;   
        }
        else if(mobile.length==0)
        {
            swal("Error","Mobile can't be empty","error");
            flag=1;   
        }
        else if(mobile.length!=10)
        {
            swal("Error","Mobile can only be 10 digits","error");
            flag=1;   
        }


        if(flag==0)
        {
            $.post("../clientapi/address/add.php",
            {
                name: name,
                address1: address1,
                address2: address2,
                mobile: mobile,
                landmark: landmark,
                city: city,
                pin: pin
            },
            function(data)
            {
                var arr=JSON.parse(data);
                if(arr.status=="success")
                {
                  swal("Success",arr.remark,"success");
                }
                else
                {
                  swal("Error",arr.remark,"error");
                }
            })
        }
    })

$(".editAddress").click(function()
    {
        var flag=0;
        var address_id=$("#address_id").val();
        var name=$("#name").val();
        var address1=$("#address1").val();
        var address2=$("#address2").val();
        var mobile=$("#mobile").val();
        var landmark=$("#landmark").val();
        var city=$("#city").val();
        var pin=$("#pin").val();

        if(name.length==0)
        {
            swal("Error","Name can't be empty","error");
            flag=1;
        }
        else if(address1.length==0)
        {
            swal("Error","Address can't be empty","error");
            flag=1;   
        }
        else if(city.length==0)
        {
            swal("Error","City can't be empty","error");
            flag=1;   
        }
        else if(pin.length==0)
        {
            swal("Error","Zip code can't be empty","error");
            flag=1;   
        }
        else if(mobile.length==0)
        {
            swal("Error","Address can't be empty","error");
            flag=1;   
        }
        else if(mobile.length!=10)
        {
            swal("Error","Mobile can only be 10 digits","error");
            flag=1;   
        }


        if(flag==0)
        {
            $.post("../clientapi/address/edit.php",
            {
                address_id: address_id,
                name: name,
                address1: address1,
                address2: address2,
                mobile: mobile,
                landmark: landmark,
                city: city,
                pin: pin
            },
            function(data)
            {
                var arr=JSON.parse(data);
                if(arr.status=="success")
                {
                  swal("Success",arr.remark,"success");
                  // location.reload();
                }
                else
                {
                  swal("Error",arr.remark,"error");
                }
            })
        }
    })


$("body").on("click",".deleteAddress",function(){
  var id=this.id;
  swal({
     title: "Warning",
     text: "Are you sure you want to remove this address?",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD4B39",
     confirmButtonText: "Yes, Remove it!",
   }, 
    function()
    {
      $.post("../clientapi/address/delete.php",
            {
              address_id: id
            },
            function(data)
            {
              // console.log(data);
              var arr=JSON.parse(data);
              if(arr.status=="success")
              {
                swal("Success",arr.remark,"success");
                address();
              }
              else
              {
                swal("Error",arr.remark,"error");
              }

            })
    })
})

$(".forgotPassword").click(function()
    {
        var detail=$("#detail").val();
        // alert(detail);
        if(detail.length==0)
        {
            swal("Error","Mobile number or student id can not be empty","error");
        }
        else
        {
            $.post("../clientapi/user/forgotpassword.php",
            {
                detail: detail
            },
            function(data)
            {
                var arr=JSON.parse(data);
                if(arr.status=="success")
                {
                  $("#forgotPasswordModal").modal();
                  $("#otpSent").html("OTP sent");
                }
                else
                {
                  swal("Error",arr.remark,"error");
                }
            })
        }
    })

function changePassword()
{
  var detail=$("#detail").val();
  var otp=$("#otp").val();
  var newPassword=$("#newPassword").val();
  var repeatPassword=$("#repeatPassword").val();

  if(newPassword===repeatPassword)
  {
    $.post("../clientapi/user/check_otp_forgot.php",
    {
      detail: detail,
      otp: otp,
      newpassword : newPassword
    },
    function(data)
    {
      var obj = JSON.parse(data);

      if(obj.status=="success")
        document.getElementById("passwordChanged").innerHTML="Password changed successfully. Please login now.";
      else
        document.getElementById("passwordNotChanged").innerHTML=obj.remarks;
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


/************* Update quantity of a product in cart *************/

$("body").on("click",".updateQuantity",function(){

  var cid=$(this).attr("cid");
  var qty=$("#productQuantity"+cid).val();

  updateQuantity(cid,qty);
  
})

$("body").on("keyup",".productQuantity",function(e)
{
   if(e.which==13)
    {
      var cid=$(this).attr("cid");
      var qty=$("#productQuantity"+cid).val();
      updateQuantity(cid,qty);
    }
})

function updateQuantity(cid,qty)
{
  if(qty=="" || qty==0)
    swal("Error","Quantity can't be 0","error");
  else
  {
  $.post("../clientapi/cart/cart_qty_update.php",
        {
          cartID: cid,
          qty: qty
        },
        function(data)
        {
          // console.log(data);
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success",arr.remark,"success");
            cart();
          }
          else
          {
            swal("Error",arr.remark,"error");
          }

        })
  }
}

/************* Wishlist to cart *************/

$("body").on("click",".wishlistToCart",function(){

  var pid=$(this).attr("pid");
  
  $.post("../clientapi/wishlist/wishlist_to_cart.php",
        {
          product_id: pid,
        },
        function(data)
        {
          // console.log(data);
          var arr=JSON.parse(data);
          if(arr.status=="success")
          {
            swal("Success","Product moved to cart successfully","success");
            wishlist();
          }
          else
          {
            swal("Error",arr.remark,"error");
          }

        })
})

/*********** Send Enquiry/Message ***********/

$('body').on('click', '.sendMessage', function() {
            
    var name = $("#name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var subject = $("#subject").val();
    var message = $("#message").val();

    var error=0;

    if(name=="")
    {
        swal("Error","Name can not be empty","error");
        error=1;
    }
    else if(email=="")
    {
        swal("Error","Email can not be empty","error");
        error=1;
    }
    else if(mobile=="")
    {
        swal("Error","Mobile can not be empty","error");
        error=1;
    }
    else if(mobile.length!=10)
    {
        swal("Error","Incorrect Mobile Number","error");
        error=1;
    }
    else if(subject=="")
    {
        swal("Error","Subject can not be empty","error");
        error=1;
    }
    else if(message=="")
    {
        swal("Error","Message can not be empty","error");
        error=1;
    }

    if(error==0)
    {
        $(".sendMessage").hide();
        $.post("sendEnquiry.php",
            {
                name: name,
                mobile: mobile,
                email: email,
                subject: subject,
                message: message
            },
            function(data)
            {
                if(data==1)
                {
                    swal("Succcess","We heard You!! Now we'll get back to you","success");
                    // $("#sent").val("We heard You!! Now we'll get back to you");
                }
                else
                {
                    swal("Error!", "Technical ERROR. Please contact us on info@kydsmart.com", "error");
                    // $("#unsent").html("Technical ERROR. Please contact us on info@kydsmart.com");
                }
            });
    }
});

function addToCart(product_id)
{
  var color=0;
    var size=0;
    var cl=0;

  color=$(".Color > .selected").attr("value");
  size=$('select[name="size"] option:selected').val(); 
  cl=$('select[name="class"] option:selected').val(); 

  $.post("../clientapi/cart/cart_add_single.php",
  {
    product_id: product_id,
    size: size,
    color: color,
    class: cl
  },
  function(data)
  {
    var arr=JSON.parse(data);
    if(arr.status=="success")
    {
     swal("Success",arr.remark,"success");
    }
    else
    {
      swal("Error",arr.remark,"error");
    }
    // toast(arr.remark);
  });
}

$("body").on("click",".addToCart",function(){
  var pid=$(this).attr("pid");
  // alert(pid);
  addToCart(pid);
})




$("body").on("click",".deleteProduct",function(){
  pid=$(this).attr("pid");

  swal({
     title: "Are you sure?",
     text: "The product will be removed from carts, wishlists and previous orders as well",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD4B39",
     confirmButtonText: "Yes, DELETE it!",
   }, 
    function()
    {
      $.post("../adminapi/product/product_delete.php",
      {
        id: pid
      },
      function(data)
      {
        var arr=JSON.parse(data);
        // if(arr.status=="success")
        // {
        //  // swal("Success",arr.remark,"success");
        //  toast(arr.remark);
        // }
        // else
        // {
        //   swal("Error",arr.remark,"error");
        // }
         toast(arr.remark);
         search_product();
      })
     });
})

$("body").on("click",".deleteUser",function(){
  uid=$(this).attr("uid");

  swal({
     title: "Are you sure?",
     text: "Previous orders for this user will also be removed",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD4B39",
     confirmButtonText: "Yes, DELETE it!",
   }, 
    function()
    {
      $.post("../adminapi/user/delete.php",
      {
        id: uid
      },
      function(data)
      {
        var arr=JSON.parse(data);
        // if(arr.status=="success")
        // {
        //  // swal("Success",arr.remark,"success");
        //  toast(arr.remark);
        // }
        // else
        // {
        //   swal("Error",arr.remark,"error");
        // }
         toast(arr.remark);
         search_user();
      })
     });
})

$("body").on("click",".cashReceived",function(){
  orderNo=$(this).attr("orderNo");

  swal({
     title: "Cash Received?",
     text: "Are you sure?",
     // type: "confirm",
     showCancelButton: true,
     confirmButtonColor: "#00A65A",
     confirmButtonText: "Yes, I am sure!",
   }, 
    function()
    {
      $.post("../adminapi/order_management/cash_received.php",
      {
        orderNo: orderNo
      },
      function(data)
      {
        var arr=JSON.parse(data);
        // if(arr.status=="success")
        // {
        //  // swal("Success",arr.remark,"success");
        //  toast(arr.remark);
        // }
        // else
        // {
        //   swal("Error",arr.remark,"error");
        // }
         toast(arr.remark);
         search_order();
      })
     });
})