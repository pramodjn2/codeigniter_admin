<?php $user_id = $this->session->userdata('user_id'); 
$logged_in = $this->session->userdata('logged_in');
if($logged_in){
	$fullName = $logged_in['fullName'];
}

?>
    
    <header class="site-header">
			<div class="top-header-wrap dark-bg">              
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12 top-nav-wrap no-padding">						
							<nav class="navbar navbar-inverse">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar" aria-expanded="false" aria-controls="navbar">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
                                 <?php $menu_result = menu(1); ?>
								<div id="top-navbar" class="collapse navbar-collapse">
									<ul class="nav navbar-nav">                    
										<li class="active"><a href="<?php echo base_url(); ?>">HOME</a></li>
									
                                        
                                         <?php  if(!empty($menu_result)){
												$i = 1;
												foreach($menu_result as $val){ 
												$page_slug = $val['page_slug'];
												$id = safe_b64encode($val['id']);
												?>
                    <li><a href="<?php echo base_url('pages/content/'.$id.'/'.$page_slug); ?>"><?php echo strtoupper ($val['page_title']); ?></a></li>
                    <?php }
					   $i++; 
					
					  } ?>
                      
									</ul>
								</div><!--/.nav-collapse -->
							</nav>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 headertop-right-wrap">
							<div class="headertop-right-block">
								<ul class="pull-right">                    
									<li class="share-news-btn"><a class="em-grey-btn" href="#">Share News</a></li>
									<li class="em-like"><a href="#"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
									<li class="login-reg-btn">
                                    <?php if(empty($user_id)){ ?>
                                    <a class="em-premery-color modalButton" href="javascript:void(0);" onClick="tabChange('myModal');">LOGIN</a>
                                    <a class="em-premery-color modalButton" href="javascript:void(0);" onClick="tabChange('myModal2');">REGISTER</a>
                                    
                   
                                    
                                    <?php }else{ ?>
                                     <a class="em-premery-color modalButton" ><?php echo ucwords($fullName); ?></a>
                                     <a class="em-premery-color modalButton" href="<?php echo base_url('login/logout'); ?>">Logout</a>
                                    <?php } ?>
                                    </li>
								</ul>
							</div><!--/.headertop-right-block -->	
						</div>
					</div>
				</div>
			</div><!--/.top-header-wrap -->

			<div class="header-wrap primary-color-bg">              
				<div class="container">
					<div class="row">

						<nav class="navbar navbar-bootsnipp animate em-header-navbar" role="navigation">
							<div class="container">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<div class="animbrand">
										<a class="navbar-brand animate" href="<?php echo base_url(); ?>"><img class="img-responsive" src="<?php echo base_url('assets/images/header-logo.png'); ?>"></a>
									</div>
								</div>

								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav navbar-right">
										<li><a href="#">FREATURED</a></li>
										<li><a href="#">EXPLORE</a></li>
										<li><a href="#">BUZZ</a></li>
										<li><a href="#">CONNECT</a></li>
										<li class="hidden-xs"><a href="#toggle-search" class="animate"><span class="glyphicon glyphicon-search"></span></a></li>
									</ul>
								</div>
							</div>
							<div class="bootsnipp-search animate">
								<div class="container">
									<form action="search" method="GET" role="search">
										<div class="input-group">
											<input type="text" class="form-control" name="q" placeholder="Search for snippets and hit enter">
											<span class="input-group-btn">
												<button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span></button>
											</span>
										</div>
									</form>
								</div>
							</div>
						</nav> 

					</div>
				</div>
			</div><!--/.top-header-wrap -->

			



		</header>