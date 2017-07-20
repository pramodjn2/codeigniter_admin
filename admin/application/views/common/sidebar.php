
<div id="sidebar" class="sidebar" >
  <div class="tabbable-panel">
    <div class="tabbable-line">
      <ul class="nav nav-tabs nav-justified">
        <li id="tab_menu_a" class="active pull-left"> <a href="#tab_menu_1" data-toggle="tab"> <i class="fa fa-reorder"></i> </a> </li>
      </ul>
      <?php $class = strtolower($this->router->fetch_class());
			$method = strtolower($this->router->fetch_method());
							
							 function inarray($array, $str){
							  if (in_array($str, $array)) {
									return true;
								}
								return false;
							 }
				 
							 ?>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_menu_1"> 
          <!-- sidebar Menu -->
          <div id="MainMenu" class="">
            <ul id="menu-list" class="nav nav-list">
              <li class="separate-menu"><span>Main Menu</span></li>
              <li class="<?php if($class == 'dashboard'){ echo 'active open'; } ?>"> <a href="<?php echo base_url('Dashboard'); ?>"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text"> Dashboard </span> </a> <b class="arrow"></b> </li>
              <li class="<?php if($class == 'user'){ echo 'active open'; } ?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-user"></i> <span class="menu-text"> Manage User</span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
                <ul class="submenu"  >
                  <?php
                                               $mclass = array("role", "editrole");
			                                   $rdata = inarray($mclass, $method); 
                                               ?>
                  <li class="<?php if($rdata){ echo 'active'; } ?>"> <a href="<?php echo base_url('User/role'); ?>" > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">User Role</span> </a> <b class="arrow"></b> </li>
                  <li > <a href="<?php echo base_url('User'); ?>"> <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">User</span> </a> <b class="arrow"></b> </li>
                </ul>
              </li>
                <li class="<?php if($class == 'activity'){ echo 'active'; } ?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-desktop"></i> <span class="menu-text"> Manage Activity </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
                    <ul class="submenu nav-show"  >
                        <li class=""> <a href="<?php echo base_url('Poll'); ?>" > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Poll</span> </a> <b class="arrow"></b> </li>
                        <li > <a href="<?php echo base_url('Quiz'); ?>"> <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Article Quiz</span> </a> <b class="arrow"></b> </li>
                    </ul>
                </li>
              <li class="">
              <li class="<?php if($class == 'article'){ echo 'active open'; } ?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-rss"></i> <span class="menu-text"> Manage Article </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
                <ul class="submenu nav-show"  >
                  <li class=""> <a href="<?php echo base_url('article/category'); ?>" > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Article Category</span> </a> <b class="arrow"></b> </li>
                  <li class=""> <a href="<?php echo base_url('Article'); ?>" > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Article</span> </a> <b class="arrow"></b> </li>
                </ul>
              </li>
              <li class="<?php if($class == 'websetting'){ echo 'active open'; } ?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-cogs"></i> <span class="menu-text"> Manage Configration </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
                <ul class="submenu nav-show"  >
                  <li class=""> <a href="<?php echo base_url('websetting'); ?> " > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Web Setting</span> </a> <b class="arrow"></b> </li>
                   <li class=""> <a href="<?php echo base_url('websetting/template'); ?> " > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Mail Template</span> </a> <b class="arrow"></b> </li>
                </ul>
              </li>
              

              <li class="<?php if($class == 'staticpages'){ echo 'active open'; } ?>"> <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-file-text"></i> <span class="menu-text"> Manage content </span> <b class="arrow fa fa-angle-down"></b> </a> <b class="arrow"></b>
                <ul class="submenu nav-show"  >
                  <li class=""> <a href="<?php echo base_url('staticPages'); ?> " > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Pages</span> </a> <b class="arrow"></b> </li>
                  <li class=""> <a href="<?php echo base_url('staticPages/menu'); ?> " > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Menu Magement</span> </a> <b class="arrow"></b> </li>
                   <li class=""> <a href="<?php echo base_url('staticPages/slider'); ?> " > <i class="menu-icon fa fa-caret-right"></i> <span class="menu-text">Carousel Slider</span> </a> <b class="arrow"></b> </li>
                </ul>
              </li>
              
              
              
              
              
            </ul>
            <a class="sidebar-collapse" id="sidebar-collapse" data-toggle="collapse" data-target="#test"> <i id="icon-sw-s-b" class="fa fa-angle-double-left"></i> </a> </div>
        </div>
      </div>
      <!-- end tab-content--> 
      
    </div>
    <!-- end tabbable-line --> 
  </div>
  <!-- end tabbable-panel --> 
</div>
