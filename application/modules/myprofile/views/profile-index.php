<script>
var module = "home";
var module_action="addpost";
</script>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/profile.js"></script>
<section>
    <div class="container">
        <h2 class="main_heading">Magazines</h2>
        <div class="profile_wrap">
            <div class="profile_photo_wrap">
                <div class="pro_pic">
					<?php if($info['customer_photo'] !='') { ?>
					<img src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$info['customer_photo'];?>" alt="profile" />
					<?php } else { ?> 
                    <img src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
					<?php } ?>
                </div>
                <div class="prof_dest">
                    <h4><?php echo ($info['customer_type'] == '0')?$info['customer_first_name']." ".$info['customer_last_name']:$info['company_name']; ?></h4>
					<?php if($info['customer_prof_profession'] !='') { $prof = explode(',',$info['customer_prof_profession']);   ?>
						<ul>
							<?php foreach($prof as $profs) { if(trim($profs) !='') { ?>
								<li><a href="javascript:void(0)"><?php echo ucfirst($profs); ?></a></li>
							<?php } } ?>
						</ul>
					<?php } ?>
                </div>
            </div>
            <div class="profile_active_details">
                <div class="followers">
                    <ul>
                        <li><a class="follow_popup " data-pop-type="following" data-target="follow_modal" href="<?php echo base_url().'myprofile/get_followers_profile/'.encode_value($info['customer_id']); ?>">
                            <span class="following_count"><?php echo thousandsCurrencyFormat($follow_count); ?></span><span>Followers</span></a>
                        </li>
						<li><a class="follow_popup " data-pop-type="follow"  data-target="follow_modal"   href="<?php echo base_url().'myprofile/get_following_profile/'.encode_value($info['customer_id']); ?>">
                            <span class="follow_count"><?php echo thousandsCurrencyFormat($following_count); ?></span><span>Following</span></a>
                        </li>
						<?php if(!empty($post_infos)) { 
							foreach($post_infos as $postinfo){ ?> 
								<li>
									<?php echo thousandsCurrencyFormat($postinfo['postcount']); ?><span><?php echo ucfirst((get_label($postinfo['post_type']))?get_label($postinfo['post_type']):$postinfo['post_type']); ?></span>
								</li>
						<?php }
						} ?> 
                    </ul>
                </div>
				<?php if($info['customer_id'] != get_user_id()) { ?>
					<div class="fllow_bns">
						<?php if(in_array($info['customer_id'],$follow_list)) { ?>  
							<a href="<?php echo base_url()."myprofile/add_followers/".encode_value($info['customer_id']); ?>" class="btn btn_blue follow_users">Unfollow</a>
						<?php } else { ?> 
							<a href="<?php echo base_url()."myprofile/add_followers/".encode_value($info['customer_id']); ?>" class="btn btn_blue follow_users">Follow</a>
						<?php } ?>
						<a href="<?php echo base_url()."conversations/new_message/".encode_value($info['customer_id']); ?>" class="btn bt_green message_users">Message</a>
					</div>
				<?php } else { $url_social_own = base_url().urlencode($info['customer_username']); ?> 
					<div class="profile_social_share fllow_bns">
						<ul>
							<li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $url_social_own; ?>&title=<?php echo urlencode($info['customer_username']); ?>" class="fb_social_share"><i class="fa fa-facebook-square"></i></a></li>	
							<li><a target="_blank" href="http://twitter.com/share?text=<?php echo urlencode($info['customer_username']); ?>&url=<?php echo $url_social_own; ?>" class="fb_social_share"><i class="fa fa-twitter-square"></i></a></li>	
							<li><a target="_blank" href="https://plus.google.com/share?url=<?php echo $url_social_own; ?>" class="fb_social_share"><i class="fa fa-google-plus-square"></i></a></li>	
						</ul>
					</div>
				<?php } ?>
                <div class="foll_desc">
					<?php if($info['customer_notes']) { ?>
						<p><?php echo $info['customer_notes']; ?></p>
					<?php } ?>
                    <?php /* <h6 class="active_status"><i class="fa fa-clock-o" aria-hidden="true"></i> One Hour Ago</h6> */ ?>
                </div>
                <div class="follow_request">
                    <?php if(!empty($suggestions) && $info['customer_id'] == get_user_id()) { ?>
						<h3 class="suggestion_bloggotians">Suggested Bloggotians</h3>
						<ul>
							<?php foreach($suggestions as $suggestion) { //echo "<pre>"; print_r($suggestion); exit; ?>
								<li>
									<div class="lft_img_fllw">
									<a href="<?php echo base_url().urlencode($suggestion['customer_username']); ?>" target="_blank" >
										<?php if($suggestion['customer_photo'] !='') { ?>
											<img src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$suggestion['customer_photo'];?>" alt="profile" />
										<?php } else { ?> 
											<img src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
										<?php } ?>
									</a>	
									</div>
									<div class="rgt_txt_fllw">
										<p><a href="<?php echo base_url().urlencode($suggestion['customer_username']); ?>" target="_blank" ><?php echo ($suggestion['customer_type'] == '0')?$suggestion['customer_first_name']." ".$suggestion['customer_last_name']:$suggestion['company_name']; ?></a></p>
										<a href="<?php echo base_url()."myprofile/add_followers/".encode_value($suggestion['customer_id']); ?>" class="follow follow_users follow_users_suggestions">Follow</a>
									</div>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
                </div>
            </div>
        </div>

		<div class="newsfeed_wrap">
			<ul class="newsfeed_menu">
				
				<li><a data-section="blogs" href="<?php echo base_url()."myprofile/viewblogs/".encode_value($info['customer_id']); ?>" class="active profile_section">BLOGS / STORIES</a></li>
				<li><a data-section="pictures" href="<?php echo base_url()."myprofile/viewblogs/".encode_value($info['customer_id']); ?>" class="profile_section">Gallery</a></li>
				<li><a data-section="tags" href="<?php echo base_url()."myprofile/viewtags/".encode_value($info['customer_id']); ?>" class="profile_section">TAGS</a></li>
				<?php if($info['customer_id'] == get_user_id()) { ?>
					<li><a data-section="bio" href="<?php echo base_url()."myprofile/viewbio"; ?>" class="profile_section">Profile</a></li>
				<?php } else { ?> 
					<li><a data-section="bio" href="<?php echo base_url()."myprofile/viewbio/".encode_value($info['customer_id']); ?>" class=" profile_section">Profile</a></li>
				<?php } ?>
			</ul>
			<div class="boi_data">
			
			</div>
		</div>
    </div>
	


<div id="test-modal" class="white-popup-block mfp-hide">
	<div class="popup_header">
        <h4>Write your post</h4>
    </div>
	<div class="popup_body">
        <?php echo form_open_multipart(base_url().'home/add',' class="form-horizontal" id="common_form" ' );?>
			<div class="cate_wrap">
			<div class="cat_list">
				<h5>Choose your category</h5>
				<input type="hidden" id="post_category" name="post_category" value="Fashion" />
				<ul class="post_category_selection">
					<li><a data-section="Fashion" href="javascript:void(0)" class="active">Fashion</a></li>
					<li><a data-section="Travel" href="javascript:void(0)" >Travel</a></li>
					<li><a data-section="Food" href="javascript:void(0)" >Food</a></li>
					<li><a data-section="Tech" href="javascript:void(0)" >Tech</a></li>
					<li><a data-section="Business" href="javascript:void(0)" >Business</a></li>
					<li><a data-section="Health" href="javascript:void(0)" >Health</a></li>
					<li><a data-section="life style" href="javascript:void(0)" >Lifestyle</a></li>
					<li><a data-section="Paparazzi" href="javascript:void(0)" >Paparazzi</a></li>
					<li><a data-section="Others" href="javascript:void(0)" >Others</a></li>
				</ul>
			</div>
			<div class="cat_list">
				<h5>Choose what you post</h5>
				<input type="hidden" id="post_type" name="post_type" value="blog" />
				<ul class="post_type_selection">
					<li><a data-type="blog" href="javascript:void(0)" class="active">Blogs</a></li>
					<li><a data-type="picture" href="javascript:void(0)">Pictures</a></li>
					<li><a data-type="video" href="javascript:void(0)">Videos</a></li>
					<li><a data-type="story" href="javascript:void(0)">Stories</a></li>
					<li><a data-type="book" href="javascript:void(0)">Books</a></li>
					<li><a data-type="qa" href="javascript:void(0)">Q & A</a></li>
					<?php /*<li><a data-type="must_see" href="javascript:void(0)">Must See</a></li>*/ ?>
				</ul>
			</div>
			</div>
			<div class="cat_list_form">
				
					<div class="form_field">
						<?php  echo form_input('post_title',set_value('post_title'),' class="form-control required"  placeholder="Title" id="post_title" ');?>
					</div>
					<div class="form_field">
						<textarea name="post_description" placeholder="Description"></textarea>
					</div>
					<div class="form_field tagging_section">
						<?php 
							$followers_lst = get_followers_list(); 
							if(!empty($followers_lst)) {
								foreach($followers_lst as $foll_list)
								{
									if($foll_list['customer_type'] == 0)
									{
										$followers[encode_value($foll_list['follow_user_id'])."__".$foll_list['customer_first_name']." ".$foll_list['customer_last_name']] = $foll_list['customer_first_name']." ".$foll_list['customer_last_name']; 	
									}
									else
									{
										$followers[encode_value($foll_list['follow_user_id'])."__".$foll_list['company_name']] = $foll_list['company_name']; 
									}	
								}
							}
						?>
						<?php  echo form_dropdown('post_tags[]',$followers,'',' class="form-control"  placeholder="Tag Bloggotians" title="Tag Bloggotians" id="post_tags" style="width:100%"');?>
					</div>
					<div class="form_field video_section" style="display:none;">
						<div class="left_fm_field">
							<input type="file" name="post_video" placeholder="Video"  id="post_video" class=""  />
						</div>
					</div>
					<div class="form_field">
						<div class="left_fm_field">
							<input type="file" name="post_photo" placeholder="Image"  id="post_photo" class=""  />
						</div>
						<div class="rgt_fm_field btn_submit_div">
							<input type="hidden" name="status" id="status" value="" />
							<input type="button" value="Sava as draft" class="grey_btn draft_post">
							<input type="submit" value="Publish">
						</div>
						<div class="clear"></div>
					</div>
				
			</div>
		<?php
		echo form_hidden ( 'action', 'Add' );
		echo form_close ();
		?>
    </div>
	<p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
</div>	
	<a id="follow_modal_div" class="popup-modal" href="#follow_modal" ></a>
</section>
<script>
$(window).load(function() {
	get_profile_section();
});

$('#blog_post_title').blur(function() { 
	var blog_text = $('#blog_post_title').val();
	$('#post_title').val(blog_text);
});

$('.draft_post').click(function() {
	$('#status').val('D');
	$('#common_form').submit();
});


$('.post_category_selection li a').click(function(){
	
	$('.post_category_selection li a').removeClass('active');
	$(this).addClass('active');
	var current_val = $(this).data('section');
	$('#post_category').val(current_val);
});
$('.post_type_selection li a').click(function(){
	var current_val = $(this).data('type');
	$('.post_type_selection li a').removeClass('active');
	$(this).addClass('active');
	$('#post_type').val(current_val);
	$('.video_section').hide();
	if(current_val == 'video')
	{
		$('.video_section').show();
	}
});
</script>