<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Login </title>
    <link rel="apple-touch-icon" href="<?=base_url()?>static/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>static/app-assets/images/ico/favicon.ico">
    <!-- <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/css/pages/login-register.css">
   
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-color="bg-gradient-x-purple-red" data-col="1-column">
    <style type="text/css">
        form .error{
            width: 100%;
            text-align: center;
            color: red;
        }
        form .success{
            width: 100%;
            text-align: center;
        }
        .countdown{
		display: table;
		width: 100%;
		text-align: left;
		font-size: 15px;

	}
        #resend_otp2{
		display: none;
        font-size: 1.2rem;
	}

	#resend_otp2:hover{

		text-decoration:underline;

	}
    </style>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0 hideDiv heading">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="<?=$logo;?>" alt="branding logo" style="width: 80%;">
                                    </div>
                                    <div class="font-large-1  text-center">
                                        Member Login
                                    </div>
                                </div>
                                <div class="card-content">
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <button data-toggle="collapse-login" data-target-show="#admin-login" data-target-hide="#host-login" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue">Admin</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button data-toggle="collapse-login" data-target-show="#host-login" data-target-hide="#admin-login"  class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue">Host</button>
                                        </div>
                                    </div> -->
                                    <?php if(@$type=='admin') : ?>
                                    <div class="card-body pt-0 collapse show" id="admin-login">
                                        <form class="form-horizontal" id="login" action="<?=base_url()?>login" novalidate method="POST">
                                            <label class="error"></label> 
                                            <label class="success"></label> 
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control round" id="username" name="username" placeholder="Your Username"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control round" id="password" name="password" placeholder="Enter Password"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">

                                                </div>

                                            </div>
                                            <div class="form-group text-center">
                                                <input type="hidden" name="type" value="admin">
                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                                            </div>
                                            <div class="float-right btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12  mb-1"><a id="adminlogin" class=" text-white card-link">Forgot Password?</a></div>

                                        </form>
                                    </div>
                                    <?php else : ?>
                                    <div class="card-body pt-0 collapse show" id="host-login">
                                        <form class="form-horizontal" id="login2" action="<?=base_url()?>login" novalidate method="POST">
                                            <label class="error"></label> 
                                            <label class="success"></label> 
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control round" id="username" name="username" placeholder="Your Username"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control round" id="password" name="password" placeholder="Enter Password"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">

                                                </div>
                                                <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="" class="card-link">Forgot Password?</a></div>

                                            </div>
                                            <div class="form-group text-center">
                                                <input type="hidden" name="type" value="host">

                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                                            </div>

                                        </form>
                                    </div>
                                    <?php endif; ?>

                                   
                                </div>
                            </div>
                              <!-- admin forgot password area -->
                              <div class="card border-grey border-lighten-3 px-1 py-1 m-0 AdminDiv"  style="display: none;"> 
                                     <div class="card-header border-0">
                                     <div class="text-center mb-1">
                                     <img src="<?=$logo;?>" alt="branding logo" style="width: 80%;">
                                        </div>
                                      <div class="font-large-1  text-center">
                                       Forgot Password  
                                    </div>
                                </div>
                                <div class="card-content pb-5 adminmobile" id="adminmobile">
                                <form class="form-horizontal validate-form" id="mobileotp"   method="POST">
                                            <label class="error text-danger"></label> 
                                            <label class="success text-success"></label> 
                                            <fieldset class="form-group position-relative has-icon-left ">
                                                <input type="text"  class="form-control round" id="num" name="num" placeholder="Enter Mobile Number"   onkeyup='validate(this)'>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                              <p id='result'></p>
                                            <div class="form-group text-center">

                                                <button type="button" id="adminforgot" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Next</button>
                                            </div>
                                        </form>
                                </div>
                                <div class="card-content pb-5 otp form" style="display: none;" id="adminotp">
                                <form class="form-horizontal" id="submitotp"   method="POST">
                                            <label class="error text-danger"></label> 
                                            <label class="success text-success"></label> 
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="number"  class="form-control round" id="otps" name="otps" placeholder="Enter Your OTP"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                <br>
                                                <div class="countdown"></div>
                                            <a href="#" id="resend_otp2" type="button">Resend</a>
                                            </fieldset>
                                           
                                            <div class="form-group text-center">

                                                <button type="button" id="adminsubmitotpbtn" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Submit</button>
                                            </div>
                                        </form>
                                </div>
                                <div class="card-content pb-5 updatepass form" style="display: none;" id="adminupdatepass">
                                <form class="form-horizontal" id="updatepass" action=""  method="POST">
                                            <label class="error text-danger"></label> 
                                            <label class="success text-success"></label> 
                                            <fieldset class="form-group position-relative has-icon-left ">
                                                <input type="number"  class="form-control round" id="adminpass" name="adminpass" placeholder="Enter  New Password"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left pb-3">
                                                <input type="number"  class="form-control round" id="admincpass" name="admincpass" placeholder="Enter  Confirm Password"  required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group text-center">

                                                <button type="button" id="adminupdatesubmit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Forgot</button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                            <!-- End admin Password forgot area -->
                        </div>
                    </div>
                </section>
                
            </div>
        </div>
    </div>
    <!-- END: Content-->


      <!-- BEGIN: Vendor JS-->
      <script src="<?=base_url()?>static/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/app-assets/vendors/css/extensions/toastr.css">
    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url()?>static/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->
    <script src="<?=base_url()?>static/app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/extensions/sweet-alerts.js" type="text/javascript"></script>
    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url()?>static/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/core/app.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- END: Theme JS-->
    <script type="text/javascript" src="<?=base_url()?>static/app-assets/vendors/js/jquery-validation/jquery.validate.js"></script>
    <!-- BEGIN: Page JS-->
    <script src="<?=base_url()?>static/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/extensions/toastr.js" type="text/javascript"></script>
    <script src="<?=base_url()?>static/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      function validate(phoneNum) {
     
        var phoneNumRegex = /^\+?([0-9]{3})\)?[ -]?([0-9]{3})[ -]?([0-9]{4})$/;
        if(phoneNum.value.match(phoneNumRegex)) {
        //     $(".success").html("Valid").fadeIn();
        //     window.setTimeout(function(){
        //    $(".success").html("Valid").fadeOut();
        //   },5000)
        }  
        else {  
            $(".error").html("Please enter a valid number").fadeIn();
            window.setTimeout(function(){
           $(".error").html("Please enter a valid number").fadeOut();
          },2000)
        }
      }
    </script>

    <script type="text/javascript">
        $(document).on('click','[data-toggle="collapse-login"]',function(){
            var data_target_show = $(this).attr('data-target-show');
            var data_target_hide = $(this).attr('data-target-hide');

            $(data_target_show).removeClass('show');
            $(data_target_show).addClass('show');
            $(data_target_hide).removeClass('show');
            

            return false;
        })
        $(document).ready(function(){
            $('#login').submit(function(){
                $.post($(this).attr('action'),$(this).serialize())
                .done(function(data){
                    data = JSON.parse(data);
                    $('.'+data.res).html(data.msg);
                    if (data.res=='success') {
                        setTimeout(function() {
                            window.location.href = data.redirect_url;
                            // window.open(data.redirect_url,'_self');
                        }, 500);
                    }
                })

                return false;
            })
        })
    </script>
    <script>
        $(document).ready(function(){
  $("#adminlogin").click(function(){
    $(".hideDiv").hide();
    $(".AdminDiv").show();
  });
});
   
        // Opt area BY AJAY KUMAR
 $(document).ready(function(){

function admin_send_otp(number){
    var ch = "forgot";
if(number==''){
$(".error").html("Please Enter your Mobile Number").fadeIn();
window.setTimeout(function(){
$(".error").html("Please Enter your Mobile Number").fadeOut();
      },2000)
$(".hideDiv").hide();
$(".AdminDiv").show();
}else{
    $("#adminmobile").hide();
    $("#adminotp").show();
    $(".AdminDiv").show();
    $.ajax({
url:"<?=base_url();?>admin-mobile-otp",
type:"POST",
data:{mobile:number,ch:ch},
success:function(data)
{
    console.log(data);
     data = JSON.parse(data);
    if (data.res=='success') {
    $(".success").html("OTP send you mobile number").fadeIn();
    window.setTimeout(function(){
        $(".success").html("OTP send you mobile number").fadeOut();
        },2000)
    timer();
    $("#adminmobile").hide();
    $("#adminotp").show();
    $(".AdminDiv").show();
   }else if(data.res=='error')
   {
    $(".error").html(data.msg).fadeIn();
    window.setTimeout(function(){
        $(".error").html(data.msg).fadeOut();
        },2000)
    $("#adminmobile").show();
    $("#hide").show();
    $("#adminotp").hide();
    $(".AdminDiv").show();
   }
 
}
});
}
};

// send otp
$('#adminforgot').click(function(){

var number = $('#num').val();
admin_send_otp(number);
});
//resend otp function
$('#resend_otp2').click(function(){

var number = $('#num').val();

admin_send_otp(number);
$(this).hide();
});
//end of resend otp function

});
//start of timer function

