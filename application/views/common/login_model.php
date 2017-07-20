<!--/.LoginModal-header-section -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-width" role="document">
    <form id="login-form" action="<?php echo base_url('login'); ?>" method="post" role="form">
      <div class="modal-content login-top-head">
        <h3>PLEASE SIGN UP OR SIGN IN</h3>
        <div class="modal-body main-body claerfix">
          <div class="form-group">
            <div class="col-sm-12" id="sign_in_message"></div>
            <div class="col-sm-12"> 
              <!--<input type="text" class="form-control em-login-input input-lg text-muted" id="usr input-lg" placeholder="sanah.miller">-->
              
              <input type="text" name="email" id="email" tabindex="1" class="form-control em-login-input input-lg text-muted required email" maxlength="50" placeholder="sanah.miller" value="">
            </div>
          </div>
          <div class="form-group clearfix">
            <div class="col-sm-8">
              <input type="password" class="form-control em-login-input input-lg required" maxlength="50" minlength="5"  name="password" id="password" placeholder="**********">
            </div>
            <div class="col-sm-4"> 
            <a href="javascript:void(0);" onClick="modelClose('myModal'),tabChange('emForgotPassword');" class="forgot-link modalButton small">Forgot Password?</a>
            </div>
          </div>
        </div>
        <div class="text-center form-login"> 
          <!-- <button type="button" class="btn btn-default btn-login btn-lg" data-dismiss="modal">LOGIN</button>-->
          <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-default btn-login btn-lg" value="Log In">
          <div class="link-login"> <a href="javascript:void(0);" onClick="modelClose('myModal'),tabChange('myModal2');">Dont have Accout? REGISTER</a> </div>
        </div>
        <div class="modal-footer emform-login-foot">
          <div class="login-social-icon">
            <div class="s-icon">
              <p>Login with Social Media <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </p>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!--/.LoginModal-header-section --> 


<!--/.Forgot-Pass-Modal-header-section -->
				<div class="modal fade" id="emForgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			      <div class="modal-dialog modal-dialog-width" role="document">
                  
                   <form id="forget-form" action="<?php echo base_url('login/forgot_password'); ?>" method="post" role="form">
			        <div class="modal-content login-top-head">
			         <h3>Forgot Password</h3>
			          <div class="modal-body main-body claerfix">            
			              <div class="form-group clearfix">
                          
                           <div class="row">
            <div class="col-sm-12" id="forget_message"></div>
          </div>
          
			                <div class="col-sm-12">          
			                <input type="email" class="form-control em-res-input input-lg required email" maxlength="50" name="email" id="email" placeholder="Email id">
                            
			                </div>
			              </div>
			               <div class="clearfix">  </div>    
			          </div>
			            <div class="text-center form-login">  
			                 <input type="submit" name="login-submit" id="login-submit" tabindex="2" class="btn btn-default btn-login btn-lg" value="Send">
			            </div>
			          <div class="modal-footer emform-login-foot">
			           <div class="login-social-icon">
			            <div class="s-icon">
			             <p>Login with Social Media
			           		<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			           		<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
			           	 </p>
			            </div>
			           </div> 
			          </div> 
			        </div>
                    </form>
			      </div>
			    </div>
<!--/.Forgot-Pass-Modal-header-section -->
            
<!--/.RegisterModal-header-section -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-width" role="document">
    <div class="modal-content login-top-head">
      <h3>Register</h3>
      <p>Dont have Accout? Create a new account, It may take less than a minute</p>
      <div class="modal-body main-body  claerfix">
      <form id="registration-form" action="<?php echo base_url('login/signup'); ?>" method="post" role="form">
        <div class="form-group res-bott-border">
          <div class="row">
            <div class="col-sm-12" id="sign_up_message"></div>
          </div>
         <!-- <div class="row">
            <div class="col-sm-12">
              <input type="text" class="form-control em-res-input input-lg required" maxlength="50" name="name" id="name" placeholder="Name">
            </div>
          </div>-->
        </div>
        <div class="form-group res-bott-border">
          <div class="row">
            <div class="col-sm-12" id="sign_up_message"></div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <input type="email" class="form-control em-res-input input-lg required email" maxlength="50" name="email" id="email" placeholder="Email id">
            </div>
          </div>
        </div>
        <div class="form-group res-bott-border">
          <div class="row">
            <div class="col-sm-12">
              <input type="password" class="form-control em-res-input input-lg text-muted required" maxlength="50" minlength="5" id="psw" name="psw" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="form-group res-bott-border">
          <div class="row"> 
            <!-- equalTo="#psw" -->
            <div class="col-sm-12">
              <input type="password" class="form-control em-res-input input-lg text-muted required"  name="rep_password" id="rep_password" placeholder="Re enter password">
            </div>
          </div>
        </div>
        <div class="text-center form-login">
          <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-default btn-login btn-lg" value="Create Account">
        </div>
        </div>
      </form>
      <div class="modal-footer emform-login-foot">
        <div class="login-social-icon">
          <div class="s-icon">
            <p>Login with Social Media <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/.RegisterModal-header-section -->

<style type="text/css">
  .error{
	  color:#C03;
  }
  </style>
<script type="text/javascript" src="<?php echo base_url('assets/vendors/jquery-validation/js/jquery.validate.min.js'); ?>"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/validation/jquery.form.min.js'); ?>"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/validation/registration_main.js'); ?>"></script> 
<script type="text/javascript">
$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

$(document).ready(function() {
	setTimeout("ajaxSaveForm('login-form','sign_in_message');",200);
	setTimeout("ajaxSaveForm('registration-form','sign_up_message');",200);
	setTimeout("ajaxSaveForm('forget-form','forget_message');",200);
	
});


</script> 