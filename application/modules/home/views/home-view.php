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
							<?php 								
								if(get_user_id() !='')
								{
									$celebrity_badge_class=($record['customer_celebrity_badge']) ? 'celebrity_badge' :'';
								}
								else
								{
									$celebrity_badge_class='';
								}	
							?>							
								<h4><span class="post_title"></span> <?php 
								if($record['post_by'] == 'admin'){								
									echo "Admin"; 
								} 
								else { 
									if($record['customer_type'] == 1)
									{
										echo "<a class='".$celebrity_badge_class."' href='".$url."'>".$record['company_name']."</a>"; 
									} else {
										echo "<a class='".$celebrity_badge_class."' href='".$url."'>".$record['customer_first_name']." ".$record['customer_last_name']."</a>"; 
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
							if($record['post_photo'] !='' && $record['post_type'] != 'video' && $record['post_video'] =='')
							{ 
								$postimages=explode(",", $record['post_photo']);
								$more_class='';
								$image_count = count ( $postimages );
								$total_image_count="+ ".($image_count-6)." More";
								$popupclass = "show_post_images";
								if($image_count==6)
								{
									$total_image_count="";
									$popupclass = "";
								}										
								if(!empty($postimages))
								{
					?>
								<div class="post_media imgcnt_<?php echo  ($image_count > 6)?  6 : $image_count; ?> popup-gallery">
					<?php								
									foreach ($postimages as $key => $postimage) 
									{
										$image_url=media_url().$this->lang->line('post_photo_folder_name').$postimage; 
										if($key > 5)
										{
											$more_class='style=display:none;';
										}
										if($key == 5)
										{
											$more_div='<div id="" class="more_class_image">'.$total_image_count.'</div>';
										}
										else
										{
											$more_div='';
										}												
							?>
											<a href="<?php echo $image_url; ?>" class="" <?php echo $more_class; ?>>
													<div>
														<img src="<?php echo $image_url; ?>"/>
													</div>
													popup-gallery<?php echo $more_div; ?>
												</a>							
							<?php					
											}
										}
									} 
						?>			

							
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
							if($record['post_embed_video_url'] !='')
							{
								echo "<iframe style='width:100%' height='300px' width='100%'  allow='autoplay; encrypted-media' allowfullscreen src='".addhttp($record['post_embed_video_url'])."' autoplay='false'></iframe>";
							}
							if($record['post_type'] == 'video' && $record['post_video'] !='') { ?>
								<video autoplay poster="PreviewImage.jpeg"  width="100%"  controls="controls" muted>
									<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$record['post_video']; ?>" type="video/webm" />
									<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$record['post_video']; ?>" type="video/mp4" />
									<source src="<?php echo media_url().$this->lang->line('post_video_folder_name').$record['post_video']; ?>" type="video/ogg" />
									your  browser does not support the video tag.
								</video>
							<?php } ?>
							<?php 
							if(($record['post_type'] == 'blog' || $record['post_type'] == 'book' || $record['post_type'] =='story') && $record['post_pdf'] !='' ) { ?>
								<a class="pdf_source" href="<?php echo media_url().$this->lang->line('post_pdf_folder_name').$record['post_pdf']; ?>" target="_blank">
									<i class="fa fa-file-pdf-o" style="font-size:48px;color:#2596B1"></i> </a>
							<?php } ?>							
						</div>
						<div class="feed_like_share">
							<?php 
							$likes_user_ids = array_values(array_filter(array_unique(explode(',',$record['lkesuser'])))); 
							$favor_user_ids = array_values(array_filter(array_unique(explode(',',$record['favoruser'])))); 
								$like_icon ='fa fa-heart-o'; 
								if(get_user_id() !='' && in_array(get_user_id(),$likes_user_ids)) { $like_icon="fa fa-heart"; } 
							?>
							<ul>
								<li>
									<a class="thumbsup <?php if(get_user_id() !='' && in_array(get_user_id(),$likes_user_ids)) { echo "active"; } ?>" data-id ="<?php echo encode_value($record['post_id']); ?>" href="<?php if(get_user_id() != '') { echo base_url().'myprofile/post_likes/'.$record['post_slug']; } else { echo base_url(); } ?>"><i class="<?php echo $like_icon; ?>" aria-hidden="true"></i> <span class="likes_display"><?php echo thousandsCurrencyFormat($record['postcount']); ?></span></a>
								</li>
								<li>
									<a data-id ="<?php echo encode_value($record['post_id']); ?>" class="<?php if(get_user_id() != '') { ?>comments<?php } ?>" href="<?php /*if(get_user_id() !=''){ echo base_url().'myprofile/comments/'.$record['post_slug']; } else { echo base_url(); }*/ if(get_user_id() != '') { echo base_url().'myprofile/comments/'.$record['post_slug']; } else { echo base_url(); }  ?>"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span class="comments_display"><?php echo thousandsCurrencyFormat($record['commentcount']); ?></span></a>
								</li>
 								<li><a class="favor <?php if(get_user_id() !='' && in_array(get_user_id(),$favor_user_ids)) { echo "active"; } ?>" data-id ="<?php echo encode_value($record['post_id']); ?>" href="<?php echo base_url().'myprofile/post_favor/'.$record['post_slug']; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i> </a></li>								
								<li class="shear-btn">
									<a href="javascript:;"><i class="fa fa-external-link"></i>
										&nbsp;
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
 <script type='text/javascript' src='<?php echo skin_url(); ?>js/image_popup.js'></script>