function timer(){

var timer2 = "00:31";
var interval = setInterval(function() {


var timer = timer2.split(':');
//by parsing integer, I avoid all extra string processing
var minutes = parseInt(timer[0], 10);
var seconds = parseInt(timer[1], 10);
--seconds;
minutes = (seconds < 0) ? --minutes : minutes;

seconds = (seconds < 0) ? 59 : seconds;
seconds = (seconds < 10) ? '0' + seconds : seconds;
//minutes = (minutes < 10) ?  minutes : minutes;
$('.countdown').html("Resend otp in:  <b class='text-primary'>"+ minutes + ':' + seconds + " seconds </b>");
//if (minutes < 0) clearInterval(interval);
if ((seconds <= 0) && (minutes <= 0)){
clearInterval(interval);
$('.countdown').html('');
$('#resend_otp2').css("display","block");
} 
timer2 = minutes + ':' + seconds;
}, 1000);

}

//end of timer


</script>
<script>
 $(document).ready(function(){
  // check otp
  
$("#adminsubmitotpbtn").on('click',function(){
var otp = $('#otps').val();
if(otp==''){
$(".error").html("Please Enter Otp").slideDown();
$(".success").slideUp();
}else{
$.ajax({
url:"<?=base_url();?>admin-check-otp",
type:"POST",
data:{otp:otp},
success:function(data)
{

 if(data==1)
 {
    $(".adminmobile").hide();
    $("#hide").hide();
    $(".AdminDiv").show();
    $('#adminupdatepass').show();
    $('#adminotp').hide();
 }else
 {
    $(".error").html("OTP not correct").fadeIn();
    window.setTimeout(function(){
        $(".error").html("OTP not correct").fadeOut();
                        },3000)
    $(".success").remove();
 }
}
});
}
})
//   Update pass
$("#adminupdatesubmit").on('click',function(){
$(".error").remove();
var newpassword = $('#adminpass').val();
var cpassword = $('#admincpass').val();
var mobile = $('#num').val();
if(newpassword=='' || cpassword==''){
$(".error").html("Please Enter Password").slideDown();
$(".success").slideUp();
}else{
if(newpassword==cpassword)
{
$.ajax({
url:"<?=base_url();?>admin-update-pass",
type:"POST",
data:{newpassword:newpassword,cpassword:cpassword,mobile:mobile},
success:function(data)
{
 if(data.res='success')
 {
    
    $("#updatepass").trigger("reset");
    $(".success").html("Password Forgot success").slideDown();
    setTimeout(function(){// wait for 5 secs(2)
    location.reload(); // then reload the page.(3)
    }, 1000);
  
 }else
 {
    $(".error").html("OTP Not Correct").slideDown();
 }
}
});
}else
{
$(".error").html("Password and Confirm password Does Not Matched").fadeIn();
    window.setTimeout(function(){
        $(".error").html("Password and Confirm password Does Not Matched").fadeOut();
                        },3000)
}

}
})

});
</script>
    
    <!-- END: Page JS-->
</body>
<!-- END: Body-->

</html>