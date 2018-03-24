<!DOCTYPE html>
<html>
<head>
    <title><?php  echo get_label('admin_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='<?php echo  load_font('google_lato.css')?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  load_font('google_roboto_condensed.css')?>' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>font-awesome/font-awesome.min.css">
      <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/flat-blue.css">
    
     <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/custom.css">
    <script>
      var ADMIN_URL =  "<?php echo admin_url();?>";
      var LOGIN_URL =  "<?php echo admin_url();?>";
    </script>
</head>

<body class="flat-blue login-page">
<div class="container">
	<div class="login-box">

		<div class="row">
			<div class="alert alert-danger log_alert" role="alert" style="display:none;">
			</div>
			<div class="login-form col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo get_label('reset_password');?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url(); ?>" class="btn btn-info"><?php echo get_label('back');?></a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="login-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().'reset_password',' class="form-horizontal" id="reset_form" ' );?>
						
						<div class="form-group">
                            <label for="client_password" class="col-sm-2 control-label"><?php echo get_label('client_password');?></label>
                            <div class=""><div class="input_box"><?php  echo form_password('client_password',set_value('client_password'),' class="form-control  required" id="client_password"   minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_password').'"   ');?></div></div>
						</div>

						<div class="form-group">
                            <label for="client_cpassword" class="col-sm-2 control-label"><?php echo get_label('client_cpassword');?></label>
                            <div class=""><div class="input_box"><?php  echo form_password('client_cpassword',set_value('client_cpassword'),' class="form-control required " equalto="#client_password" minlength="'.get_label('client_password_minlength').'"placeholder="'.get_label('client_cpassword').'"   ');?></div></div>
						</div>
						<input type="hidden" name="user_id" value="<?php echo $user['admin_id']; ?>"/>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " id="reset_submit" name="submit"
                                    value="Submit"><?php echo get_label('reset');?></button>
                                <a class="text-link color-white" href="<?php echo admin_url(); ?>"  title="Back">&larr; <?php echo get_label('back'); ?></a>    
                            </div>
                        </div>

					</div>

					<?php
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
  <!-- Javascript Libs -->
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>bootstrap/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="<?php echo admin_skin()?>js/login.js"></script>
  
</body>
