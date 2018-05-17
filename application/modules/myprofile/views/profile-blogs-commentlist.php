
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
			<div class="comments_records">
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
						<span class="body recent"> 
							<?php echo $text = $record['post_comment_message']; ?> 
						</span> 
					</div>
					
				</div>
			</div>
	<?php
		}

	} else if($offset == 0)
	{
		echo "<p class='no-records'>No Comments Found</p>";
	}
?>
<input type="hidden" class="comment_page" value="<?php echo $next_set; ?>" />