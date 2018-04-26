<div class="container-fluid">
	<div class="side-body padding-top">
		<?php echo get_template('layout/notifications','')?>
		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo get_label('change_password');?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url()."dashboard";?>" class="btn btn-info"><?php echo get_label('back');?></a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	        
				<?php echo form_open_multipart(admin_url().'changepassword',' autocomplete="form_autocomplete()" class="form-horizontal" id="common_form" ' );?>	  
                         <div class="form-group">
							 <label for="client_old_password" class="col-sm-2 control-label"><?php echo get_label('client_old_password');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_password('client_old_password',set_value('client_old_password'),' class="form-control  required" id="client_old_password"   minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_old_password').'"   ');?></div></div>
						</div>

                         <div class="form-group">
							<label for="client_password" class="col-sm-2 control-label"><?php echo get_label('client_password');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_password('client_password',set_value('client_password'),' class="form-control  required" id="client_password"   minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_password').'"   ');?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="client_password" class="col-sm-2 control-label"><?php echo get_label('client_cpassword');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_password('client_cpassword',set_value('client_cpassword'),' class="form-control required " equalto="#client_password" minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_cpassword').'"   ');?></div></div>
						</div>
						
						<div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " id="changepassword_submit" name="submit"
                                    value="Submit"><?php echo get_label('change_password');?></button>
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
</div>
