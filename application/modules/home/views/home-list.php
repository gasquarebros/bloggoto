<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/ckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/_samples/sample.js"></script>-->
<script>
var module_action="addpost";
</script>
<section>
    <div class="container">
        <h2 class="main_heading">Magazines</h2>
		<?php $activesegment = $this->uri->segment(2); ?>
		<ul class="category_menu blog_section inner_section">
			<li><a data-section="" style="background: #65121A !important;" href="<?php echo base_url()."wall"; ?>" <?php if($activesegment=='' || $activesegment=="wall") { ?> class="active" <?php } ?>>Your Feed</a></li>	
			<li><a data-section="General" href="<?php echo base_url()."home/general"; ?>" <?php if($activesegment=='general') { ?> class="active" <?php } ?>>General</a></li>	
			<li><a data-section="Fashion" href="<?php echo base_url()."home/fashion"; ?>" <?php if($activesegment=='' || $activesegment=='fashion') { ?> class="active" <?php } ?>>Fashion</a></li>
			<li><a data-section="Travel" href="<?php echo base_url()."home/travel"; ?>" <?php if($activesegment=='travel') { ?> class="active" <?php } ?>>Travel</a></li>
			<li><a data-section="Food" href="<?php echo base_url()."home/food"; ?>" <?php if($activesegment=='food') { ?> class="active" <?php } ?>>Food</a></li>
			<li><a data-section="Tech" href="<?php echo base_url()."home/tech"; ?>" <?php if($activesegment=='tech') { ?> class="active" <?php } ?>>Tech</a></li>
			<li><a data-section="Business" href="<?php echo base_url()."home/business"; ?>" <?php if($activesegment=='business') { ?> class="active" <?php } ?>>Business</a></li>
			<li><a data-section="Health" href="<?php echo base_url()."home/health"; ?>" <?php if($activesegment=='health') { ?> class="active" <?php } ?>>Health</a></li>
			<li><a data-section="life style" href="<?php echo base_url()."home/life-style"; ?>" <?php if($activesegment=='life-style') { ?> class="active" <?php } ?>>Lifestyle</a></li>
			<li><a data-section="Entertainment" href="<?php echo base_url()."home/entertainment"; ?>" <?php if($activesegment=='entertainment') { ?> class="active" <?php } ?>>Entertainment</a></li>
			<li><a data-section="Others" href="<?php echo base_url()."home/others"; ?>" <?php if($activesegment =='others') { ?> class="active" <?php } ?>>Others</a></li>
		</ul>

        <div class="section_menu more_menu">
            <ul class="category_menu blog_category innser_section_bottom">
                <li><a data-type="blog" href="javascript:void(0)" class="active">Blogs</a></li>
                <li><a data-type="picture" href="javascript:void(0)">Pictures</a></li>
                <li><a data-type="video" href="javascript:void(0)">Videos</a></li>
                <li><a data-type="story" href="javascript:void(0)">Stories</a></li>
                <li><a data-type="book" href="javascript:void(0)">Books</a></li>
                <li><a data-type="qa" href="javascript:void(0)">Review</a></li>
                <?php /*<li><a data-type="must_see" href="javascript:void(0)">Must See</a></li>*/ ?>
            </ul>
            <?php /* <a href="javascript:void(0)" class="more_items"><i class="fa fa-angle-double-down" aria-hidden="true"></i></a>*/ ?>
		</div>
		<?php /*
        <div class="comment_section">
            <div class="cmt_img">
				<?php if($this->session->userdata('customer_username')) {
					$loggin_url = base_url().$this->session->userdata('customer_username');
				} else { 
					$loggin_url = "javascript:void(0)";
				} ?>
                <a href="<?php echo $loggin_url; ?>" class="img_lft">
				<?php if($this->session->userdata('bg_user_profile_picture')) { ?>
					<img style="width:50px" class="img-circle" src="<?php echo $this->session->userdata('bg_user_profile_picture'); ?>" alt="man" />
				<?php } else {?>
                    <img src="<?php echo skin_url(); ?>images/man.png" alt="man" />
				<?php } ?>	
                </a>
                <h4><?php if(get_user_id() == '') { echo "Hi Guest"; } else { echo "Hi ".get_user_name().","; } ?></h4>
            </div>
            <div class="cmt_form">
                <form>
                    <div class="form_field">
                        <input type="text" id="blog_post_title" placeholder="<?php echo get_label('placeholder_post_title');?>">
                    </div>
                    <div class="action_field">
                        <a  <?php if(get_user_id() == '') { ?> class="popup-modals" href="<?php echo base_url(); ?>" <?php } else { ?> class="popup-modal" href="#test-modal" <?php } ?> value="">Let's Go</a>
                    </div>
                </form>
            </div>
		</div>
		*/ ?>
		<div class="comment_section">
			<div class="cmt_img">
				<?php if($this->session->userdata('customer_username')) {
					$loggin_url = base_url().$this->session->userdata('customer_username');
				} else { 
					$loggin_url = "javascript:void(0)";
				} ?>
                <a href="<?php echo $loggin_url; ?>" class="img_lft">
				<?php if($this->session->userdata('bg_user_profile_picture')) { ?>
					<img style="width:50px" class="img-circle" src="<?php echo $this->session->userdata('bg_user_profile_picture'); ?>" alt="man" />
				<?php } else {?>
                    <img src="<?php echo skin_url(); ?>images/man.png" alt="man" />
				<?php } ?>	
                </a>
                <h4><?php if(get_user_id() == '') { echo "Hi Guest"; } else { echo "Hi ".get_user_name().","; } ?></h4>
			</div>
			<div class="cmt_form">
				<form>
                    <div class="action_field service_action_section">
						<a  <?php if(get_user_id() == '') { ?> class="popup-modals available_service_action" href="<?php echo base_url(); ?>" <?php } else { ?> class="popup-modal available_service_action" href="#test-modal" <?php } ?>><img class="available_section" src="<?php echo skin_url().'images/post_wall.png'; ?>"><span>Post</span></a>
						<a  <?php if(get_user_id() == '') { ?> class="mrgt available_service_action" href="<?php echo base_url(); ?>" <?php } else { ?> class="mrgt available_service_action" href="<?php echo base_url().'manageproducts/add'; ?>" <?php } ?>><img class="available_section" src="<?php echo skin_url().'images/sell_products.png'; ?>"><span>Sell Products</span></a>
						<a  <?php if(get_user_id() == '') { ?> class="mrgt available_service_action" href="<?php echo base_url(); ?>" <?php } else { ?> class="mrgt available_service_action" href="<?php echo base_url().'manageservices/add'; ?>" <?php } ?>><img class="available_section" src="<?php echo skin_url().'images/host_services.png'; ?>"><span>Host Services</span></a>
                    </div>
                </form>
			</div>
		</div>
        <div class="sort_by">
            <?php echo form_open('',' id="common_search" class="form-inline"');?>
                <div class="form_field">
					<?php 
					echo form_dropdown('search_field',$post_category,'','style="width:100%" id="search_category"'); ?>
                </div>
                <div class="form_field">
                <?php 
				$sort_method = array(''=>'All','top_blog'=>'Top Blog','followers'=>'Followers Only');
					echo form_dropdown('order_field',$sort_method,'','style="width:100%" id="order_field"'); ?>
                </div>
				<input type="hidden" name="page_id" id="page_id" value="" />	
				<input type="hidden" name="offset" id="load_offset" value="" />	
            <?php echo form_close(); ?>    
        </div>
        <div class="listing_wrap cntloading_wrapper ">
			<div class="append_html"></div>
			<?php echo loading_image('cnt_loading');?>
        </div>
		<div class="load_more" style="display:none;">
			<button class="more_posts">Load More</button>
		</div>
    </div>
