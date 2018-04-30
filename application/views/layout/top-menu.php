<?php $load_message = message(); $post_notify_count = post_notify_count(); ?>
<header>
	<div class="header_top">
		<div class="container">
			<div class="logo_wrap">
				<a href="<?php echo base_url();?>"><img src="<?php echo skin_url(); ?>images/logo.png" alt="logo" /></a>
			</div>   
				<div class="icons_wrap">
					<ul>
						<li><a href="javascript:void(0)" class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
						<li><a  href="<?php echo base_url()."notification"; ?>" class="notify"><i class="fa fa-bell-o" aria-hidden="true"></i><?=(!empty($post_notify_count))?'<span class="badge notification_circle">'.$post_notify_count.'</span>':''?></a></li>
						<li><a href="<?php echo base_url()."conversations"; ?>" class="message"><i class="fa fa-envelope-o" aria-hidden="true"></i><?=(!empty($load_message))?'<span class="badge notification_circle">'.count($load_message).'</span>':''?></a></li>
					</ul>
				</div>
				<?php $CI = & get_instance (); if(get_user_id() == '') { ?>
					<?php if($CI->uri->segment(1) == '' || $CI->uri->segment(1) == 'login' || $CI->uri->segment(1) == 'registration'){ ?>
					<div class="signup_wrap">
						<a href="<?php echo base_url().'registration'; ?>" class="sign_btn">Sign Up</a>
					</div>
					<?php } else { ?>
					<div class="signup_wrap">
						<h3>Signup :</h3>
						<ul>
							<li><a href="<?php echo base_url(); ?>">I'M Business</a></li>
							<li><a href="<?php echo base_url(); ?>">I'M Person</a></li>
						</ul>
					</div>
					<?php } ?>
				<?php } else { ?> 
					<div class="signup_wrap">
						<a href="<?php echo base_url().'myprofile'; ?>" class=""><span class="loggedin_text"><?php echo get_user_name(); ?></span></a> | <a href="<?php echo base_url().'logout'; ?>" class="">Logout</a>
					</div>
				<?php } ?>
				<form class="header_form" action="<?php echo base_url().'search'; ?>">
					<div class="search_box">
                        <input type="text" id="topic_title" name="term" class="ui-autocomplete-input text_search" placeholder="Search topics & blogger" />
                        <input type="submit" class="btn_search" value="" />
					</div>
				</form>
			<div class="clear"></div>
			</div>
			<div class="clear"></div>
	</div>
	<div class="header_menuwrap">
		<div class="container">
		<?php $activesegment = $this->uri->segment(2); ?>
			<ul class="main_menu blog_section">
				<li><a data-section="Fashion" href="<?php echo base_url()."home/fashion"; ?>" <?php if($activesegment=='' || $activesegment=='fashion') { ?> class="active" <?php } ?>>Fashion</a></li>
				<li><a data-section="Travel" href="<?php echo base_url()."home/travel"; ?>" <?php if($activesegment=='travel') { ?> class="active" <?php } ?>>Travel</a></li>
				<li><a data-section="Food" href="<?php echo base_url()."home/food"; ?>" <?php if($activesegment=='food') { ?> class="active" <?php } ?>>Food</a></li>
				<li><a data-section="Tech" href="<?php echo base_url()."home/tech"; ?>" <?php if($activesegment=='tech') { ?> class="active" <?php } ?>>Tech</a></li>
				<li><a data-section="Business" href="<?php echo base_url()."home/business"; ?>" <?php if($activesegment=='business') { ?> class="active" <?php } ?>>Business</a></li>
				<li><a data-section="Health" href="<?php echo base_url()."home/health"; ?>" <?php if($activesegment=='health') { ?> class="active" <?php } ?>>Health</a></li>
				<li><a data-section="life style" href="<?php echo base_url()."home/life-style"; ?>" <?php if($activesegment=='life-style') { ?> class="active" <?php } ?>>Lifestyle</a></li>
				<li><a data-section="Paparazzi" href="<?php echo base_url()."home/paparazzi"; ?>" <?php if($activesegment=='paparazzi') { ?> class="active" <?php } ?>>Paparazzi</a></li>
				<li><a data-section="Others" href="<?php echo base_url()."home/others"; ?>" <?php if($activesegment =='others') { ?> class="active" <?php } ?>>Others</a></li>
			</ul>
			<ul class="main_menu">
				<li><a href="javascript:void(0)">Shop <span style="font-size:9px;">(coming soon)</span></a></li>
			</ul>
			<?php if(get_user_id() != '') { ?>
			<ul class="main_menu">
				<li><a href="javascript:void(0)" class="<?php if($this->uri->segment(1)== 'myprofile' || $this->uri->segment(2) == 'draftpost') { echo "active"; } ?>">My Account</a>
					<ul class="submenu">
						<li><a href="<?php echo base_url().'myprofile'; ?>">My Profile</a></li>
						<li><a href="<?php echo base_url().'home/draftpost'; ?>">Draft Post</a></li>
					</ul>
				</li>
			</ul>
			<?php } ?>
			<?php /*
			<ul class="profile_rgt">
				<li><a href="<?php echo base_url().'myprofile'; ?>">MY Profile</a></li>
			</ul>*/ ?>
			 <div style="position:relative;">
				 <div class="nav_triger">
					<span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
				 </div>
				 <ul class="device_nav blog_section">
					<li><a data-section="Fashion" href="<?php echo base_url()."home/fashion"; ?>" <?php if($activesegment=='' || $activesegment=='fashion') { ?> class="active" <?php } ?>>Fashion</a></li>
					<li><a data-section="Travel" href="<?php echo base_url()."home/travel"; ?>" <?php if($activesegment=='travel') { ?> class="active" <?php } ?>>Travel</a></li>
					<li><a data-section="Food" href="<?php echo base_url()."home/food"; ?>" <?php if($activesegment=='food') { ?> class="active" <?php } ?>>Food</a></li>
					<li><a data-section="Tech" href="<?php echo base_url()."home/tech"; ?>" <?php if($activesegment=='tech') { ?> class="active" <?php } ?>>Tech</a></li>
					<li><a data-section="Business" href="<?php echo base_url()."home/business"; ?>" <?php if($activesegment=='business') { ?> class="active" <?php } ?>>Business</a></li>
					<li><a data-section="Health" href="<?php echo base_url()."home/health"; ?>" <?php if($activesegment=='health') { ?> class="active" <?php } ?>>Health</a></li>
					<li><a data-section="life style" href="<?php echo base_url()."home/life-style"; ?>" <?php if($activesegment=='life-style') { ?> class="active" <?php } ?>>Lifestyle</a></li>
					<li><a data-section="Paparazzi" href="<?php echo base_url()."home/paparazzi"; ?>" <?php if($activesegment=='paparazzi') { ?> class="active" <?php } ?>>Paparazzi</a></li>
					<li><a data-section="Others" href="<?php echo base_url()."home/others"; ?>" <?php if($activesegment =='others') { ?> class="active" <?php } ?>>Others</a></li>
					<li><a href="javascript:void(0)">Shop <span style="font-size:9px;">(coming soon)</span></a></li>
				</ul>
			</div>
		</div>
	</div>
</header>
