<div id="follow_modal" class="white-popup-block mfp-hide">
	<div class="popup_header">
        <h4><?php echo $title; ?></h4>
    </div>
	<div class="popup_body">
		<?php
		 if(!empty($results))
		 {
		 	foreach ($results as $key => $info) 
		 	{
?>
        <div class="profile_wrap profilewrap_popup" id="<?php echo encode_value($info['customer_id']); ?>">
	            <div class="profile_photo_wrap">
	                <div class="pro_pic">
						<?php if($info['customer_photo'] !='') { ?>
						<img src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$info['customer_photo'];?>" alt="profile" />
						<?php } else { ?> 
	                    <img src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
						<?php } ?>
	                </div>
	                <div class="prof_dest">
	                    <h4><?php echo ($info['customer_type'] == '0')?$info['customer_first_name']." ".$info['customer_last_name']:$info['company_name']; ?></h4>
	                </div>
	            </div>
	                <div class="fllow_bns"> 
						<a href="<?php echo base_url()."myprofile/add_followers/".encode_value($info['customer_id']); ?>" class="btn btn_blue unfollow_users">Unfollow</a> 
					</div>
	        </div>
<?php		 	}
		 }
		?>
    </div>
	<p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
</div>