<script>
var module_action="savedraftpost";
var custom_redirect_url="home/draftpost";
</script>
<style>
.chosen-container { width: auto !important; }
</style>
<section>
    <div class="container">
		<?php if(!empty($records)) { ?>
		<?php $i=0; foreach($records as $record) {  ?>
		<?php 
		/*if($i%2 == 0){ ?>
		<div class="list_row">
		<?php } */ ?>
		<div class="list_row">
			<div class="list_col">
				<div class="list_col_inner">
					<div class="list_img">
						<?php if($record['post_photo'] !=''){ $photo=media_url().$this->lang->line('post_photo_folder_name').$record['post_photo']; } else { $photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; } ?>
						<img src="<?php echo $photo; ?>" alt="<?php echo $record['post_title']; ?>" />
					</div>
					<div class="list_decp">
						<h3><a href="<?php echo base_url().$module.'/view/'.$record['post_slug']; ?>"><?php echo $record['post_title']; ?></a></h3>
						<?php 
						$post_video = '';
						if($record['post_video'] !='' ){ 
							$post_video = media_url().$this->lang->line('post_video_folder_name').$record['post_photo'].$record['post_video'];
						}
						
						$record_tag = array();
							if(!empty($record['post_tag_names'])) { 
								echo  "<div class='tags'>";
								$tags = explode(',',$record['post_tag_names']); 
								$tag_user_id = explode(',',$record['post_tag_ids']); 
								foreach($tags as $tkey=>$tag)
								{
									if(!empty($tag)) {
										$record_tag[] = encode_value(trim($tag_user_id[$tkey]))."__".trim($tag);
						?>
										<span><a target="_blank" href="<?php echo base_url().'myprofile/'.encode_value($tag_user_id[$tkey]); ?>"><?php echo "#".$tag; ?></a></span>
						<?php
									} 
								}
								echo "</div>";
							}	
						?>
						<span></span>
						<?php echo substr_close_tags(utf8_decode($record['post_description'])); ?>
						<div class="post_by">
							<p><span class="post_title"></span> <?php if($record['post_by'] == 'admin') { echo "Admin"; } else { echo $record['customer_first_name']; } ?></p>
							<input type="hidden" class="post_info_title" value="<?php echo $record['post_title']; ?>" />
							<input type="hidden" class="post_info_description" value="<?php echo $record['post_description']; ?>" />
							<input type="hidden" class="post_info_image" value="<?php if($record['post_photo'] !=''){ echo $photo; }; ?>" />
							<input type="hidden" class="post_info_video" value="<?php echo $post_video; ?>" />
							<input type="hidden" class="record_id" value="<?php echo encode_value($record['post_id']); ?>" />
							<input type="hidden" class="post_info_tags" value="<?php echo implode(',',$record_tag); ?>" />
							<a class="read edit-post popup-modal" href="#test-modal">Edit post</a>
						</div>
					</div>
				</div>
			</div>
		<?php $i++; 
		/*
		if($i %2 == 0 || count($records) < $i){ 
		?>	
		</div>
		<?php }*/ ?>
		</div>
		<?php } } else { ?>
			<div class="list_row">
				<p class="no_records">No Posts Found</p>
			</div>
		<?php } ?>

	

		<div id="test-modal" class="white-popup-block mfp-hide">
			<div class="popup_header">
				<h4>Edit your post</h4>
			</div>
			<div class="popup_body">
				<?php echo form_open_multipart(base_url().$module.'/add',' class="form-horizontal" id="common_form" ' );?>
					<?php /*<div class="cate_wrap">
					<div class="cat_list">
						<h5>Choose your category</h5>
						<input type="hidden" id="post_category" name="post_category" value="Fashion" />
						<ul class="post_category_selection">
							<li><a data-section="Fashion" href="javascript:void(0)" class="active">Fashion</a></li>
							<li><a data-section="Travel" href="javascript:void(0)" >Travel</a></li>
							<li><a data-section="Food" href="javascript:void(0)" >Food</a></li>
							<li><a data-section="Tech" href="javascript:void(0)" >Tech</a></li>
							<li><a data-section="News" href="javascript:void(0)" >News</a></li>
							<li><a data-section="health" href="javascript:void(0)" >Health</a></li>
							<li><a data-section="Life-style" href="javascript:void(0)" >Lifestyle</a></li>
							<li><a data-section="Celebrates" href="javascript:void(0)" >Celeb</a></li>
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
							<li><a data-type="must_see" href="javascript:void(0)">Must See</a></li>
						</ul>
					</div>
					</div>*/ ?>
					<div class="cat_list_form">
						
							<div class="form_field">
								<?php  echo form_input('post_title',set_value('post_title'),' class="form-control required"  placeholder="Title" id="post_title" ');?>
							</div>
							<div class="form_field">
								<textarea name="post_description"  id="post_description" placeholder="Lorum ipsum lorum ipsum lorum ipsum"></textarea>
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
							<div class="form_field video_section" style="display:none;">
								<div class="left_fm_field">
									<a href="" id="video_post" target="_blank" style="display:none;">Video File</a>
									<input type="file" name="post_video" placeholder="Video"  id="post_video" class=""  />
								</div>
							</div>
							<div class="form_field">
								<div class="left_fm_field">
									<img src="" id="image_post" style="display:none; width:100px; height:100px;" name="image_post" >
									<input type="file" name="post_photo" placeholder="Image"  id="post_photo" class=""  />
								</div>
								<div class="rgt_fm_field btn_submit_div">
									<input type="hidden" name="status" id="status" value="" />
									<input type="hidden" name="record_id" id="record_id" value="" />
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
	</div>
</section>

<script>
$(document).ready(function() {
	$('.edit-post').click(function() {
		var post_title = $(this).parent().find('.post_info_title').val();
		var post_description = $(this).parent().find('.post_info_description').val();
		var image_post = $(this).parent().find('.post_info_image').val();
		var video_post = $(this).parent().find('.post_info_video').val();
		var tag_post = $(this).parent().find('.post_info_tags').val();
		var record_id = $(this).parent().find('.record_id').val();

		/*setting all values as empty*/
		$('#post_title').val('');
		$('#post_description').val('');
		$('#image_post').val('');
		$('#video_post').val('');
		$('#post_tags').val('');
		var tagging = new Array();
		tagging = tag_post.split(',');
		/*alert(tag_post);*/
		console.log(tagging);
		
		if(tag_post !='')
		{
			/*
			$(tagging).each(function(key,values){
				$('#post_tags option').each(function() {
					console.log($(this).val());
					console.log('formed');
					console.log(values);
					console.log('out');
					if($(this).val() == values) {
						console.log('inn');
						$(this).prop("selected", true);
					}
				});
				
				$("#post_tags option[value='"+values+"']").prop("selected", true);
			});
			*/
			$('#post_tags').val(tagging);
		}
		
		$('#record_id').val(record_id);
		$('#post_title').val(post_title);
		$('#post_description').val(post_description);
		console.log(image_post);
		console.log(video_post);
		if(image_post !='')
		{
			$('#image_post').show();
			$('#image_post').attr('src',image_post);
		}
		if(video_post !='')
		{
			$('#video_post').show();
			$('.video_section').show();
			$('#video_post').attr('href',video_post);
		}
		
		$('#post_tags').trigger("chosen:updated");
		$('#post_tags').trigger("liszt:updated");
	});
	
	$('.draft_post').click(function() {
		$('#status').val('D');
		$('#common_form').submit();
	});
});
</script>