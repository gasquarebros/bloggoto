
<header>
    <div class="header_in">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                  <?php  if(get_admin_id() !=""  ) { ?>  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"> <?php } ?>
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="#"><img src="<?php echo load_lib();?>theme/images/logo.png" alt="" /></a>
              </div>
              <?php  if(get_admin_id() !=""   ) { ?>
              <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                <li><a href="<?php echo admin_url()."dashboard"?>"><?php echo get_label('dashboard');?></a></li>            
                <li><a href="<?php echo admin_url()."emailtemplate"?>"> <?php echo get_label('email_template');?></a></li> 
                <li><a href="<?php echo admin_url()."customer"?>"> <?php echo get_label('customer');?></a></li> 
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Modules <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo admin_url()."blogcategories"; ?>"><?php echo get_label('blogcategories');?></a></li>
                      <li><a href="<?php echo admin_url()."categories"; ?>"><?php echo get_label('pro_cate_label');?></a></li>
                      <li> <a href="<?php echo admin_url()."cmspage/";?>" > <?php echo get_label('cmspage');?></a></li>
                      <li> <a href="<?php echo admin_url()."banner/";?>" > <?php echo get_label('banner_label');?></a></li>
                      <li> <a href="<?php echo admin_url()."professions/";?>" > <?php echo get_label('pro_prof_label');?></a></li>
                
                    </ul>
				</li>
        <li><a href="<?php echo admin_url()."posts"?>"> <?php echo get_label('posts');?></a></li> 
				<li><a href="<?php echo admin_url()."reportpost"?>"> <?php echo get_label('report_manage_label');?></a></li> 
				<li><a href="<?php echo admin_url()."products"?>"> <?php echo get_label('product_labels');?></a></li> 
                </ul>
                <ul class="nav navbar-nav navbar-right">
   
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo admin_url()."ncadminpanelhistory"; ?>"><?php echo get_label('top_menu_login_history');?></a></li>
                      <li><a href="<?php echo admin_url()."changepassword"; ?>"><?php echo get_label('top_menu_change_pass');?></a></li>
                      <li> <a href="<?php echo admin_url()."admin_logout/";?>" > <?php echo get_label('top_menu_logout');?></a></li>
                
                    </ul>
                  </li>
                </ul>
              </div> <?php } ?><!--/.nav-collapse -->
            </div>
          </nav>
        </div>
</header>

