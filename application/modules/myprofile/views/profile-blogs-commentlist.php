<?php 
	if(!empty($records)) {
	?>
		<div class="load_more" <?php if($next_set !='') { echo 'style="display:block;"'; } else { echo "style='display:none;'"; } ?>>
			<button class="more_posts_comments">Load More</button>
		</div>
	<?php	
	$records = array_reverse($records);
		foreach($records as $record)
		{
			$username = get_tag_username($record['customer_id']);
	?>		
			<div class="comments_records" id="<?php echo encode_value($record['post_comment_id']);?>">
				<div class="comment_left">
				
					<a href="<?php echo base_url().urlencode($username); ?>">
						<?php if($record['customer_photo'] !='') { ?>
						<img style="width:100%" src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$record['customer_photo'];?>" alt="profile" />
						<?php } else { ?> 
						<img style="width:100%" src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
						<?php } ?>
					</a>
				</div>
				<div class="comment_right">
					<a href="<?php echo base_url().urlencode($username); ?>" class="name"> <?php echo ($record['customer_type'] == 0)?$record['customer_first_name']." ".$record['customer_last_name']:$record['company_name']; ?> 
					</a> <span class="datetime"> <?php echo datepostformat(date('Y-m-d H:i:s',strtotime($record['post_comment_created_on']))); ?> </span>
				</div>
				<div class="parent_comments">
					<div class="message"> <span class="arrow"> </span> 
						<div class="before_edit_content">
						<span class="body recent"> 
							<?php echo $text = json_decode($record['post_comment_message']); ?> 
						</span> 
						</div>
						<span class="comment_content" style="display:none">
						<?php echo form_open_multipart(base_url().'myprofile/addcomments',' class="upcomment_form" autocomplete="'.form_autocomplte().'" ' );?>
							<div class="comment_box_wrap">
								<!--<input type="text" value="<?php echo output_value(json_decode($record['post_comment_message'])); ?>" id="comment_data" name="comment_data"  class="upcomment"  placeholder="Your Thought..." />-->
								<input type="text" style="display:none" class="comment_edit_section" name="comment_data" placeholder="Your Thought..." />
								<div class="comment" placeholder=" Your Thought..." contenteditable="true"><?php echo json_decode($record['post_comment_message']); ?> </div>
								<button type="submit" class="comment_submit">></button>
								<input type="hidden" id="post_record" name="post_record" value="<?php echo encode_value($record['post_id']); ?>" />
								<input type="hidden" id="cmt_record" name="cmt_record" value="<?php echo encode_value($record['post_comment_id']); ?>" />
							</div>
							<div class='display'></div>
							<div class="msgbox"></div>
							<div class="clear"></div>
							<div class="alert_msg"></div>
						<?php
						echo form_hidden ( 'action', 'updatecmt' );
						echo form_close ();
						?>							
						</span>
					</div>
					
				</div>
		<?php if(get_user_id() != '' && get_user_id() == $record['post_comment_created_by']) 
				{ 
		?>		
				<a href="<?php echo base_url()."myprofile/deletepostcomment/".encode_value($record['post_comment_id']); ?>" class="comment_delete" data-id="<?php echo encode_value($record['post_comment_post_id']);?>" data-cmtid="<?php echo encode_value($record['post_comment_id']);?>" title="Delete" ><i class="fa fa-trash-o"></i></a>

				<a href="<?php echo base_url()."myprofile/updatecomments/".encode_value($record['post_comment_post_id'])."/".encode_value($record['post_comment_id']); ?>" class="comment_edit" data-id="<?php echo encode_value($record['post_comment_post_id']);?>" data-cmtid="<?php echo encode_value($record['post_comment_id']);?>" title="Edit" ><i class="fa fa-edit"></i></a>


		<?php 
				} 
		?>
			</div>
	<?php
		}

	} else if($offset == 0)
	{
		echo "<p class='no-records'>No Comments Found</p>";
	}
?>
<input type="hidden" class="comment_page" value="<?php echo $next_set; ?>" />