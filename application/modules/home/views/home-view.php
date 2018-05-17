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
									$username = get_tag_username($record['customer_id']);
									$url="";
									if($username !='') {
										$url =base_url().urlencode($username);
									}
								}
								if($url !='') { ?> <a href="<?php echo $url; ?>"> <?php } ?>
								<img src="<?php echo $photo; ?>" alt="<?php echo $record['post_title']; ?>" />
								<?php if($url !='') { ?></a><?php } ?>
							</div>
							<div class="feed_name">
								<h4><span class="post_title"></span> <?php 
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
							<?php /*
							<a href="javascript:void(0)" class="toggle_feed"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
							*/ ?>
							<?php if(get_user_id() != '') { ?>				
							<span href="javascript:;" class="post_more x_login_popup post_options_action" title="More"><i class="fa fa-ellipsis-v"></i>
								<ul style="display:none;" class="show_post_options test">
									<li>
										<a href="javascript:;" class="post_report x_login_popup" data-id="<?php echo encode_value($record['post_id']);?>" title="Report"><i class="fa fa-flag-o"></i></a>
									</li>

									<?php if(get_user_id() == $record['post_created_by']) { ?>				
									<li>
										<a href="<?php echo base_url().'home/editpost/'.$record['post_slug']; ?>" class="post_edit x_login_popup" data-id="<?php echo encode_value($record['post_id']);?>" title="Edit"><i class="fa fa-edit"></i></a>
									</li>
									<li>		
										<a href="javascript:;" class="post_delete x_login_popup" data-id="<?php echo encode_value($record['post_id']);?>" title="Delete"><i class="fa fa-trash-o"></i></a>
									</li>		
									<?php } ?>
								</ul>
							</span>
							<?php } ?>
							
							
							<div class="clear"></div>
						</div>
						
						<div class="toggle_contents">
						<div class="feed_image">
							<?php 
							$photo = '';
							if($record['post_photo'] !=''){ $photo=media_url().$this->lang->line('post_photo_folder_name').$record['post_photo']; } else { /*$photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; */ $photo=''; } ?>
							
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
											
											$username = get_tag_username($tag_user_id[$tkey]);
											if(!empty($tag) && $username !='') {
							?>
												<span><a target="_blank" href="<?php echo base_url().urlencode($username); ?>"><?php echo $tag; ?></a></span>
							<?php
											}
										} 
									}
									echo "</div>";
								} 
							?>
							<p><?php echo json_decode($record['post_description']); ?> </p>
							
							<?php 
							
							if($record['post_type'] == 'video' && $record['post_video'] !='') { ?>
								<video autoplay poster="PreviewImage.jpeg"  width="100%"  controls="controls" muted>
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
									<a data-id ="<?php echo encode_value($record['post_id']); ?>" class="comments" href="<?php /*if(get_user_id() !=''){ echo base_url().'myprofile/comments/'.$record['post_slug']; } else { echo base_url(); }*/echo base_url().'myprofile/comments/'.$record['post_slug'];  ?>"><i class="fa fa-comment-o" aria-hidden="true"></i> <span class="comments_display"><?php echo thousandsCurrencyFormat($record['commentcount']); ?></span></a>
								</li>
								<li class="shear-btn">
									<a href="javascript:;">
										&nbsp;Share
									</a>
									<div class="social-share"> 
											<a class="" href="http://www.facebook.com/sharer.php?u=<?php echo base_url().'home/view/'.$record['post_slug']; ?>&title=<?php echo urlencode($record['post_title']); ?>" target="_blank" ><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
											<a class="" href="http://twitter.com/share?text=<?php echo urlencode($record['post_title']); ?>&url=<?php echo base_url().'home/view/'.$record['post_slug']; ?>" target="_blank" ><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
											<a class="" href="https://plus.google.com/share?url=<?php echo base_url().'home/view/'.$record['post_slug']; ?>" target="_blank" ><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
											
									</div>
								</li>
								
							</ul>
							<div class="comments_list">
							</div>	
						</div>
						</div>
					 </div>
					<div class="feed_comment toggle_contents">
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
								<input type="text" class="comment" name="comments" placeholder="Write a comment..." />
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