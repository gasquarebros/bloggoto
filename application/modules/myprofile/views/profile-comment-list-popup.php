<div id="comment_modal" class="white-popup-block mfp-hide">
	<div class="popup_header">
        <h4><?php echo $title; ?></h4>
    </div>
	<div class="popup_body">
		<?php
		if(!empty($records))
		{
?>
			<?php echo form_open_multipart(base_url()."myprofile/updatecomments/".encode_value($record['post_comment_post_id'])."/".encode_value($record['post_comment_id']),' class="comment_form" autocomplete="'.form_autocomplte().'" ' );?>
<!-- 				<div class="comment_img">
					<?php if($this->session->userdata('bg_user_profile_picture')) { ?>
						<img style="width:50px" class="img-circle" src="<?php echo $this->session->userdata('bg_user_profile_picture'); ?>" alt="man" />
					<?php } else {?>
						<img src="<?php echo skin_url(); ?>images/man.png" alt="man" />
					<?php } ?>	
				</div> -->
				<div class="comment_box_wrap">
					<input type="text" name="comments" value="<?php echo $record['post_comment_post_id']; ?>"  class="comment" placeholder="Your Thought..." />
				</div>
				<div class="clear"></div>
				<div class="alert_msg"></div>
			<?php
			echo form_hidden ( 'action', 'comment' );
			echo form_close ();
			?>
<?php	
		}
?>
    </div>
	<p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
</div>