</section>



<div id="test-modal" class="white-popup-block mfp-hide">
	<div class="popup_header">
        <h4>Write your post</h4>
    </div>
	<div class="popup_body">
        <?php echo form_open_multipart(base_url().$module.'/add',' class="form-horizontal" id="common_form" ' );?>
			<div class="cate_wrap">
			<div class="cat_list">
				<h5>Choose your category</h5>
				<ul class="post_category_selection">
					<?php $categories = get_blog_category(); 
					if(!empty($categories)) 
						{ 
							$i=0; 
							foreach($categories as $catkey=>$cat) 
							{ 
								if($i==0)
								{
						?>
								<input type="hidden" id="post_category" name="post_category" value="<?php echo $catkey; ?>" />
						<?php	
								}	
						?>						
						<li><a data-section="<?php echo $catkey; ?>" href="javascript:void(0)" class="<?php if($i==0) echo 'active'; ?>"><?php echo $cat; ?></a></li>
					<?php $i++; } } ?>
					<?php /*<li class="ecomm-prod"><a href="<?php echo base_url().'manageproducts/add'; ?>">Sell Products</a></li>
					<li class="serv-sec"><a href="<?php echo base_url().'manageservices/add'; ?>">Host Services</a></li> */ ?>
					
				</ul>
				<?php /*
				<ul class="fr other_options">
					<li class="ecomm-prod"><a href="<?php echo base_url().'manageproducts/add'; ?>">Sell Products</a></li>
					<li class="serv-sec"><a href="<?php echo base_url().'manageservices/add'; ?>">Host Services</a></li>
				</ul>*/ ?>
			</div>
			<div class="cat_list">
				<h5>Choose what you posting</h5>
				<input type="hidden" id="post_type" name="post_type" value="blog" />
				<ul class="post_type_selection">
					<li><a data-type="blog" href="javascript:void(0)" class="active">Blogs</a></li>
					<li><a data-type="picture" href="javascript:void(0)">Pictures</a></li>
					<li><a data-type="video" href="javascript:void(0)">Videos</a></li>
					<li><a data-type="story" href="javascript:void(0)">Stories</a></li>
					<li><a data-type="book" href="javascript:void(0)">Books</a></li>
					<li><a data-type="qa" href="javascript:void(0)">Review</a></li>
					<?php /*<li><a data-type="must_see" href="javascript:void(0)">Must See</a></li>*/ ?>
				</ul>
			</div>
			</div>
			<div class="cat_list_form">
				
					<div class="form_field">
						<?php  echo form_input('post_title',set_value('post_title'),' class="form-control required"  placeholder="Title" id="post_title" ');?>
					</div>
					<div class="form_field">
						<textarea name="post_description" id="post_description" placeholder="Description"></textarea>
					</div>
					<div class="form_field">
						<div class="">
							<input type="text" name="post_embed_video_url" placeholder="Youtube Video URL"  id="post_embed_video_url" class="form-control"  />
						</div>
					</div>
					<div class="form_field tagging_section">
						<?php 
							$followers_lst = get_followers_list(); 
							$followers = array();
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
						<?php  echo form_dropdown('post_tags[]',$followers,'',' class="form-control"  placeholder="Tag Bloggotians" data-placeholder="Tag Bloggotians"  title="Tag Bloggotians" id="post_tags" style="width:100%" multiple="multiple"');?>
					</div>
					<div class="form_field">
						<div class="left_fm_field">
							<input type="file" name="post_photo[]" placeholder="Image"  id="post_photo" class=""  multiple="multiple" />
						</div>
					</div>
					<div class="form_field video_section" style="display:none;">
						<div class="left_fm_field">
							<input type="file" name="post_video" placeholder="Video"  id="post_video" class=""  />
							<span class="help">Video upto 5MB only can be uploaded</span>
						</div>
					</div>
					<div class="form_field pdf_section" style="display:block;">
						<div class="left_fm_field">
							<input type="file" name="post_pdf" placeholder="Pdf"  id="post_pdf" class=""  />
						</div>
					</div>					
					<div class="form_field">						
						<div class="rgt_fm_field btn_submit_div">
							<input type="hidden" name="status" id="status" value="" />
							<input type="button" value="Save as draft" class="grey_btn draft_post">
							<input type="submit" value="Publish">
						</div>
						<div class="clear"></div>
						<div class="alert_msg"></div>
					</div>
				
			</div>
		<?php
		echo form_hidden ( 'action', 'Add' );
		echo form_close ();
		?>
    </div>
	<p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
</div>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/home.js"></script>
<script>
/*  load initial content.. */
$(window).load(function(){
	var selection = $('.blog_section li a.active').data('section');
	$("#search_category option").removeAttr('selected');
	var values = '';
	$("#search_category option").filter(function() {
		if(this.text == selection)
		values = this.value;
		return this.text == selection; 
	}).attr('selected', true);	
	$('#search_category').trigger("chosen:updated");
	get_content();
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
	$('.pdf_section').hide();
	if(current_val == 'video')
	{
		$('.video_section').show();
	}
	else if(current_val == 'blog' || current_val == 'book' || current_val == 'story' )
	{
		$('.pdf_section').show();
	}	
});

$('#blog_post_title').blur(function() { 
	var blog_text = $('#blog_post_title').val();
	$('#post_title').val(blog_text);
});

$('.draft_post').click(function() {
	$('#status').val('D');
	$('#common_form').submit();
});
</script>