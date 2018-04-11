<script>
var module_action="contact";
</script>
<h3>Contact Us</h3>
<div class="contact-form">
	<div class="contact-form-left">
		<div class="contact-form-left-inner">
            <h3 class="ct-title">Send us a Message</h3>
			<?php if($this->session->flashdata('success') !='') { echo '<div class="success_message">'.$this->session->flashdata('success').'</div>'; } ?>
			<?php if($form_response_error !='') { ?>
			<div class="success_error"><?php echo $form_response_error; ?></div>
			<?php } ?>
			<?php if($form_response_success !='') { ?>
			<div class="success_message"><?php echo $form_response_success; ?></div>
			<?php } ?>
                        <?php echo form_open_multipart(base_url().$module,' class="" id="contact_page" ' );?>
						 
				<div class="left-forms">
					<div class="form-filed odd">
						<input type="text" placeholder="First Name*" class="required" id="contact_first_name" maxlength="30" name="contact_first_name" value="<?php echo set_value('contact_first_name'); ?>" >
						<div class="submit_error error"><?php echo form_error('contact_first_name'); ?></div>
					</div>
					<div class="form-filed even">
						<input type="text" placeholder="Last Name" id="contact_last_name" maxlength="30" name="contact_last_name"  value="<?php echo set_value('contact_last_name'); ?>">
						<div class="submit_error error"><?php echo form_error('contact_last_name'); ?></div>
					</div>
					<div class="form-filed odd">
						<input type="text" placeholder="Phone Number*" class="required number" id="contact_phone_number" maxlength="15" minlength="8" name="contact_phone_number"  value="<?php echo set_value('contact_phone_number'); ?>">
						<div class="submit_error error"><?php echo form_error('contact_phone_number'); ?></div>
					</div>
					<div class="form-filed even">
						<input type="text" placeholder="Email Address*" id="contact_email" maxlength="35" name="contact_email"  value="<?php echo set_value('contact_email'); ?>">
						<div class="submit_error error"><?php echo form_error('contact_email'); ?></div>
					</div>
					<div class="textarea-fld">
						<textarea  placeholder="Message*" value="Message*" id="contact_message" name="contact_message"><?php echo set_value('contact_message'); ?></textarea>
					</div>	
					<div class="form-filed captchafield ">
						<div class="captcha-fld">
							<label for="captcha" class="captcha-img"><?php echo $captcha['image']; ?></label>
							<a title="reload" class="reload-captcha" href="#"><img src="<?php echo skin_url('images/reload.png'); ?>" /></a>  
							<input type="text" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
						</div>
						<div class="clear"></div>
						<div class="submit_error error"><?php echo form_error('userCaptcha'); ?></div>
					</div>	
				</div>
				<div class="frmsubmit_sec">
					<input type="hidden" name="action" value="sendcontact" >
					<input class="send-messg" type="submit" onsubmit="ga('send', 'event', 'Sendmessage', 'Submit', 'Newuser', 10);" value="Send Message" id="buttton"  >
					<img src="<?php echo skin_url('images/progress1.gif');?>" style="display:none" id="progress_id">
				</div>
			<?php echo form_close (); ?>
		</div>
	</div>
	<div class="contact-form-right">
		<div class="contact-form-right-inner">
			
			<h3 class="ct-info-title">Contact Information</h3>
			<div role="tablist" class="">
				<div id="ui-id-2" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false" class="" style="">
					<div class="">
						<address><i class="fa fa-map-marker" aria-hidden="true"></i>Coffee Board Colony, Near Loretta School, Bangalore 560045</address>																		 
						<span class="foot-tele"><i class="fa fa-phone" aria-hidden="true"></i><a>080-69999100</a></span>
						<span class="foot-email"><!--<i class="fa fa-envelope-o" aria-hidden="true"></i>-->
							<a href="mailto:info@bloggoto.com">info@bloggoto.com</a>
						</span>
					</div>
				</div>
				<div class="social-icons">
					<ul>
						<li>
							<a href="" target="_blank">
								<i class="fa fa-facebook-square" aria-hidden="true"></i>&nbsp;
							</a>
						</li>
						<li>
							<a href="" target="_blank">
								<i class="fa fa-twitter-square" aria-hidden="true"></i>&nbsp;
							</a>
						</li>
						<li>
							<a href="" target="_blank">
								<i class="fa fa-linkedin-square" aria-hidden="true"></i>&nbsp;
							</a>
						</li>
						<li>
							<a href="" target="_blank">
								<i class="fa fa-google-plus-square" aria-hidden="true"></i>&nbsp;
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
