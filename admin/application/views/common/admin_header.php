<?php
 $notification_result = get_notification();
?>

<header id="header">
  <nav class="navbar navbar-default nopadding" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <button type="button" id="menu-open" class="navbar-toggle menu-toggler pull-left"> <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#" id="logo-panel"> <img src="<?php echo $this->config->item('site_url') ?>assets/img/logo.png" alt="<?php echo $this->config->item('site_name'); ?>" style="height:35px;"> </a> </div>
    <form action="#" class="form-search-mobile pull-right">
      <input id="search-fld" class="search-mobile" type="text" name="param" placeholder="Search ...">
      <button id="submit-search-mobile" type="submit"> <i class="fa fa-search"></i> </button>
      <a href="#" id="cancel-search-mobile" title="Cancel Search"><i class="fa fa-times"></i></a>
    </form>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li id="search-show-li" class="dropdown"> <a href="#" id="search-mobile-show" class="dropdown-toggle" > <i class="fa fa-search"></i> </a> </li>
        
        <!-- notification -->
        <li class="dropdown yep-dropdown-notify">
								<a href="javascript:void(0);" class="dropdown-toggle" >
									<i class="fa fa-bell-o"></i>
									<span class="label"><?php if(!empty($notification_result)) { echo count($notification_result); }else{ echo '0'; } ?></span>
								</a>
								<ul class="dropdown-menu yep-notify">
									<li>
										<div class="btn-group btn-group-justified yep-btn-group-notify">
											<a href="#msgs" class="btn btn-default active">Msgs (<?php if(!empty($notification_result)) { echo count($notification_result); }else{ echo '0'; } ?>)</a>
											<!--<a href="#notify" class="btn btn-default">notify (3)</a>-->
											
										</div>
										<div class="tab-content yep-notify-content" >
											<div class="tab-pane active thin-scroll" id="msgs">
												
												<ul class="notify-content-body ">
                                                
                                                <?php if($notification_result){
													   foreach($notification_result as $key){
														  // dd($key);
													 ?>
													<li>
														<span class="unread">
															<a href="javascript:void(0);" onClick="notifiction_read('<?php echo $key['id']; ?>','<?php echo $this->config->item('site_url') ?><?php echo $key['backend_url']; ?>');" class="msg" >
																<img src="<?php echo $this->config->item('site_url') ?>assets/img/avatars/female.png" alt="" class="item item-top-left" >
																<span class="from"><?php echo ucwords($key['sender_name']); ?>  <i class="icon-paperclip"></i></span>
																<span class="time"><?php echo ago($key['create_dt']); ?>&nbsp;&nbsp;</span>
																<span class="subject"><?php echo ucwords($key['title']); ?></span>
																<span class="msg-body"><?php echo $key['message']; ?></span>
															</a>
														</span>
													</li>
												<?php } 
												} ?>
													
													
												</ul>
											</div>
                                            
                                            
											<div class="tab-pane" id="notify">
												<ul class="notify-content-body ">
													<li>
														<span class="padding-10 unread">
															<em class="badge img-notify">
															<i class="fa fa-user fa-fw fa-2x"></i>
															</em>
															
															<span>
																2 new users just signed up! <span class="text-primary">martin.luther</span> and <span class="text-primary">kevin.reliey</span>
																
																<span class="pull-right font-xs text-muted"><i>1 min ago...</i></span>
															</span>
														</span>
													</li>
													<li>
														<span class="padding-10">
															<em class="badge img-notify">
															<i class="fa fa-check fa-fw fa-2x"></i>
															</em>
															
															<span>
																2 projects were completed on time! Submitted for your approval - <a href="javascript:void(0);" class="display-normal">Click here</a>
																
																<span class="pull-right font-xs text-muted"><i>1 day ago...</i></span>
															</span>
															
														</span>
													</li>
													<li>
														<span class="padding-10 unread">
															<em class="badge img-notify">
															<i class="fa fa-user fa-fw fa-2x"></i>
															</em>
															
															<span>
																2 new users just signed up! <span class="text-primary">martin.luther</span> and <span class="text-primary">kevin.reliey</span>
																
																<span class="pull-right font-xs text-muted"><i>1 min ago...</i></span>
															</span>
														</span>
													</li>
													<li>
														<span class="padding-10">
															<em class="badge img-notify">
															<i class="fa fa-lock fa-fw fa-2x"></i>
															</em>
															
															<span>
																Your password was recently updated. Please complete your security questions from your profile page.
																
																<span class="pull-right font-xs text-muted"><i>2 weeks ago...</i></span>
															</span>
														</span>
													</li>
													<li>
														<span class="padding-10">
															<em class="badge img-notify">
															<i class="fa fa-user fa-fw fa-2x"></i>
															</em>
															
															<span>
																<a href="javascript:void(0);" class="display-normal">Sofia</a> as contact? &nbsp;
																<button class="btn btn-xs btn-primary margin-top-5">accept</button>
																<button class="btn btn-xs btn-danger margin-top-5">reject</button>
																<span class="pull-right font-xs text-muted"><i>3 hrs ago...</i></span>
															</span>
														</span>
													</li>
												</ul>
											</div>
											
										</div>
										<span> 
										</span>
									</li>
								</ul>
							</li>
        <!-- end notification -->
        
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img alt="Golabi Avatar Admin" src="<?php echo $this->config->item('site_url') ?>assets/img/avatars/avatar.png" height="50" width="50" class="img-circle" /> <?php echo ucwords($this->session->userdata('name')); ?> <strong class="caret"></strong> </a>
          <ul class="dropdown-menu">
            <li> <a href="<?php echo base_url('user/editUser/'.safe_b64encode($this->session->userdata('user_id'))); ?>">Profile<span class="fa fa-user pull-right"></span></a> </li>
            <li class="divider"> </li>
            <li> <a href="<?php echo base_url('Login/logout'); ?>">Sign out<span class="fa fa-power-off pull-right"></span></a> </li>
          </ul>
        </li>
        
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id="fullscreen-li"> <a href="#" id="fullscreen" class="dropdown-toggle" > <i class="fa fa-arrows-alt"></i> </a> </li>
        <li id="side-hide-li" class="dropdown"> <a href="#" id="side-hide" class="dropdown-toggle" > <i class="fa fa-reorder"></i> </a> </li>
      </ul>
    </div>
  </nav>
</header>
