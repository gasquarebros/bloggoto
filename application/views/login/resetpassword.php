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
					<div class="progress " id="forgot-progress" style="display:none;;">
						<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							<?php echo get_label('log_in'); ?>
						</div>
					</div>
					<div class="signup_form_section">
						<?php echo form_open_multipart(base_url().'reset_password/'.$this->uri->segment(2),' class="form-horizontal" id="reset_form" ' );?>
							<h3 class="form-title font-green"><?php echo get_label('reset'); ?></h3>

							<div class="form-group">
								<label for="client_password" class="control-label"><?php echo get_label('client_password');?></label>
								<div class=""><div class="input_box"><?php  echo form_password('client_password',set_value('client_password'),' class="form-control  required" id="client_password"   minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_password').'"   ');?></div></div>
							</div>

							<div class="form-group">
								<label for="client_cpassword" class="control-label"><?php echo get_label('client_cpassword');?></label>
								<div class=""><div class="input_box"><?php  echo form_password('client_cpassword',set_value('client_cpassword'),' class="form-control required " equalto="#client_password" minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_cpassword').'"   ');?></div></div>
							</div>
							<input type="hidden" name="user_id" value="<?php echo $user['customer_id']; ?>"/>
							
							<div class="form-actions">
								<a class="text-link color-white" href="<?php echo base_url(); ?>"  title="Back">&larr; <?php echo get_label('back'); ?></a> 
								<button type="submit" class="btn btn-primary " id="reset_submit" name="submit" value="Reset"><?php echo get_label('reset');?></button>  
							</div>
							<?php echo form_hidden ( 'action', 'Add' ); ?>
						<?php echo form_close();?>
					</div>
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

