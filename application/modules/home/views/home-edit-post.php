<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo load_lib();?>ckeditor/_samples/sample.js"></script>
<script>
var module_action="updatepost";
</script>
<section>
	<div class="container">
		<div style="margin-bottom:15px;" class=" page_content">
			<div class="col-md-3">
			</div>
			<div class="col-md-9">
				<div id="page-title">
					<h1 class="page-header text-overflow">Edit your post 
					</h1>
				</div>
				<div class="">
        <?php echo form_open_multipart(base_url().$module.'/updatepost',' class="form-horizontal" id="common_form" ' );?>
			<div class="cate_wrap">
			<div class="cat_list">
				<h5>Choose your category</h5>
				<input type="hidden" id="post_category" name="post_category" value="<?php echo $result['blog_cat_name'];?>" />
				<ul class="post_category_selection">
					<li><a data-section="Fashion" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Fashion') ? 'active': '';?>">Fashion</a></li>
					<li><a data-section="Travel" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Travel') ? 'active': '';?>">Travel</a></li>
					<li><a data-section="Food" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Food') ? 'active': '';?>">Food</a></li>
					<li><a data-section="Tech" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Tech') ? 'active': '';?>">Tech</a></li>
					<li><a data-section="Business" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Business') ? 'active': '';?>">Business</a></li>
					<li><a data-section="Health" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Health') ? 'active': '';?>">Health</a></li>
					<li><a data-section="Lifestyle" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Lifestyle') ? 'active': '';?>">Lifestyle</a></li>
					<li><a data-section="Paparazzi" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Paparazzi') ? 'active': '';?>">Paparazzi</a></li>
					<li><a data-section="Others" href="javascript:void(0)" class="<?php echo ($result['blog_cat_name'] == 'Others') ? 'active': '';?>">Others</a></li>
					
				</ul>
			</div>
			<div class="cat_list">
				<h5>Choose what you post</h5>
				<input type="hidden" id="post_type" name="post_type" value="<?php echo $result['post_type']; ?>" />
				<ul class="post_type_selection">
					<li><a data-type="blog" href="javascript:void(0)" class="<?php echo ($result['post_type'] == 'blog') ? 'active': '';?>">Blogs</a></li>
					<li><a data-type="picture" href="javascript:void(0)" class="<?php echo ($result['post_type'] == 'picture') ? 'active': '';?>">Pictures</a></li>
					<li><a data-type="video" href="javascript:void(0)" class="<?php echo ($result['post_type'] == 'video') ? 'active': '';?>">Videos</a></li>
					<li><a data-type="story" href="javascript:void(0)" class="<?php echo ($result['post_type'] == 'story') ? 'active': '';?>">Stories</a></li>
					<li><a data-type="book" href="javascript:void(0)" class="<?php echo ($result['post_type'] == 'book') ? 'active': '';?>">Books</a></li>
					<li><a data-type="qa" href="javascript:void(0)" class="<?php echo ($result['post_type'] == 'qa') ? 'active': '';?>">Q & A</a></li>
					<?php /*<li><a data-type="must_see" href="javascript:void(0)" class="<?php echo ($result['post_type'] == 'must_see') ? 'active': '';?>">Must See</a></li>*/ ?>
				</ul>
			</div>
			</div>
			<div class="cat_list_form">
				
					<div class="form_field">
						<?php  echo form_input('post_title',$result['post_title'],' class="form-control required"  placeholder="Title" id="post_title" ');?>
					</div>
					<div class="form_field">
						<textarea id="post_description" name="post_description" placeholder="Enter Your Description"><?php echo json_decode($result['post_description']); ?></textarea>
					</div>
					<div class="form_field">
						<div class="">
						<?php  echo form_input('post_embed_video_url',$result['post_embed_video_url'],' class="form-control"  placeholder="Youtube Embed Video URL" id="post_embed_video_url" ');?>

						</div>
					</div>					
					<div class="form_field tagging_section">
						<?php 
							$followers = array();
							$followers_lst = get_followers_list(); 
							if(!empty($followers_lst)) {
								foreach($followers_lst as $foll_list)
								{
									$followers[encode_value($foll_list['follow_user_id'])."__".$foll_list['customer_first_name']." ".$foll_list['customer_last_name']] = $foll_list['customer_first_name']." ".$foll_list['customer_last_name']; 	
								}
							}
						?>
						<?php  echo form_dropdown('post_tags[]',$followers,'',' class="form-control"  placeholder="Title" id="post_tags" style="width:100%" multiple="multiple"');?>
					</div>
					
					<div class="form_field"><div class="clear">&nbsp;&nbsp;</div></div>
					<div class="form_field">
						<?php if($result['post_photo'] != '')
								{ 
							?>
							<label></label>
							<div class="input_field show_image_box">
							<?php								
									$existpostphotos=explode(",",$result['post_photo']);
									if(!empty($existpostphotos))
									{
										foreach($existpostphotos as $existphoto)
										{								
							?>										<label></label>
				
								<img class="img-responsive common_delete_image" style="width: 100px; height:100px;"  src="<?php echo media_url(). $this->lang->line('post_photo_folder_name')."/".$existphoto;?>">
							<?php 		} 	
									}?>
							</div>
								<?php 	 
								}?>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<?php if($result['post_video']){ ?>
						<label></label>
						<div class="input_field show_image_box">
							<video poster="PreviewImage.jpeg"  controls="controls">
								<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$result['post_video']; ?>" type="video/webm" />
								<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$result['post_video']; ?>" type="video/mp4" />
								<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$result['post_video']; ?>" type="video/ogg" />
								your  browser does not support the video tag.
							</video>
						</div><?php } ?>
						<div class="clear"></div>
					</div>	
					<div class="form_field ">
							<?php 
							if(($result['post_type'] == 'blog' || $result['post_type'] == 'book' || $result['post_type'] =='story') && ($result['post_pdf'] != '')) { ?>
								<a class="pdf_source" href="<?php echo media_url().$this->lang->line('post_pdf_folder_name').$result['post_pdf']; ?>" target="_blank">
									<i class="fa fa-file-pdf-o" style="font-size:48px;color:#2596B1"></i> </a>
							<?php } ?>					
					</div>	
					<div class="form_field ">
						<div class="left_fm_field">
							<input type="file" name="post_photo[]" placeholder="Image"  id="post_photo" class="" multiple="multiple" />
						</div>
					</div>	
					<div class="form_field video_section" style="<?php echo ($result['post_type'] == 'video')? 'display:block':'display: none'?>">
						<div class="left_fm_field">
							<input type="file" name="post_video" placeholder="Video"  id="post_video" class=""  />
						</div>
					</div>
					<?php $pdf_cls= ($result['post_type'] == 'blog' || $result['post_type'] == 'story' || ($result['post_type'] == 'book'))? 'display:block':'display: none'?>
					<div class="form_field pdf_section" style="<?php echo $pdf_cls;?>">
						<div class="left_fm_field">
							<input type="file" name="post_pdf" placeholder="Pdf"  id="post_pdf" class=""  />
						</div>
					</div>					
					<div class="form_field ">						
						<div class="rgt_fm_field btn_submit_div">
							<input type="hidden" name="status" id="status" value="" />
							<input type="hidden" value="Sava as draft" class="grey_btn draft_post">
							<input type="submit" value="Publish">
						</div>
						<div class="clear"></div>
					</div>					
				
			</div>
		<?php
		echo form_hidden ( 'action', 'Update' );
		echo form_hidden ( 'editid', encode_value($result['post_id']) );
		echo form_hidden ( 'existpostphoto', $result['post_photo'] );
		echo form_hidden ( 'existpostvideo', $result['post_video'] );
		echo form_hidden ( 'postslug', $result['post_slug'] );
		echo form_close ();
		?>


				</div>
			</div>
		</div>
	</div>
</section>	
<div class="clear"></div>
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
	$('.pdf_section').hide();
	$('.video_section').hide();
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

CKEDITOR.replace( 'post_description',{
	uiColor: '#DAF2FE',
	forcePasteAsPlainText:	true,
	toolbar :
	[
		['PasteFromWord','-', 'SpellChecker'],
		['SelectAll','RemoveFormat'],
		['Bold','Italic','Underline','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Blockquote'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Anchor'],
		['Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
	]
	
});
</script>