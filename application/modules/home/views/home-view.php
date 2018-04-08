<script type="text/javascript" src="<?php echo skin_url(); ?>js/profile.js"></script>
<section>
    <div class="container">
		<?php if(!empty($records)) { ?>
			<?php foreach($records as $record) { ?>
				<div class="single_feed">
					<div class="feed_wrapper">
						<div class="feed_header">
							<div class="lft_feed_img">
								<?php if($record['customer_photo'] !=''){ $photo=media_url().$this->lang->line('customer_image_folder_name').$record['customer_photo']; } else { $photo=media_url().$this->lang->line('customer_image_folder_name')."default.png"; } ?>
								<?php 
								if($record['post_by'] == 'admin'){
									$url ="";									
								} 
								else { 
									$url =base_url()."myprofile/".encode_value($record['customer_id']);
								}
								if($url !='') { ?> <a href="<?php echo $url; ?>"> <?php } ?>
								<img src="<?php echo $photo; ?>" alt="<?php echo $record['post_title']; ?>" />
								<?php if($url !='') { ?></a><?php } ?>
							</div>
							<div class="feed_name">
								<h4><span class="post_title">Posted by</span> <?php 
								if($record['post_by'] == 'admin'){								
									echo "Admin"; 
								} 
								else { 
									if($record['customer_type'] == 1)
									{
										echo "<a href='".$url."'>".$record['company_name']."</a>"; 
									} else {
										echo "<a href='".$url."'>".$record['customer_first_name']." ".$record['customer_last_name']."</a>"; 
									}
									
								} ?></h4>
								<p><?php echo datepostformat($record['post_created_on']); ?></p>
							</div>
							<a href="javascript:void(0)" class="toggle_feed"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
							<div class="clear"></div>
						</div>
						<div class="toggle_content">
						<div class="feed_image">
							<?php if($record['post_photo'] !=''){ $photo=media_url().$this->lang->line('post_photo_folder_name').$record['post_photo']; } else { /*$photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; */ $photo=''; } ?>
							
								<?php if($photo !='') { ?>
								<img src="<?php echo $photo; ?>" alt="<?php echo $record['post_title']; ?>" />
								<?php } ?>
							
						</div>
						<div class="feed_body_text">
							<h4><a href="<?php echo $url; ?>"><?php echo $record['post_title']; ?></a></h4>
							<?php 
								if(!empty($record['post_tag_names'])) { 
									echo  "<div class='tags'>";
									//$tags = explode(',',$record['post_tag_names']); 
									//$tag_user_id = explode(',',$record['post_tag_ids']); 
									$tags =  array_values(array_filter(array_unique(explode(',',$record['post_tag_names']))));
									$tag_user_id =  array_values(array_filter(array_unique(explode(',',$record['post_tag_ids']))));
									
									foreach($tags as $tkey=>$tag)
									{
										if(!empty($tag)) {
							?>
											<span><a target="_blank" href="<?php echo base_url().'myprofile/'.encode_value($tag_user_id[$tkey]); ?>"><?php echo $tag; ?></a></span>
							<?php
										} 
									}
									echo "</div>";
								} 
							?>
							<p><?php echo substr_close_tags($record['post_description']); ?> </p>
							
							<?php 
							
							if($record['post_type'] == 'video' && $record['post_video'] !='') { ?>
								<video poster="PreviewImage.jpeg" width="640" height="480" controls="controls">
									<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$record['post_video']; ?>" type="video/webm" />
									<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$record['post_video']; ?>" type="video/mp4" />
									<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$record['post_video']; ?>" type="video/ogg" />
									your  browser does not support the video tag.
								</video>
							<?php } ?>
						</div>
						<div class="feed_like_share">
							<?php $likes_user_ids = array_values(array_filter(array_unique(explode(',',$record['lkesuser'])))); ?>
							<ul>
								<li>
									<a class="thumbsup <?php if(get_user_id() !='' && in_array(get_user_id(),$likes_user_ids)) { echo "active"; } ?>" data-id ="<?php echo encode_value($record['post_id']); ?>" href="<?php echo base_url().'myprofile/post_likes/'.$record['post_slug']; ?>"><i class=" fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="likes_display"><?php echo thousandsCurrencyFormat($record['postcount']); ?></span></a>
								</li>
								<li>
									<a data-id ="<?php echo encode_value($record['post_id']); ?>" class="comments" href="<?php if(get_user_id() !=''){ echo base_url().'myprofile/comments/'.$record['post_slug']; } else { echo base_url(); } ?>"><i class="fa fa-comment-o" aria-hidden="true"></i> <span class="comments_display"><?php echo $record['commentcount']; ?></span></a>
								</li>
								<li><a href="javascript:void(0)" class="share_social"><i class="fa fa-share" aria-hidden="true"></i> Share</a>
									<div class="social_sharing_sections" style="display:none">
										<a href="http://www.facebook.com/sharer.php?u=<?php echo base_url().'home/view/'.$record['post_slug']; ?>&title=<?php echo urlencode($record['post_title']); ?>" target="_blank" title="Click to share">Share on Facebook</a>
										<a href="http://twitter.com/share?text=<?php echo urlencode($record['post_title']); ?>&url=<?php echo base_url().'home/view/'.$record['post_slug']; ?>" target="_blank" title="Click to post to Twitter">Tweet this</a>
										<a href="https://plus.google.com/share?url=<?php echo base_url().'home/view/'.$record['post_slug']; ?>" target="_blank" title="Click to share">Share on Google+</a>
									</div>
								</li>
							</ul>
							<div class="comments_list">
							</div>	
						</div>
						</div>
					 </div>
					<div class="feed_comment toggle_content">
						<?php echo form_open_multipart(base_url().'myprofile/addcomments',' class="comment_form" autocomplete="'.form_autocomplte().'" ' );?>
							<div class="comment_img">
								<?php if($this->session->userdata('bg_user_profile_picture')) { ?>
									<img style="width:50px" class="img-circle" src="<?php echo $this->session->userdata('bg_user_profile_picture'); ?>" alt="man" />
								<?php } else {?>
									<img src="<?php echo skin_url(); ?>images/man.png" alt="man" />
								<?php } ?>	
							</div>
							<div class="comment_box_wrap">
								<input type="hidden" name="post_record" value="<?php echo encode_value($record['post_id']); ?>" />
								<input type="text" name="comments" placeholder="Write a comment..." />
							</div>
							<div class="clear"></div>
							<div class="alert_msg"></div>
						<?php
						echo form_hidden ( 'action', 'comment' );
						echo form_close ();
						?>
					</div>
				</div>
			<?php }
		} ?>
	</div>
</section>	