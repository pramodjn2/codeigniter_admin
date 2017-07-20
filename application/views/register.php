<?php
$websetting = $this->session->userdata('websetting');
?>
<?php 
$this->load->view('common/header');


 ?>
<!-- Start: HEADER -->

<!-- end: HEADER -->

<!-- start: MAIN CONTAINER -->

<div class="main-container">
  <section class="page-top">
    <div class="container">
      <div class="col-md-4 col-sm-4">
        <h1>&nbsp;</h1>
      </div>
      <div class="col-md-8 col-sm-8"> </div>
    </div>
  </section>
  <section class="wrapper padding50">
    <div class="main-container login">
      <div class="row">
        <div class="col-sm-12 col-sm-offset-4">
          <div class="col-sm-4">
            <div id="signup_message"></div>
            <div id="sign_in_message"></div>
            <div id="forgot_message"></div>
            <?php if(!empty($class)&&($msg)){?>
            <div class="<?php echo $class; ?>" ><?php echo $msg; ?> </div>
            <?php }?>
            <!-- start: LOGIN BOX -->
            <div class="box-login" id="box-login">
              <h3>Sign in to your account</h3>
              <p> Please enter your name and password to log in. </p>
              <form class="form-login" id="form-login" method="post" action="<?=base_url('login')?>">
                <fieldset>
                  <div class="form-group"> <span class="input-icon">
                    <input type="email" class="form-control required" name="email" placeholder="Email" maxlength="40">
                    </span> 
                    <!-- To mark the incorrectly filled input, you must add the class "error" to the input --> 
                    <!-- example: <input type="text" class="login error" name="login" value="Username" /> --> 
                  </div>
                  <div class="form-group form-actions"> <span class="input-icon">
                    <input type="password" class="form-control password required" name="password" placeholder="Password" mi maxlength="40">
                    <a class="forgot" href="javascript:void(0);"> I forgot my password </a> </span> </div>
                  <div class="form-actions">
                    <label for="remember" class="checkbox-inline">
                      <input type="checkbox" class="grey remember" id="remember" name="remember">
                      Keep me signed in </label>
                    <button type="submit" class="btn btn-bricky pull-right"> Login <i class="fa fa-arrow-circle-right"></i> </button>
                  </div>
                  <div class="new-account"> Don't have an account yet? <a href="javascript:void(0);" class="register"> Create an account </a> </div>
                </fieldset>
              </form>
            </div>
            <!-- end: LOGIN BOX --> 
            <!-- start: FORGOT BOX -->
            <div class="box-forgot" id="box-forgot">
              <h3>Forgot Password?</h3>
              <p> Enter your e-mail address below to reset your password. </p>
              <form class="form-forgot" method="post" action="<?=base_url('login/forgotpassword')?>" id="form-forgot">
                <fieldset>
                  <div class="form-group"> <span class="input-icon">
                    <input type="email" class="form-control required" name="email" placeholder="Email">
                    </span> </div>
                  <div class="form-actions"> <a class="btn btn-light-grey go-back" href="javascript:void(0);"> <i class="fa fa-circle-arrow-left"></i> Back </a>
                    <button type="submit" class="btn btn-bricky pull-right"> Submit <i class="fa fa-arrow-circle-right"></i> </button>
                  </div>
                </fieldset>
              </form>
            </div>
            <!-- end: FORGOT BOX --> 
            <!-- start: REGISTER BOX -->
            <div class="box-register" id="box-register">
              <h3>Sign Up</h3>
              <p> Enter your details below: </p>
              <form class="form-register" id="form-register" method="post" action="<?=base_url('login/signup')?>">
                <fieldset>
                  <div class="form-group">
                    <input type="text" class="form-control required" name="first_name" placeholder="First Name" id="first_name" maxlength="40">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control required" name="last_name" placeholder="Last Name" id="last_name" maxlength="40">
                  </div>
                 
                  <div class="form-group"> <span class="input-icon">
                    <input type="email" class="form-control required email" name="email" placeholder="Email Id" id="email" maxlength="60">
                    </span> </div>
                    
                  <div class="form-group"> <span class="input-icon">
                    <input type="password" class="form-control required" id="password" name="password" placeholder="Password" maxlength="60">
                    </span> </div>
                  <div class="form-group">
                    <div>
                      <label for="agree" class="checkbox-inline">
                        <input type="checkbox" value="agree" class="grey agree required" id="agree" name="agree">
                        I agree to the Terms of Service and Privacy Policy </label>
                    </div>
                  </div>
                  <div class="form-actions"> <a class="btn btn-light-grey go-back" href="javascript:void(0);"> <i class="fa fa-circle-arrow-left"></i> Back </a>
                    <button type="submit" class="btn btn-bricky pull-right"> Submit <i class="fa fa-arrow-circle-right"></i> </button>
                  </div>
                </fieldset>
              </form>
            </div>
            <!-- end: REGISTER BOX --> 
            
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- end: MAIN CONTAINER -->

<link rel="stylesheet" href="<?=base_url('assets/css/front_end/login.css')?>">
<script src="<?=base_url('assets/vendors/jquery-validation/js/jquery.validate.min.js')?>"></script> 
<script src="<?=base_url('assets/validation/jquery.form.min.js');?>"></script> 

<script src="<?=base_url('assets/validation/registration_main.js');?>"></script> 
<script src="<?=base_url('assets/validation/login.js')?>"></script> 





<script>
			jQuery(document).ready(function() {
				Login.init();
			});
			
			
			$(document).ready(function(){
		setTimeout("ajaxSaveForm('form-register');",100);
		setTimeout("ajaxSaveForm('form-login');",100);
		setTimeout("ajaxSaveForm('form-forgot');",100);	
	});
			
		</script>
<?php
if(!empty($_GET['referral_code'])){
?>
<script>
	 $('.box-login').hide();
     $('.box-register').show();
	</script>
<?php 
}
?>
<!-- start: FOOTER -->
<?php $this->load->view('common/footer'); ?>
