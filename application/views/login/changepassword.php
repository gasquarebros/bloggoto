<script>
var custom_redirect_url = 'home';
</script>
<section>
	<div class="container">
		<div class="signup_wrap_inner">
			<div class="alert alert-danger log_alert" role="alert" style="display:none;"></div>
			
			<div class="login-form" id="login_frm" >
				<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;"></ul>
				<div class="signup_form_section">
					<?php echo form_open_multipart(base_url().'changepassword',' autocomplete="form_autocomplete()" class="form-horizontal" id="common_form" ' );?>	  
						<div class="portlet ">
							<div class="portlet-title">
								<div class="caption"><?php echo get_label('change_password');?></div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									 <div class="form-group">
										<label for="client_old_password" class="col-md-3 control-label"><?php echo get_label('client_old_password');?></label>
										<div class="col-sm-9"><div class="input_box"><?php  echo form_password('client_old_password',set_value('client_old_password'),' class="form-control  required" id="client_old_password"   minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_old_password').'"   ');?></div></div>
									</div>

									 <div class="form-group">
										<label for="client_password" class="col-md-3 control-label"><?php echo get_label('client_password');?></label>
										<div class="col-sm-9"><div class="input_box"><?php  echo form_password('client_password',set_value('client_password'),' class="form-control  required" id="client_password"   minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_password').'"   ');?></div></div>
									</div>
									
									 <div class="form-group">
										<label for="client_cpassword" class="col-md-3 control-label"><?php echo get_label('client_cpassword');?></label>
										<div class="col-sm-9"><div class="input_box"><?php  echo form_password('client_cpassword',set_value('client_cpassword'),' class="form-control required " equalto="#client_password" minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_cpassword').'"   ');?></div></div>
									</div>

								</div>
							</div>
							<div class="portlet-action col-sm-offset-3">
								<div class="actions btn-set btn_submit_div">
									<a type="button" href="<?php echo base_url();?>" class="btn btn-secondary-outline"><?php echo get_label('cancel');?></a>
									<button type="submit" class="btn btn-primary " id="changepassword_submit" name="submit" value="Submit"><?php echo get_label('change_password');?></button>&nbsp;
								</div>
							</div>
						</div>

					<?php
					echo form_hidden ( 'action', 'changepassword' );
					echo form_close ();
					?>
				</div>
			</div>
		</div>	
	</div>
</section>
<script src="<?php echo skin_url(); ?>js/login.js"></script>
