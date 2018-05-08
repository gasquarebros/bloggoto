<?php if(!empty($records)) { ?>
<?php $i=0; foreach($records as $record) { ?>
<?php 
if($i%2 == 0){ ?>
<div class="list_row_section">
<?php }  ?>
<div class="list_row">
	<div class="list_col">
		<div class="list_col_inner">
			<div class="list_img">

				<?php if($record['post_photo'] !='' && file_exists(FCPATH."media/".$this->lang->line('post_photo_folder_name').$record['post_photo'])){ $photo=media_url().$this->lang->line('post_photo_folder_name').$record['post_photo']; } else if($record['customer_photo'] !=''&& file_exists(FCPATH."media/".$this->lang->line('customer_image_folder_name').$record['customer_photo'])) { $photo = media_url().$this->lang->line('customer_image_folder_name')."/".$record['customer_photo'];  } else { $photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; } ?>
				<img src="<?php echo $photo; ?>" alt="<?php echo $record['post_title']; ?>" />
			</div>
			<div class="list_decp">
				<h3>
					<a href="<?php echo base_url().$module.'/view/'.$record['post_slug']; ?>"><?php echo $record['post_title']; ?></a>
					<?php if(get_user_id() != '') { ?>		
						<span href="javascript:;" class="post_more x_login_popup post_options_action" title="More"><i class="fa fa-ellipsis-v"></i>
						
										
				
							<ul style="display:none;" class="show_post_options test">
								<li>
									<a href="javascript:;" class="post_report x_login_popup" data-id="<?php echo encode_value($record['post_id']);?>" title="Report"><i class="fa fa-flag-o"></i></a>
								</li>

								<?php if(get_user_id() == $record['post_created_by']) { ?>				
								<li>
									<a href="<?php echo base_url().$module.'/editpost/'.$record['post_slug']; ?>" class="post_edit x_login_popup" data-id="<?php echo encode_value($record['post_id']);?>" title="Edit"><i class="fa fa-edit"></i></a>
								</li>
								<li>		
									<a href="javascript:;" class="post_delete x_login_popup" data-id="<?php echo encode_value($record['post_id']);?>" title="Delete"><i class="fa fa-trash-o"></i></a>
								</li>		
								<?php } ?>
							</ul>
					
						</span>
					<?php } ?>
				</h3>
				<?php 
					if(!empty($record['post_tag_names'])) { 
						echo  "<div class='tags'>";
						$tags = explode(',',$record['post_tag_names']); 
						$tag_user_id = explode(',',$record['post_tag_ids']); 
						foreach($tags as $tkey=>$tag)
						{
							$username = get_tag_username($tag_user_id[$tkey]);
							if(!empty($tag) && $username !='') {
				?>
								<span><a target="_blank" href="<?php echo base_url().'myprofile/'.urlencode($username); ?>"><?php echo "#".$tag; ?></a></span>
				<?php
							} 
						}
						echo "</div>";
					} 
				?>
				<span></span>
				<?php echo substr_close_tags(json_decode($record['post_description'])); ?>
				<div class="post_by">
					<p><span class="post_title">Posted by</span> <?php if($record['post_by'] == 'admin') { echo "Admin"; } else { echo ($record['customer_type']==0)?$record['customer_first_name']:$record['company_name']; } ?></p>
					<a href="<?php echo base_url().$module.'/view/'.$record['post_slug']; ?>" class="read">Read More</a>
				</div>
			</div>
		</div>
	</div>
<?php $i++; 
if($i%2 == 0 || count($records) < $i){ 
?>	
</div>
<?php } ?>
</div>
<?php } } else if($offset == 0) { ?>
	<div class="list_row">
		<p class="no_records">No Posts Found</p>
	</div>
<?php } ?>