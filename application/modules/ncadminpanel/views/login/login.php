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
 <?php echo $this->load->view('layout/top-menu');?>
    <div class="container">
        <div class="login-box">
            <div>
                <div class="login-form row">
                 
                    <div class="col-sm-12">
                        <div class="alert alert-danger log_alert" role="alert" style="display:none;">
</div>              
                        <div id="login_frm" style="">
                            <div class="login-body">
                                <div class="progress " id="login-progress" style="display:none;;">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                       <?php echo get_label('log_in'); ?>
                                    </div>
                                </div>

                                    <h2 class="login_title"><?php echo get_label('login'); ?></h2>

                                   <?php echo form_open(admin_url(),'id="camp_login_form" autocomplete= "'.form_autocomplte().'" ');?>

                                        <div class="control"> 

                                            <?php echo  form_input('username','','class="form-control required" placeholder="Username"');?>
                                        </div>

                                        <div class="control">
                                         <?php echo  form_password('password','','class="form-control required" placeholder="Password" minlength="'.PASSWORD_LENGTH.'" ');?>

                                        </div>
                                        <div class="login-button text-center">
                                        <?php echo form_submit('submit','Login',' class="btn btn-info" id="log_submit" ' )?>
                                            <a class="text-link color-white" id="forgot_password" title="Forgot password?"><?php echo get_label('forgot_pass'); ?></a>

                                        </div>
                                  <?php echo form_close();?>

                            </div>
                            
                        </div>
                        <div id="forgot_frm" style="display:none;">
                                <div class="login-body">
                                    <div class="progress " id="login-progress" style="display:none;;">
                                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            <?php echo get_label('log_in'); ?>
                                        </div>
                                    </div>
                                    <h2 class="login_title"><?php echo get_label('forgot_password'); ?></h2>

                                   <?php echo form_open(admin_url(),'id="forgot_form" autocomplete= "'.form_autocomplte().'" ');?>

                                        <div class="control"> 

                                            <?php echo  form_input('admin_email_address','','class="form-control required email" placeholder="Email address"');?>
                                        </div>

                                        <div class="login-button text-center">
                                        <?php echo form_submit('submit',get_label('forgot_password'),' class="btn btn-info" id="log_submit" ' )?>
                                            <a class="text-link color-white" id="back_forgot" title="<?php echo get_label('back'); ?>">&larr; <?php echo get_label('back'); ?></a>

                                        </div>
                                  <?php echo form_close();?>
                            </div>
                            
                        </div>
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

</html>
