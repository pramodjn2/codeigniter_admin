<?php
$websetting = $this->session->userdata('websetting');
//dd($websetting);
?>
<?php echo $map['js'];  ?>
<?php $this->load->view('common/header'); ?>
<!-- start: MAIN CONTAINER -->

<div class="main-container">
  <section class="wrapper no-padding">
    <div id="map"><?php echo $map['html'];?></div>
    <!-- Map div is here --> 
  </section>
  <p>&nbsp;</p>
  <section class="wrapper padding50">
    <div class="container">
    
    <?php $this->load->view('common/message'); ?>
      <div class="row">
        <div class="col-md-8 extra">
          <?php echo validation_errors(); ?>
          <h3>Contact us</h3>
          <br>
          <form id="contactForm" action="<?=base_url('contact');?>" novalidate method="post">
            <div class="row">
              <div class="form-group">
                <div class="col-md-6">
                  <label> Your name <span class="symbol required"></span> </label>
                  <input type="text" id="name" name="name" class="form-control" maxlength="40" data-msg-required="Please enter your name." value="">
                </div>
                <div class="col-md-6">
                  <label> Your email address <span class="symbol required"></span> </label>
                  <input type="email" id="email" name="email" class="form-control" maxlength="40" data-msg-email="Please enter a valid email address." data-msg-required="Please enter your email address." value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-12">
                  <label> Mobile Number </label>
                  <input type="text" id="mobile_number" name="mobile_number" class="form-control" maxlength="11" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-12">
                  <label> Subject <span class="symbol required"></span> </label>
                  <input type="text" id="subject" name="subject" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-md-12">
                  <label> Message <span class="symbol required"></span> </label>
                  <textarea id="message" name="message" class="form-control" rows="10" data-msg-required="Please enter your message." maxlength="5000">
</textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="submit" data-loading-text="Loading..." class="btn " value="Send"  style="background-color: #4d200e;width:100px; border-radius:0px; color: white;">
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3">
          <p class="head"><strong>CONTACT US:</strong></p>
          <p class="para">Email us:<a href="mailto:<?php echo $websetting['site_email']; ?>"> <?php echo $websetting['site_email']; ?></a><br>
            Call us : <a href="tel:<?php echo $websetting['phone_number']; ?>"><?php echo $websetting['phone_number']; ?></a><br>
            Mobile :<a href="tel:<?php echo $websetting['mobile_number']; ?>"><?php echo $websetting['mobile_number']; ?></a> </p>
          <br>
          <br>
          <p class="head"><strong>CAREERS:</strong></p>
          <p class="para">If you’re interested in employment<br>
            opportunities at <?php echo ucwords($websetting['site_name']); ?>,<br>
            please email us:<a href="mailto:<?php echo $websetting['careers_email']; ?>"> <?php echo $websetting['careers_email']; ?></a> </p>
          <br>
          <div class="social_icon">
            <ul>
              <li class="site-social-icons-facebook"> <a target="_blank" href="<?php echo $websetting['facebook_url']; ?>"> <i class="fa fa-facebook"></i><span>Facebook</span></a> </li>
              <li class="site-social-icons-twitter"> <a target="_blank" href="<?php echo $websetting['twitter_url']; ?>"> <i class="fa fa-twitter"></i><span>Twitter</span></a> </li>
              <li class="site-social-icons-googleplus"> <a target="_blank" href="<?php echo $websetting['google_url']; ?>"> <i class="fa fa-google-plus"  aria-hidden="true"></i><span>Google+</span></a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- end: MAIN CONTAINER -->

<?php $this->load->view('common/footer_content'); 

?>
<script src="<?=base_url('assets/js/custom/contact_us.js');?>"></script>
<script>
jQuery(document).ready(function() {
	Login.init();
});

</script>
<style>
/*put here css of header_content start*/
.paras a{
color:#fff !important;
text-decoration: none;

}
/*put here css of header_content end*/
.extra{
  margin-bottom: 25px;
}
.para{
  font-size: 1.1em; line-height: 1.75em;
}
.para a {
color:#4d200e !important;
font-weight: bold;
text-decoration: none;
}
.head{
   font-size: 1.2em;
}
.social_icon{
  text-align: left;
}
.social_icon ul{
  padding: 0;
  margin:0;
}
.social_icon ul li {
      /* text-decoration: none; */
    display: inline-block;
    margin: 10px;
    font-size: 22px;
}

.social_icon ul li a .fa{
      text-decoration: none;
    color: black;
    /* font-size: 33px; */
    /* display: inline-block; */
    font-family: FontAwesome;
    font-style: normal;
    /* font-weight: normal; */
    /* line-height: 1; */
    -webkit-font-smoothing: antialiased; 
  
}
.social_icon ul li a span{
  display: none;
}
#map{

  border-bottom: solid rgba(119, 85, 85, 0.72);
border-top: solid rgba(119, 85, 85, 0.72);

}
</style>
<!-- start: FOOTER -->
<?php $this->load->view('common/footer'); ?>
