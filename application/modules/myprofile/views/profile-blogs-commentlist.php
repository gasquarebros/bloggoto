
<?php 

	if(!empty($records)) {
		foreach($records as $record)
		{
	?>		
			<div class="comments_records">
				<a href="<?php echo base_url().'myprofile/'.encode_value($record['customer_id']); ?>">
					<?php if($record['customer_photo'] !='') { ?>
					<img style="width:100px" src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$record['customer_photo'];?>" alt="profile" />
					<?php } else { ?> 
					<img src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
					<?php } ?>
				</a>
				<div class="parent_comments">
					<div class="message"> <span class="arrow"> </span> 
					
					<a href="<?php echo base_url().'myprofile/'.encode_value($record['customer_id']); ?>" class="name"> <?php echo ($record['customer_type'] == 0)?$record['customer_first_name']." ".$record['customer_last_name']:$record['company_name']; ?> 
					</a> <span class="datetime"> at <?php echo datepostformat(date('Y-m-d H:i:s',strtotime($record['post_comment_created_on']))); ?> </span> <span class="body"> <?php 
					$text = $record['post_comment_message'];
					echo $text = $text;
					?> </span> </div>
					
				</div>
			</div>
	<?php
		}
	?>
		<div class="load_more" <?php if($next_set !='') { echo 'style="display:block;"'; } else { echo "style='display:none;'"; } ?>>
			<button class="more_posts_comments">Load More</button>
		</div>
	<?php
	} else if($offset == 0)
	{
		echo "<p class='no-records'>No Comments Found</p>";
	}
?>
<input type="hidden" class="comment_page" value="<?php echo $next_set; ?>" />