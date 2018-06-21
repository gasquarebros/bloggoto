<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo get_template('layout/header','')?>
</head>

<body loggedin=''>
	
	<?php echo get_template('layout/top-menu','')?>
	<?php echo get_template('layout/notifications','')?>
	<section>
		<div class="container">
			<div class="signup_wrap_inner">
				<h3><?php echo get_label('user_registration'); ?></h3>
				<div class="signup_with" style="display:none;" >
					<a href="<?php echo base_url(); ?>auth_oa2/session/facebook" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>Connect with Facebook</a>
					<a href="<?php echo base_url(); ?>auth_oa2/session/google" class="google_plus"><i class="fa fa-google-plus" aria-hidden="true"></i>Connect with Google+</a>
					<div class="clear"></div>
					<p>or sign up with</p>
				</div>
				<div class="signup_form_section">
					<div class="alert alert-danger log_alert alert_msg" role="alert" style="display:none;"></div>
					<?php echo form_open_multipart(base_url().$module,' class="registration_from" id="common_form" ' );?>
						<div class="form_field double_input">
							<div class="form_field_inner">
								<?php  echo form_input('customer_first_name',set_value('customer_first_name'),' class="form-control placeholder-no-fix required" placeholder="'.get_label('customer_first_name').'"  ');?>
							</div>
							<div class="form_field_inner">
								<?php  echo form_input('customer_last_name',set_value('customer_last_name'),' class="form-control placeholder-no-fix" placeholder="'.get_label('customer_last_name').'"  ');?>
							</div>
						</div>
						<div class="form_field">
							<?php  echo form_input('customer_username',set_value('customer_username'),' class="form-control placeholder-no-fix required" id="customer_username"  placeholder="'.get_label('customer_username').'" onkeydown="keyDown()" onkeypress="keypress()" onkeyup="keyup()" ');?>
						</div>
						<?php /*
						<div class="form_field">
							<?php  echo form_input('customer_phone',set_value('customer_phone'),' class="form-control placeholder-no-fix required"  placeholder="'.get_label('customer_phone').'" ');?>
						</div>
						*/ ?>
						<div class="form_field">
							<?php  echo form_input('customer_email',set_value('customer_email'),' class="form-control placeholder-no-fix required email"  placeholder="'.get_label('customer_email').'" ');?>
							<span class="email_info" title="email"><i class="texthover fa fa-info" aria-hidden="true"  title="email"></i><span class="hovertext" style="display:none;  padding:3px; "><?php echo get_label('email_signup_message'); ?></span></span>
						</div>
						<div class="form_field">
							<?php  echo form_password('customer_password',set_value('customer_password'),' class="form-control placeholder-no-fix  required" id="customer_password"   minlength="'.get_label('company_password_minlength').'"  placeholder="'.get_label('customer_password').'"  ');?>
							
							<?php  echo form_password('customer_cpassword',set_value('customer_cpassword'),' class="form-control placeholder-no-fix required " equalto="#customer_password" minlength="'.get_label('company_password_minlength').'" placeholder="'.get_label('customer_cpassword').'"  ');?>
						</div>
						<div class="form_field business_field" style="display:none;">
							
							<?php  echo form_input('company_name',set_value('company_name'),' class="form-control placeholder-no-fix " placeholder="'.get_label('company_name').'"  ');?>
						</div>
						<div class="form_field double_input">
							<div class="form_field_inner fr">
								<div class="switch-field">
								  <input type="radio" id="switch_left" name="customer_type" value="0" checked/>
								  <label for="switch_left"><?php echo get_label('customer_writer_type'); ?></label>
								  <input type="radio" id="switch_right" name="customer_type" value="1" />
								  <label for="switch_right"><?php echo get_label('customer_brand_type'); ?></label>
								</div>
							</div>
							<div class="form_field_inner fl">
								<p class="term">
								<?php  echo form_checkbox('agree','1','0','id="agree" class="toggle-checkbox required"'); ?>
								<label for="agree">I agree to our <a target="_blank" href="<?php echo base_url()."page/terms-of-use"; ?>">terms & conditions</a>.</label>
								</p>
							</div>                        
						</div>
						<div class="form_field">
							<a href="<?php echo base_url();?>" id="register-back-btn" class="btn green btn-outline"><?php echo get_label('cancel');?></a>
							<button type="submit" id="submit_btn" class="btn btn-success uppercase pull-right " name="submit" value="Submit"><?php echo get_label('submit');?></button>
						</div>
					<?php	
						echo form_hidden ( 'action', 'Add' );
						echo form_close ();
					?>
				</div>
			</div>
		</div>
	</section>
	
	
	<?php echo get_template('layout/footer','')?>
	<?php /*echo get_template('layout/footer-includes','')*/ ?>
	<script type='text/javascript' src='<?php echo skin_url(); ?>js/jquery.accordion.source.js'></script>
	<script type='text/javascript' src='<?php echo skin_url(); ?>js/jquery.magnific-popup.js'></script>
	<script type='text/javascript' src='<?php echo skin_url(); ?>js/script.js'></script>
	
	<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.form.min.js"></script>
	<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo load_lib()?>chosen/js/chosen.jquery.min.js"></script>
	<script src="<?php echo skin_url()?>js/additional-methods.min.js" type="text/javascript"></script>
	<script type='text/javascript' src='<?php echo skin_url(); ?>js/registration.js'></script>



	<script type="text/javascript">
		$(document).ready(function(){
			$('ul.device_nav').accordion();
			$(function () {
				$('.popup-modal').magnificPopup({
					type: 'inline',
					preloader: false,
					focus: '#username',
					modal: true
				});
				$(document).on('click', '.popup-modal-dismiss', function (e) {
					e.preventDefault();
					$.magnificPopup.close();
				});
			});
			$('#customer_username').bind("cut copy paste",function(e) {
				e.preventDefault();
			});
			

			$(document).on('keypress', '#customer_username', function(evt){
				if ((e.which < 48 && e.which != 8) || 
					(e.which > 57 && e.which < 65) || 
					(e.which > 90 && e.which < 97) ||
					e.which > 122) {
					e.preventDefault();
				}
			});
			
			$("#customer_username").keyup(function (e) {
				if ((e.which < 48 && e.which != 8) || 
					(e.which > 57 && e.which < 65) || 
					(e.which > 90 && e.which < 97) ||
					e.which > 122) {
					e.preventDefault();
				}	
			});
			
		});
		
		function keyDown()
		{
			if ((e.which < 48 && e.which != 8) || 
				(e.which > 57 && e.which < 65) || 
				(e.which > 90 && e.which < 97) ||
				e.which > 122) {
				e.preventDefault();
			}	
		}
		function keypress()
		{
			if ((e.which < 48 && e.which != 8) || 
				(e.which > 57 && e.which < 65) || 
				(e.which > 90 && e.which < 97) ||
				e.which > 122) {
				e.preventDefault();
			}	

		}
		function keyup()
		{
			if ((e.which < 48 && e.which != 8) || 
				(e.which > 57 && e.which < 65) || 
				(e.which > 90 && e.which < 97) ||
				e.which > 122) {
				e.preventDefault();
			}	

		}
		$(document).ready(function(){
			$('.texthover').mousemove(function(event){
				var hovertext=$(this).attr('hovertext');
				$(this).next('.hovertext').text(hovertext).show();
				$(this).next('.hovertext').css('top',event.clientY+5).css('right',event.clientY+5);
			});
			
			$('.texthover').mouseout(function(event){
				$(this).next('.hovertext').hide();
			});
		});


	</script>
	
	
</body>

</html>