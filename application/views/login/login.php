<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo get_template('layout/header','')?>
</head>

<body>
	
	<?php echo get_template('layout/top-menu','')?>
	<?php echo get_template('layout/notifications','')?>
	<section>
		<div class="container">
			<div class="signup_wrap_inner">
				<div class="alert alert-danger log_alert" role="alert" style="display:none;"></div>
				
				<div class="login-form" id="login_frm" >
					<h3>Login</h3>
					<div class="signup_with" style="display: none">
						<a href="<?php echo base_url(); ?>auth_oa2/session/facebook" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>Connect with Facebook</a>
						<a href="<?php echo base_url(); ?>auth_oa2/session/google" class="google_plus"><i class="fa fa-google-plus" aria-hidden="true"></i>Connect with Google+</a>
						<div class="clear"></div>
						<p>or Login  with</p>
					</div>
					<div class="signup_form_section">
						<?php echo form_open(base_url(),'id="user_login_form" class="login-form" autocomplete= "'.form_autocomplte().'" ');?>
							<div class="form_field">
								<?php /*<label class="control-label visible-ie8 visible-ie9">Username</label>*/ ?>	
								<?php echo  form_input('username','','class="form-control form-control-solid placeholder-no-fix required" placeholder="Email Address"');?>
							</div>
							<div class="form_field">
								<?php echo  form_password('password','','class="form-control form-control-solid placeholder-no-fix required" placeholder="Password" minlength="'.PASSWORD_LENGTH.'" ');?>
							</div>
							<div class="form_field">
								<label class="checkbox-inline"><input type="checkbox" name="remember" value="1">Remember me</label>
							</div>
							<div class="form_field">
								<?php echo form_submit('submit','Login',' class="btn green uppercase" id="log_submit" ' )?>
								<a class="forget-password" id="forgot_password" title="Forgot password?"><?php echo get_label('forgot_pass'); ?></a>
								<a class="skip_login fr" href="<?php echo base_url().'home'; ?>" id="skip_login" title="Skip Login">Skip login</a>
							</div>
							<div class="create-account">
								<p>
									<a href="<?php echo base_url()."registration"; ?>" id="singup_link" class="uppercase"><?php echo get_label('user_registration'); ?></a> <label><?php echo get_label('firsttime_user'); ?></label>
								</p>
							</div>
						<?php echo form_close();?>
					</div>
				</div>
				
				<div id="forgot_frm" style="display:none;">
					<div class="login-body">
						<div class="progress " id="forgot-progress" style="display:none;;">
							<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								<?php echo get_label('log_in'); ?>
							</div>
						</div>
					   <?php echo form_open(base_url(),'id="forgot_form" class="forget-form" autocomplete= "'.form_autocomplte().'" ');?>
							<h3 class="font-green"><?php echo get_label('forgot_password'); ?></h3>
							<div class="form-group"> 

								<?php echo  form_input('email_address','','class="form-control placeholder-no-fix required email" placeholder="Email address"');?>
							</div>

							<div class="form-actions">
							
								<a class="btn green btn-outline" id="back_forgot" title="<?php echo get_label('back'); ?>">&larr; <?php echo get_label('back'); ?></a>
								<?php echo form_submit('submit',get_label('submit'),' class="btn btn-success uppercase pull-right" id="forgot_submit" ' )?>

							</div>
					  <?php echo form_close();?>
					 
				</div>
				
			</div>
				
			</div>
		</div>
	</section>
	
	<!--<a href="<?php echo base_url(); ?>auth_oa2/session/facebook" class="connect-with-button account-sprites account-sprites-facebook" title="Facebook Connect">Facebook</a>-->
	<?php echo get_template('layout/footer','')?>
	<?php /*echo get_template('layout/footer-includes','')*/?>
	<script type='text/javascript' src='<?php echo skin_url(); ?>js/jquery.accordion.source.js'></script>
	<script type='text/javascript' src='<?php echo skin_url(); ?>js/jquery.magnific-popup.js'></script>
	<script type='text/javascript' src='<?php echo skin_url(); ?>js/script.js'></script>
	<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.form.min.js"></script>
	<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo load_lib()?>chosen/js/chosen.jquery.min.js"></script>
	<script src="<?php echo skin_url()?>js/additional-methods.min.js" type="text/javascript"></script>



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
		});
	</script>
	<script src="<?php echo skin_url(); ?>js/login.js"></script>
	
</body>

</html>
