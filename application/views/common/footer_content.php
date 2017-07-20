<?php $websetting = $this->session->userdata('websetting'); ?>

<footer class="footer-wrap dark-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-12 em-footer-logo"> <a href="<?php echo base_url(); ?>"> <img class="img-responsive" src="<?php echo base_url('assets/images/header-logo.png'); ?>" alt="Footer Logo"> </a> </div>
      <div class="col-md-10 col-sm-10 col-xs-12 em-footer-content-wrap no-padding">
        <div class="footer-top clearfix">
          <div class="col-md-8 col-sm-8 col-xs-12 em-footer-navbar">
            <?php $menu_result = menu(3); 
							//dd($menu_result);?>
            <div class="footer-top-navbar">
              <nav class="navbar navbar-default no-padding">
                <div class="container-fluid">
                  <ul class="nav navbar-nav">
                    <?php  if(!empty($menu_result)){
												$i = 1;
												foreach($menu_result as $val){ 
												if($i < 6){
												$page_slug = $val['page_slug'];
												$id = safe_b64encode($val['id']);
												?>
                    <li><a href="<?php echo base_url('pages/content/'.$id.'/'.$page_slug); ?>"><?php echo ucwords($val['page_title']); ?></a></li>
                    <?php }
					   $i++; 
					   } 
					  } ?>
                  </ul>
                </div>
              </nav>
            </div>
            <div class="footer-bottom-navbar">
              <nav class="navbar navbar-default no-padding">
                <div class="container-fluid">
                  <ul class="nav navbar-nav">
                    <?php  if(!empty($menu_result)){
												$i = 1;
												foreach($menu_result as $val){ 
												if($i > 6){
												$page_slug = $val['page_slug'];
												$id = safe_b64encode($val['id']);
												?>
                    <li><a href="<?php echo base_url('pages/content/'.$id.'/'.$page_slug); ?>"><?php echo ucwords($val['page_title']); ?></a></li>
                    <?php }
						$i++; 
						} 
					 } ?>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 em-footer-btnbar">
            <div class="footer-btn pull-right">
              <ul>
                <li> <a class="em-grey-btn modalButton" data-toggle="modal" data-target="#myModal" href="#">Get Started</a> </li>
                <li><a class="em-primary-btn" href="#">Enquiry</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-bottom clearfix">
          <div class="col-md-5 col-sm-5 col-xs-4 em-footer-copyright">
            <div class="copyright"> <a href="#"><?php echo $websetting['site_copyright']; ?></a> </div>
          </div>
          <div class="col-md-7 col-sm-7 col-xs-8 em-footer-socail">
            <div class="footer-btn footer-socail text-right">
              <ul class="pull-right">
                <li><a href="<?php echo $websetting['twitter_url']; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $websetting['linkedIn_url']; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $websetting['facebook_url']; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $websetting['google_url']; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $websetting['youtube_url']; ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php $this->load->view('common/login_model'); ?>

<!-- Related JavaScript Library to This Pagee -->
<?php 
        	if(isset($javascript) && !empty($javascript)){
				$i=0;
				foreach($javascript as $value){$i++;
					$tab = ($i!=1)?"\t\t ":"";
					echo $tab.'<script src="'.base_url().$value.'" type="text/javascript"></script>'."\n";
				}
			}
			if(isset($script) && !empty($script)){
				foreach($script as $value){
					echo $value;
				}
			}
		?>

<!-- End Related JavaScript Library to This Pagee --> 
<script>
		
		$(function() { 

			$('a[href="#toggle-search"], .navbar-bootsnipp .bootsnipp-search .input-group-btn > .btn[type="reset"]').on('click', function(event) {
				event.preventDefault();
				$('.navbar-bootsnipp .bootsnipp-search .input-group > input').val('');
				$('.navbar-bootsnipp .bootsnipp-search').toggleClass('open');
				$('a[href="#toggle-search"]').closest('li').toggleClass('active');

				if ($('.navbar-bootsnipp .bootsnipp-search').hasClass('open')) {
					/* I think .focus dosen't like css animations, set timeout to make sure input gets focus */
					setTimeout(function() { 
						$('.navbar-bootsnipp .bootsnipp-search .form-control').focus();
					}, 100);
				}			
			});

			$(document).on('keyup', function(event) {
				if (event.which == 27 && $('.navbar-bootsnipp .bootsnipp-search').hasClass('open')) {
					$('a[href="#toggle-search"]').trigger('click');
				}
			});

		});

	</script> 
