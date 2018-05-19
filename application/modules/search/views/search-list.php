<script>
var module_action="search";
</script>
<section>
    <div class="container">
        <div class="search_listing_wrap ">
			<h2>Search Results</h2>
			<div class="append_html">
				<?php if(!empty($result)) { ?>
					<?php foreach($result as $record) {  ?>
					<div class="search_feed row">
						<div class="search_list">
							<?php if(strtolower($record['topic_type']) == 'post') { 
								$page_url = base_url()."home/view/".$record['post_slug'];
							?>
								<div class="search_image">
									<a href="<?php echo $page_url; ?>">
										<?php if($record['post_photo'] !='' && file_exists(FCPATH."media/".$this->lang->line('post_photo_folder_name').$record['post_photo'])){ $photo=media_url().$this->lang->line('post_photo_folder_name').$record['post_photo']; } else if($record['customer_photo'] !=''&& file_exists(FCPATH."media/".$this->lang->line('customer_image_folder_name').$record['customer_photo'])) { $photo = media_url().$this->lang->line('customer_image_folder_name')."/".$record['customer_photo'];  } else { $photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; } ?>
										<img src="<?php echo $photo; ?>" alt="<?php echo $record['post_title']; ?>" />
									</a>
								</div>
								<div class="search_text">
									<a href="<?php echo $page_url; ?>">
										<span class="search_ttile">
											<?php echo $record['post_title']; ?>
										</span>
									</a>
									<p class="">
										category: <?php echo $record['blog_cat_name']; ?>
									</p>
									<p class="">Section: Posts</p>
									<div class="search_desc">
										<?php echo substr_close_tags(json_decode($record['post_description'])); ?>
									</div>
								</div>
								
								
							<?php } else { 
								$page_url = base_url()."myprofile/".urlencode($record['customer_username']);; 
							?> 
								<div class="search_image">
									<a href="<?php echo $page_url; ?>">
										<?php if($record['customer_photo'] !='') { ?>
											<img src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$record['customer_photo'];?>" alt="profile" />
										<?php } else { ?> 
											<img src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
										<?php } ?>
									</a>
								</div>
								<div class="search_text">
									<a href="<?php echo $page_url; ?>">
										<span class="search_ttile">
										<?php echo ($record['customer_type'] == '0')?$record['customer_first_name']." ".$record['customer_last_name']:$record['company_name']; ?>											
										</span>
									</a>
									<p class="">Section: <?php echo $record['topic_type']; ?></p>
									<div class="search_desc">
										<?php echo substr_close_tags($record['customer_notes']); ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php } 
				} else if($offset == 0) { ?>
					<div class="search_list_row">
						<p class="no_records">No Records Found</p>
					</div>
				<?php } ?>
			</div>
        </div>
    </div>
</section>