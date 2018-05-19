 <?php if($show == 'Yes') { ?>
	<div class="newsfeed_inner">
		<?php if($post_enable == 'Yes') { ?>
		<div class="write_post">
			<div class="write_img">
				<?php if($this->session->userdata('bg_user_profile_picture') !='') { $loged_photo = $this->session->userdata('bg_user_profile_picture') ; } else { $loged_photo=skin_url()."images/man.png"; } ?>
				<img src="<?php echo $loged_photo; ?>" alt="" />
			</div>
			<div class="write_text">
				<form>
                    <div class="form_field">
                        <input type="text" id="blog_post_title" placeholder="Click here and enter title to write a blog , story, book or Upload Picture, Videos or To Ask a Question">
                    </div>
                    <div class="action_field">
                        <a class="popup-modal" <?php if(get_user_id() == '') { ?>href="<?php echo base_url(); ?>" <?php } else { ?>href="#test-modal" <?php } ?> value="">Let's Go</a>
                    </div>
                </form>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<?php if($section != 'tags') { ?>
		<div class="sort_by">
			<?php echo form_open('myprofile/viewblogs',' id="common_search" class="form-inline"');?>
				<div class="form_field">
					<?php 
					echo form_dropdown('search_field',$post_category,'','style="width:200px" id="search_category"'); ?>
                </div>
                <div class="form_field">
                <?php 
				//$sort_method = array(''=>'All','top_blog'=>'Top Blog','followers'=>'Followers Only');
				$sort_method = array(''=>'All','top_blog'=>'Top Blog');
					echo form_dropdown('order_field',$sort_method,'','style="width:200px" id="order_field"'); ?>
                </div>
				<input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>" />	
				<input type="hidden" name="page_id" id="page_id" value="<?php echo $next_set; ?>" />	
				<input type="hidden" name="offset" id="load_offset" value="<?php echo $next_set; ?>" />
			<?php echo form_close(); ?> 
		</div>
		<?php } ?>
		<div class="post_detail_wrap append_html">
<?php } ?>
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
									$url =base_url().urlencode($username);
									
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
									if($record['customer_type'] == 0) {
										echo "<a href='".$url."'>".$record['customer_first_name']." ".$record['customer_last_name']."</a>"; 
									}else { 
										echo "<a href='".$url."'>".$record['company_name']."</a>";
									}
									
									
								} ?></h4>
								<?php if($record['blog_cat_name'] !='') {  ?>
								<p><?php echo "Category: ".$record['blog_cat_name']; ?></p>
								<?php } ?>
								<p>
								<?php echo datepostformat($record['post_created_on']); ?></p>
							</div>
							<?php /*
							<a href="javascript:void(0)" class="toggle_feed"><i class="fa fa-angle-down" aria-hidden="true"></i></a>*/ ?>
							
							<?php if(get_user_id() != '') { ?>		
									<span href="javascript:;" class="post_more x_login_popup post_options_action" title="More"><i class="fa fa-ellipsis-v"></i>
									
										
										<ul style="display:none;" class="show_post_options">
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
						<div class="toggle_content">
						<div class="feed_image">
							
							
							<?php if($record['post_photo'] !=''){ $photo=media_url().$this->lang->line('post_photo_folder_name').$record['post_photo']; } else { /*$photo=media_url().$this->lang->line('post_photo_folder_name')."default.png";*/ $photo =''; } ?>
								<?php if($photo !='') { ?>
								<img src="<?php echo $photo; ?>" alt="<?php echo $record['post_title']; ?>" />
								<?php } ?>
							
						</div>
						<div class="feed_body_text">
							<h4>
								<a href="<?php echo base_url().'home/view/'.$record['post_slug']; ?>"><?php echo $record['post_title']; ?></a>
								
							</h4>
														
							
							
							<?php 
								if(!empty($record['post_tag_names'])) { 
									echo  "<div class='tags'>";
									$tags = array_unique(explode(',',$record['post_tag_names'])); 
									$tag_user_id = array_unique(explode(',',$record['post_tag_ids'])); 
									foreach($tags as $tkey=>$tag)
									{
										$username = get_tag_username($tag_user_id[$tkey]);
										if(!empty($tag)) {
							?>
											<span><a target="_blank" href="<?php echo base_url().urlencode($username); ?>"><?php echo "#".$tag; ?></a></span>
							<?php
										} 
									}
									echo "</div>";
								} 
							?>
							<p><?php echo substr_close_tags(json_decode($record['post_description'])); ?> </p>
						</div>
						<div class="feed_like_share">
							<?php $likes_user_ids = array_values(array_filter(array_unique(explode(',',$record['lkesuser'])))); ?>
							<ul>
								<li><a class="thumbsup <?php if(get_user_id() !='' && in_array(get_user_id(),$likes_user_ids)) { echo "active"; } ?>" data-id ="<?php echo encode_value($record['post_id']); ?>" href="<?php echo base_url().'myprofile/post_likes/'.$record['post_slug']; ?>"><i class=" fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="likes_display"><?php echo thousandsCurrencyFormat($record['postcount']); ?></span></a></li>
								<li><a data-id ="<?php echo encode_value($record['post_id']); ?>" class="comments" href="<?php /*if(get_user_id() !=''){ echo base_url().'myprofile/comments/'.$record['post_slug']; } else { echo base_url(); }*/ echo base_url().'myprofile/comments/'.$record['post_slug']; ?>"><i class="fa fa-comment-o" aria-hidden="true"></i> <span class="comments_display"><?php echo thousandsCurrencyFormat($record['commentcount']); ?></span></a></li>
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
		} else if($page <= 1) { echo  "<p>No Records Found</p>"; } ?>
		<div class="load_more" <?php if($next_set !='') { echo 'style="display:block;"'; } else { echo "style='display:none;'"; } ?>>
			<button class="more_posts">Load More</button>
		</div>
 <?php if($show == 'Yes') { ?>		
	</div>
</div>
 <?php } ?>