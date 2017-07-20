<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Golabi Admin - Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/font-awesome/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="../assets/css/yep-rtl.css"> -->

<!-- Related css to this page -->
<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/vendors/animate/css/animate.min.css">

<!-- Yeptemplate css --><!-- Please use *.min.css in production -->
<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/css/yep-style.css">
<link rel="stylesheet" href="<?php echo $this->config->item('site_url') ?>assets/css/yep-vendors.css">

<!-- favicon -->
<link rel="shortcut icon" href="<?php echo $this->config->item('site_url') ?>assets/img/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo $this->config->item('site_url') ?>assets/img/favicon/favicon.ico" type="image/x-icon">
</head>

<!-- You can use .rtl CSS in #login-page -->
<body id="mainbody" class="login-page" >
<canvas id="spiders" class="hidden-xs" ></canvas>
<div class="">
  <div style="margin: 5% auto; position: relative; width: 400px;">
    <div id="sign-form" class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
              <h2><?php echo $this->config->item('site_name') ?> Login</h2>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('login'); ?>" method="post">
              <fieldset>
              <?php $this->load->view('common/message'); ?>
              <?php if($msg['error']){ ?>
                <div class="alert alert-danger">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                 <strong>Warning!</strong> <?php echo $msg['error']; ?>
                </div>
    		  <?php } ?>
                <div class="spacing hidden-md"></div>
                <div  class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="email">
                </div>
                <div class="spacing"></div>
                <div  class="input-group"> <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                </div>
                <div class="spacing"></div>
                <div class="checkbox checkbox-primary">
                  <input id="remember" type="checkbox"  >
                  <label for="remember"> Remember me </label>
                </div>
                <button id="singlebutton" name="singlebutton" class="btn btn-success btn-sm  pull-right">Sign In</button>
              </fieldset>
            </form>
            <a id="forget" href="#" class="grey">Forget Password?</a> </div>
        </div>
      </div>
    </div>
    <div id="forget-form" class="panel panel-default animated " style="display:none;">
      <div class="panel-body">
        <div class="text-center">
          <h2><?php echo $this->config->item('site_name') ?> Login</h2>
          <h5 class="grey">Reset password your account</h5>
          <br>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal">
              <fieldset>
                <div class="spacing hidden-md"></div>
                <div  class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input id="login-email-1" type="email" class="form-control" name="email" placeholder="Enter Your Email">
                </div>
                <div class="spacing"></div>
                <div  class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input id="login-birthday-1" type="text" class="form-control" name="birthday" placeholder="Enter Your Birthday">
                </div>
                <div class="spacing"><br>
                </div>
                <button id="singlebutton1" name="singlebutton" class="btn btn-info btn-sm pull-right">Submit</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
    <p>Copyright 2017 <?php echo $this->config->item('site_name') ?>. All right reserved.</p>
  </div>
</div>

<!-- General JS script library--> 
<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-ui/js/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-searchable/js/jquery.searchable.min.js"></script> 
<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/vendors/jquery-fullscreen/js/jquery.fullscreen.min.js"></script> 

<!-- Yeptemplate JS Script --><!-- Please use *.min.js in production --> 
<script type="text/javascript" src="<?php echo $this->config->item('site_url') ?>assets/js/yep-script.js"></script> 

<!-- Related JavaScript Library to This Pagee --> 

<!-- Plugins Script --> 
<script type="text/javascript">
			$(function(){
				$('#forget').on('click', function(event) {	
					$('#sign-form').hide();		
					$('forget-form').show();
		
					$('#q-sign-in').show();
					$('#q-register').hide();

					$('#forget-form').show();								
					$('#forget-form').addClass('animated bounce');						
				});
			});

			$(function(){
				$('#sign-in').on('click', function(event) {
					$('#forget-form').hide();		
					$('#register-form').hide();		

					$('#q-sign-in').hide();	
					$('#q-register').show();

					$('#sign-form').show();			
					$('#sign-form').addClass('animated bounce');
				});
			});

			$(function(){
				$('#register').on('click', function(event) {
					$('#forget-form').hide();		
					$('#sign-form').hide();		

					$('#q-sign-in').show()
					$('#q-register').hide();	

					$('#register-form').show();			
					$('#register-form').addClass('animated bounce');
				});
			});				
		</script>
</body>
</html>