<div id="follow_modal" class="white-popup-block mfp-hide">
	<div class="popup_header">
        <h4><?php echo $title; ?></h4>
    </div>
	<div class="popup_body">
		<?php
		$blocked_users = get_all_block_users();
		if(!empty($results) && (!(in_array($customer_id,$blocked_users))) )
		{
		 	foreach ($results as $key => $info) 
		 	{
				if(get_user_id() !='')
				{
					$celebrity_badge_class=($info['customer_celebrity_badge']) ? 'fa fa-diamond' :'';
				}
				else
				{
					$celebrity_badge_class='';
				}		 		
				
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
	                    <h4><a href="<?php echo base_url().urlencode($info['customer_username']); ?>" target="_blank" class="<?php echo $celebrity_badge_class; ?>"><?php echo ($info['customer_type'] == '0')?(($info['customer_first_name'] !='' || $info['customer_last_name'] !='')?$info['customer_first_name']." ".$info['customer_last_name']:$info['customer_username']):(($info['company_name'])?$info['company_name']:$info['customer_username']); ?></a></h4>
	                </div>
	            </div>
	            <div class="fllow_bns"> 
					
				</div>
	        </div>
<?php		 	}
		} else if(in_array($customer_id,$blocked_users)){ 
			echo "<p>You dont have access</p>";
		}
		?>
    </div>
	<p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
</div>